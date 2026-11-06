<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // لإرسال البيانات لـ n8n Webhook
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        // 1. التحقق من صحة البيانات القادمة من الفورم
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'category' => 'required|string',
            'priority' => 'required|string',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // 2. ربط الـ user_id تلقائياً إذا كان العميل مسجلاً للدخول
        $validated['user_id'] = Auth::check() ? Auth::id() : null;

        // 3. توليد رقم تذكرة فريد
        $validated['ticket_number'] = 'TCK-'.date('Y').'-'.strtoupper(substr(uniqid(), -5));
        $validated['status'] = 'New';
        $validated['created_at_n8n'] = now(); // حفظ الوقت الحالي في created_at_n8n

        // 4. حفظ التذكرة في قاعدة البيانات
        $ticket = Ticket::create($validated);

        // 5. (اختياري / جاهز للـ n8n): إرسال البيانات عبر Webhook لـ n8n عند توفر الرابط
        try {
            Http::withoutVerifying()
                ->timeout(10)
                ->post('https://n8n-huah.srv1973428.hstgr.cloud/webhook/support-ticket', [
                    'ticket_number' => $ticket->ticket_number,
                    'customer_name' => $ticket->customer_name,
                    'customer_email' => $ticket->customer_email,
                    'category' => $ticket->category,
                    'priority' => $ticket->priority,
                    'subject' => $ticket->subject,
                    'description' => $ticket->description,
                    'created_at' => $ticket->created_at->toDateTimeString(),
                    'status' => $ticket->status,
                ]);
        } catch (\Exception $e) {
            \Log::error('Failed to send ticket to n8n: '.$e->getMessage());
        }

        // 4. إرسال البيانات إلى n8n Webhook
        // try {
        //     // استبدل الرابط أدناه برابط الـ Webhook الفعلي الذي ستحصل عليه من منصة n8n لدك
        //     $n8nWebhookUrl = 'https://n8n-huah.srv1973428.hstgr.cloud/webhook/support-ticket';

        //     Http::timeout(5)->post($n8nWebhookUrl, [
        //         'ticket_number' => $ticket->ticket_number,
        //         'customer_name' => $ticket->customer_name,
        //         'customer_email' => $ticket->customer_email,
        //         'category' => $ticket->category,
        //         'priority' => $ticket->priority,
        //         'subject' => $ticket->subject,
        //         'description' => $ticket->description,
        //         'created_at' => $ticket->created_at->toDateTimeString(),
        //     ]);
        // } catch (\Exception $e) {
        //     // في حال كان الـ n8n متوقفاً أو غير متصل، لا نوقف العميل بل نسجل الخطأ أو نتجاهله مؤقتاً
        //     \Log::error('Failed to send ticket to n8n: '.$e->getMessage());
        // }

        // 6. العودة بنجاح مع رسالة توجيه
        return redirect()->back()->with('success', 'تم إرسال تذكرتك بنجاح برقم: '.$ticket->ticket_number);
    }
}

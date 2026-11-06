<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class ClientDashboardController extends Controller
{
    // public function index()
    // {
    //     $tickets = Ticket::where('customer_email', Auth::user()->email)
    //         ->orWhere('user_id', Auth::id())
    //         ->latest()
    //         ->get();

    //     return view('dashboard', compact('tickets'));
    // }

    public function index()
    {
        $user = Auth::user();

        // جلب جميع تذاكر العميل الحالي
        $tickets = Ticket::where('customer_email', $user->email)
            ->orWhere('user_id', $user->id)
            ->latest()
            ->get();

        // إحصائيات سريعة للوحة
        $stats = [
            'total' => $tickets->count(),
            'open' => $tickets->whereIn('status', ['New', 'In Progress'])->count(),
            'resolved' => $tickets->where('status', 'Resolved')->count(),
        ];

        return view('dashboard', compact('tickets', 'stats'));
    }

    // دالة عرض تفاصيل التذكرة
    public function show($id)
    {
        // جلب التذكرة بشرط أن تكون إما مملوكة للـ user_id الحالي أو تطابق بريده الإلكتروني
        $ticket = Ticket::where('id', $id)
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhere('customer_email', auth()->user()->email);
            })
            ->firstOrFail(); // إذا لم تكن موجودة أو لا تملكه، يظهر خطأ 404 تلقائياً

        return view('client.ticket-show', compact('ticket'));
    }
}

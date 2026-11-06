<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل التذكرة - {{ $ticket->ticket_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-slate-100 font-sans min-h-screen p-6">
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- الهيدر والرجوع -->
        <div class="flex items-center justify-between border-b border-slate-800 pb-4">
            <div>
                <h1 class="text-xl font-bold text-slate-100">تفاصيل التذكرة: <span
                        class="text-indigo-400">{{ $ticket->ticket_number }}</span></h1>
                <p class="text-xs text-slate-400 mt-1">تاريخ الإرسال: {{ $ticket->created_at->format('Y-m-d H:i') }}</p>
            </div>
            <a href="{{ route('dashboard') }}"
                class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-sm rounded-xl transition">
                العودة لوحة التحكم
            </a>
        </div>

        <!-- معلومات التذكرة -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-slate-900 border border-slate-800 p-4 rounded-2xl">
                <span class="block text-xs text-slate-400 mb-1">الحالة</span>
                <span
                    class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                    {{ $ticket->status == 'New' ? 'bg-amber-500/10 text-amber-400 border border-amber-500/20' : 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' }}">
                    {{ $ticket->status }}
                </span>
            </div>

            <div class="bg-slate-900 border border-slate-800 p-4 rounded-2xl">
                <span class="block text-xs text-slate-400 mb-1">الأولوية</span>
                <span class="text-sm font-medium text-slate-200">{{ $ticket->priority }}</span>
            </div>

            <div class="bg-slate-900 border border-slate-800 p-4 rounded-2xl">
                <span class="block text-xs text-slate-400 mb-1">القسم / الفئة</span>
                <span class="text-sm font-medium text-slate-200">{{ $ticket->category }}</span>
            </div>
        </div>

        <!-- محتوى الموضوع والرسالة -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 space-y-4 shadow-xl">
            <div>
                <span class="block text-xs text-slate-400 mb-1">موضوع التذكرة</span>
                <h2 class="text-lg font-semibold text-slate-100">{{ $ticket->subject }}</h2>
            </div>

            <hr class="border-slate-800">

            <div>
                <span class="block text-xs text-slate-400 mb-1">نص الرسالة / المشكلة</span>
                <div
                    class="bg-slate-950/50 border border-slate-800/60 p-4 rounded-xl text-slate-300 text-sm leading-relaxed whitespace-pre-wrap">
                    {{ $ticket->description }}
                </div>
            </div>
        </div>

    </div>
</body>

</html>

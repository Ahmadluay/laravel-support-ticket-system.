<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم العملاء - إدارة التذاكر</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: '#6366f1'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-950 text-slate-100 font-sans min-h-screen antialiased">

    <!-- Navbar Header -->
    <header class="bg-slate-900/80 border-b border-slate-800 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center font-bold text-white shadow-lg shadow-indigo-500/30">
                    TC
                </div>
                <span class="font-bold text-lg text-slate-100">نظام الدعم الفني</span>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <span class="text-sm text-slate-400">مرحباً، <strong
                            class="text-slate-200">{{ auth()->user()->name }}</strong></span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-xs text-rose-400 hover:text-rose-300 bg-rose-500/10 border border-rose-500/20 px-3 py-1.5 rounded-lg transition">
                            تسجيل الخروج
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-indigo-400 hover:underline">تسجيل الدخول</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Title & Quick Actions -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-100">لوحة تحكم التذاكر</h1>
                    <p class="text-sm text-slate-400 mt-1">متابعة دقيقة وحية لحالة تذاكر الدعم الفني الخاصة بك</p>
                </div>
                <a href="{{ url('/') }}#ticket-form"
                    class="inline-flex items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-medium text-sm rounded-xl transition shadow-lg shadow-indigo-600/30 gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    إنشاء تذكرة جديدة
                </a>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-slate-900/80 border border-slate-800 p-6 rounded-2xl shadow-xl">
                    <p class="text-sm font-medium text-slate-400">إجمالي التذاكر</p>
                    <p class="text-3xl font-bold text-indigo-400 mt-2">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-slate-900/80 border border-slate-800 p-6 rounded-2xl shadow-xl">
                    <p class="text-sm font-medium text-slate-400">تذاكر قيد المعالجة</p>
                    <p class="text-3xl font-bold text-amber-400 mt-2">{{ $stats['open'] }}</p>
                </div>
                <div class="bg-slate-900/80 border border-slate-800 p-6 rounded-2xl shadow-xl">
                    <p class="text-sm font-medium text-slate-400">التذاكر المكتملة</p>
                    <p class="text-3xl font-bold text-emerald-400 mt-2">{{ $stats['resolved'] }}</p>
                </div>
            </div>

            <!-- Tickets Table -->
            <div class="bg-slate-900/80 border border-slate-800 shadow-2xl rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-slate-800">
                    <h3 class="text-lg font-bold text-slate-200">سجل التذاكر المقدمة</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right text-sm text-slate-300">
                        <thead class="bg-slate-800/50 text-slate-400 uppercase text-xs border-b border-slate-800">
                            <tr>
                                <th class="px-6 py-4">رقم التذكرة</th>
                                <th class="px-6 py-4">الموضوع</th>
                                <th class="px-6 py-4">التصنيف</th>
                                <th class="px-6 py-4">الأولوية</th>
                                <th class="px-6 py-4">الحالة</th>
                                <th class="px-6 py-4">تاريخ الإنشـاء</th>
                                <th class="px-6 py-4">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @forelse($tickets as $ticket)
                                <tr class="hover:bg-slate-800/30 transition">
                                    <td class="px-6 py-4 font-mono font-bold text-indigo-400">
                                        {{ $ticket->ticket_number }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-slate-100">
                                        {{ $ticket->subject }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-slate-800 text-slate-300 px-3 py-1 rounded-full text-xs">
                                            {{ $ticket->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($ticket->priority === 'Urgent')
                                            <span
                                                class="bg-rose-500/10 text-rose-400 border border-rose-500/20 px-3 py-1 rounded-full text-xs font-semibold">عاجل
                                                جداً</span>
                                        @elseif($ticket->priority === 'High')
                                            <span
                                                class="bg-amber-500/10 text-amber-400 border border-amber-500/20 px-3 py-1 rounded-full text-xs font-semibold">عالية</span>
                                        @else
                                            <span
                                                class="bg-slate-700 text-slate-300 px-3 py-1 rounded-full text-xs">عادية</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($ticket->status === 'New')
                                            <span
                                                class="inline-flex items-center gap-1.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 px-3 py-1 rounded-full text-xs font-medium">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                                                جديدة
                                            </span>
                                        @elseif($ticket->status === 'In Progress')
                                            <span
                                                class="inline-flex items-center gap-1.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 px-3 py-1 rounded-full text-xs font-medium">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> قيد المعالجة
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-3 py-1 rounded-full text-xs font-medium">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> مكتملة
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-xs text-slate-400">
                                        {{ $ticket->created_at->format('Y-m-d H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('client.ticket.show', $ticket->id) }}"
                                            class="text-indigo-400 hover:underline text-sm">عرض التفاصيل</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                        لا توجد لديك أي تذاكر دعم فني حالياً.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>

</html>

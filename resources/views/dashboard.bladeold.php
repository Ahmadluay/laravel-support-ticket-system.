{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-100 leading-tight dir-rtl text-right">
            {{ __('لوحة تحكم التذاكر الخاصة بك') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen text-slate-100 dir-rtl" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- بطاقات الإحصائيات السريعة -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-slate-900/80 border border-slate-800 p-6 rounded-2xl shadow-xl backdrop-blur-md">
                    <p class="text-sm font-medium text-slate-400">إجمالي التذاكر</p>
                    <p class="text-3xl font-bold text-indigo-400 mt-2">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-slate-900/80 border border-slate-800 p-6 rounded-2xl shadow-xl backdrop-blur-md">
                    <p class="text-sm font-medium text-slate-400">تذاكر قيد المعالجة</p>
                    <p class="text-3xl font-bold text-amber-400 mt-2">{{ $stats['open'] }}</p>
                </div>
                <div class="bg-slate-900/80 border border-slate-800 p-6 rounded-2xl shadow-xl backdrop-blur-md">
                    <p class="text-sm font-medium text-slate-400">التذاكر المكتملة</p>
                    <p class="text-3xl font-bold text-emerald-400 mt-2">{{ $stats['resolved'] }}</p>
                </div>
            </div>

            <!-- جدول التذاكر -->
            <div class="bg-slate-900/80 border border-slate-800 shadow-2xl rounded-2xl overflow-hidden backdrop-blur-md">
                <div class="p-6 border-b border-slate-800 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-slate-200">سجل التذاكر المقدمة</h3>
                    <a href="{{ url('/') }}#ticket-form" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium text-sm rounded-xl transition shadow-lg shadow-indigo-600/30">
                        + إنشاء تذكرة جديدة
                    </a>
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
                                        @if($ticket->priority === 'Urgent')
                                            <span class="bg-rose-500/10 text-rose-400 border border-rose-500/20 px-3 py-1 rounded-full text-xs font-semibold">عاجل جداً</span>
                                        @elseif($ticket->priority === 'High')
                                            <span class="bg-amber-500/10 text-amber-400 border border-amber-500/20 px-3 py-1 rounded-full text-xs font-semibold">عالية</span>
                                        @else
                                            <span class="bg-slate-700 text-slate-300 px-3 py-1 rounded-full text-xs">عادية</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($ticket->status === 'New')
                                            <span class="inline-flex items-center gap-1.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 px-3 py-1 rounded-full text-xs font-medium">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span> جديدة
                                            </span>
                                        @elseif($ticket->status === 'In Progress')
                                            <span class="inline-flex items-center gap-1.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 px-3 py-1 rounded-full text-xs font-medium">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> قيد المعالجة
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-3 py-1 rounded-full text-xs font-medium">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> مكتملة
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-xs text-slate-400">
                                        {{ $ticket->created_at->format('Y-m-d H:i') }}
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
    </div>
</x-app-layout> --}}



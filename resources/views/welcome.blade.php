<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة الدعم الفني الذكية | نظام إدارة التذاكر</title>
    <!-- تضمين Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'blob': 'blob 7s infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        blob: {
                            '0%': {
                                transform: 'translate(0px, 0px) scale(1)'
                            },
                            '33%': {
                                transform: 'translate(30px, -50px) scale(1.1)'
                            },
                            '66%': {
                                transform: 'translate(-20px, 20px) scale(0.9)'
                            },
                            '100%': {
                                transform: 'translate(0px, 0px) scale(1)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <!-- FontAwesome & SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .swiper-pagination-bullet {
            background: #818cf8 !important;
        }

        .swiper-pagination-bullet-active {
            width: 24px !important;
            border-radius: 9999px !important;
        }
    </style>
</head>

<body
    class="bg-slate-950 text-slate-100 min-h-screen relative overflow-x-hidden selection:bg-indigo-500 selection:text-white">

    <!-- خلفية متحركة تفاعلية -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div
            class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-purple-600/30 rounded-full blur-[120px] animate-blob">
        </div>
        <div class="absolute top-[30%] left-[-10%] w-[600px] h-[600px] bg-indigo-600/30 rounded-full blur-[140px] animate-blob"
            style="animation-delay: 2s;"></div>
        <div class="absolute bottom-[-10%] right-[20%] w-[550px] h-[550px] bg-blue-600/20 rounded-full blur-[130px] animate-blob"
            style="animation-delay: 4s;"></div>
    </div>

    <!-- شريط التنقل العلوي -->
    <header class="relative z-50 border-b border-white/15 backdrop-blur-md bg-slate-900/60 sticky top-0">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3 space-x-reverse">
                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-purple-500 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                    <i class="fa-solid fa-headset text-white text-lg"></i>
                </div>
                <span
                    class="text-xl font-black tracking-wider bg-gradient-to-r from-white via-indigo-200 to-indigo-400 bg-clip-text text-transparent">سندك
                    | Support Hub</span>
            </div>

            <div class="flex items-center space-x-4 space-x-reverse">

                <div class="flex items-center gap-4">
                    @auth
                        <!-- إذا كان المستخدم مسجل دخول -->

                        <!-- لوحة تحكم العملاء -->
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium text-sm rounded-xl transition shadow-lg shadow-indigo-600/30">
                            لوحة التحكم
                        </a>

                        <!-- دائرة الحرف الأول من الاسم في الزاوية -->
                        @php
                            $name = auth()->user()->name;
                            // استخراج أول كلمة إذا كان عربي، أو الحرف الأول
                            $firstInitial = mb_substr($name, 0, 1);
                        @endphp
                    @else
                        <!-- إذا لم يكن مسجل دخول (يظهر زر تسجيل الدخول فقط، ومن داخله يجد خيار إنشاء حساب) -->
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium text-sm rounded-xl transition shadow-lg shadow-indigo-600/30">
                            تسجيل الدخول
                        </a>
                    @endauth
                </div>

                @if (auth()->check() && auth()->user()->role === \App\Enums\UserRole::ADMIN)
                    <a href="/admin"
                        class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-sm font-semibold transition-all duration-300 flex items-center gap-2">
                        <i class="fa-solid fa-gauge-high text-indigo-400"></i>
                        لوحة المشرفين
                    </a>
                @endif
                <a href="#submit-ticket"
                    class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-sm font-bold shadow-lg shadow-indigo-600/30 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-plus-circle ml-1"></i>
                    إرسال تذكرة جديدة
                </a>
                @if (auth()->check())
                    <div class="relative  group cursor-pointer" title="{{ $name }}">
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white font-bold text-sm shadow-md border border-indigo-400/30">
                            {{ $firstInitial }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- القسم الرئيسي (Hero Section) -->
    <section class="relative z-10 pt-20 pb-12 px-6 text-center max-w-4xl mx-auto">
        <div
            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-sm font-medium mb-8 backdrop-blur-sm animate-pulse-slow">
            <span class="w-2 h-2 rounded-full bg-indigo-400 animate-ping"></span>
            نظام تذاكر متكامل ومتابعة لحظية للعملاء
        </div>
        <h1 class="text-4xl md:text-6xl font-black tracking-tight leading-tight mb-6">
            منصتك الذكية لمتابعة الدعم الفني <br>
            <span class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">بكل
                شفافية وسرعة فائقة</span>
        </h1>
        <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto mb-12 leading-relaxed">
            أنشئ تذكرتك، تابع حالة طلبك عبر لوحة تحكم المشتخدم الخاصة بك، وتلقى ردود فورية ومباشرة.
        </p>
    </section>

    <!-- قسم العرض التفاعلي المتحرك (Swiper Showcase - لوحة تحكم المستخدم) -->
    <section class="relative z-10 max-w-6xl mx-auto px-6 mb-24">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold mb-2">جولة في لوحة تحكم المستخدمين</h2>
            <p class="text-slate-400 text-sm">استكشف كيف تتابع طلباتك وسجل تذاكرك بكل سهولة ويسر</p>
        </div>

        <!-- Swiper Container -->
        <div
            class="swiper clientDashboardSwiper rounded-3xl border border-white/10 bg-slate-900/40 backdrop-blur-xl p-6 md:p-10 shadow-2xl">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide flex flex-col md:flex-row items-center gap-8 n1">
                    <div class="w-full md:w-1/2 space-y-4">
                        <span
                            class="px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-xs font-bold border border-indigo-500/20">الميزة
                            الأولى</span>
                        <h3 class="text-2xl font-bold text-white">لوحة تحكم شخصية مستقلة</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">بمجرد تسجيل دخولك، ستحصل على داشبورد مخصصة
                            تعرض كافة تذاكرك السابقة، الحالات الحالية (جديد، قيد المعالجة، تم الحل)، وإحصائيات طلباتك
                            معنا.</p>
                        <div class="flex items-center gap-3 text-xs text-indigo-300 pt-2">
                            <span><i class="fa-solid fa-check text-emerald-400 ml-1"></i> متابعة فورية</span>
                            <span><i class="fa-solid fa-check text-emerald-400 ml-1"></i> أرشيف كامل</span>
                        </div>
                    </div>
                    <div
                        class="w-full md:w-1/2 rounded-2xl bg-gradient-to-tr from-indigo-950/80 to-slate-900 border border-indigo-500/30 p-6 flex flex-col justify-center min-h-[220px] shadow-inner">
                        <div class="flex items-center justify-between mb-4 border-b border-white/10 pb-3">
                            <span class="text-xs font-bold text-indigo-400"><i class="fa-solid fa-chart-pie ml-1"></i>
                                ملخص تذاكر العميل</span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="bg-slate-950/60 p-4 rounded-xl border border-white/5">
                                <span class="block text-2xl font-black text-indigo-300">3</span>
                                <span class="text-xs text-slate-400">تذاكر نشطة</span>
                            </div>
                            <div class="bg-slate-950/60 p-4 rounded-xl border border-white/5">
                                <span class="block text-2xl font-black text-emerald-400">12</span>
                                <span class="text-xs text-slate-400">تذاكر مجابة</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide flex flex-col md:flex-row items-center gap-8 n2">
                    <div class="w-full md:w-1/2 space-y-4">
                        <span
                            class="px-3 py-1 rounded-full bg-purple-500/10 text-purple-400 text-xs font-bold border border-purple-500/20">الميزة
                            الثانية</span>
                        <h3 class="text-2xl font-bold text-white">إرسال سهل وتتبع ذكي عبر n8n</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">فور قيامك بملء نموذج التذكرة، يتم إرسالها
                            الفورية لأنظمة الأتمتة وتنبيه فريق الدعم عبر Telegram لضمان سرعة الاستجابة القصوى.</p>
                        <div class="flex items-center gap-3 text-xs text-purple-300 pt-2">
                            <span><i class="fa-solid fa-bolt text-amber-400 ml-1"></i> تنبيهات لحظية</span>
                            <span><i class="fa-solid fa-shield-halved text-emerald-400 ml-1"></i> أمان وحفظ دقيق</span>
                        </div>
                    </div>
                    <div
                        class="w-full md:w-1/2 rounded-2xl bg-gradient-to-tr from-purple-950/80 to-slate-900 border border-purple-500/30 p-6 flex flex-col justify-center min-h-[220px] shadow-inner">
                        <div class="flex items-center gap-3 bg-slate-950/60 p-4 rounded-xl border border-white/5 mb-3">
                            <div
                                class="w-10 h-10 rounded-lg bg-indigo-600/20 flex items-center justify-center text-indigo-400">
                                <i class="fa-solid fa-paper-plane"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white">تم إرسال التذكرة بنجاح</h4>
                                <p class="text-xs text-slate-400">تم تنبيه فريق الدعم عبر Telegram</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 bg-slate-950/60 p-4 rounded-xl border border-white/5">
                            <div
                                class="w-10 h-10 rounded-lg bg-emerald-600/20 flex items-center justify-center text-emerald-400">
                                <i class="fa-solid fa-check-double"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-white">حالة الطلب: قيد المعالجة</h4>
                                <p class="text-xs text-slate-400">يقوم المهندس الآن بمراجعة طلبك</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination mt-6 relative"></div>
        </div>
    </section>

    <!-- قسم نموذج إرسال التذكرة (Interactive Form Card) -->
    <section id="submit-ticket" class="relative z-15 max-w-3xl mx-auto px-6 mb-24">
        <div
            class="backdrop-blur-xl bg-slate-900/70 border border-white/10 p-8 md:p-10 rounded-3xl shadow-2xl shadow-indigo-950/50 relative overflow-hidden">
            <div
                class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-indigo-500 to-transparent">
            </div>

            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold mb-2">تقديم تذكرة دعم فني جديدة</h2>
                <p class="text-slate-400 text-sm">املأ الحقول التالية وسيتم توجيه طلبك فوراً لمسؤولي الدعم والأتمتة</p>
            </div>


            <form action="{{ route('tickets.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">الاسم الكريم</label>
                        <input type="text" name="customer_name" required placeholder="أدخل اسمك الكامل"
                            class="w-full px-4 py-3 rounded-xl bg-slate-950/60 border border-white/10 text-slate-100 placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">البريد الإلكتروني</label>
                        <input type="email" name="customer_email" required placeholder="name@example.com"
                            class="w-full px-4 py-3 rounded-xl bg-slate-950/60 border border-white/10 text-slate-100 placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">تصنيف الطلب</label>
                        <select name="category"
                            class="w-full px-4 py-3 rounded-xl bg-slate-950/60 border border-white/10 text-slate-300 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                            <option value="Technical Support">دعم فني وبرمجي</option>
                            <option value="Billing">استفسار مالي أو اشتراك</option>
                            <option value="Feature Request">طلب ميزة جديدة</option>
                            <option value="General">استفسار عام</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">مستوى الأولوية</label>
                        <select name="priority"
                            class="w-full px-4 py-3 rounded-xl bg-slate-950/60 border border-white/10 text-slate-300 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                            <option value="Low">منخفضة (Low)</option>
                            <option value="Medium" selected>متوسطة (Medium)</option>
                            <option value="High">عالية (High)</option>
                            <option value="Urgent">عاجلة جداً (Urgent)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">عنوان المشكلة أو الطلب</label>
                    <input type="text" name="subject" required placeholder="اكتب عنواناً مختصراً وواضحاً..."
                        class="w-full px-4 py-3 rounded-xl bg-slate-950/60 border border-white/10 text-slate-100 placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-300 mb-2">تفاصيل المشكلة</label>
                    <textarea name="description" rows="4" required
                        placeholder="اشرح المشكلة بالتفصيل لكي نتمكن من مساعدتك بأسرع وقت..."
                        class="w-full px-4 py-3 rounded-xl bg-slate-950/60 border border-white/10 text-slate-100 placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all resize-none"></textarea>
                </div>

                <button type="submit"
                    class="w-full py-4 rounded-xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-500 hover:to-pink-500 text-white font-bold text-base shadow-xl shadow-indigo-600/30 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-paper-plane ml-2"></i>
                    إرسال التذكرة الآن
                </button>
            </form>
        </div>
    </section>

    <!-- قسم كروت التذاكر العامة (Public Tickets Showcase) -->
    <section class="relative z-10 max-w-7xl mx-auto px-6 mb-24">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-3">سجل أحدث التذاكر العامة</h2>
            <p class="text-slate-400">تابع نشاط المنصة وحالة التذاكر المسجلة حالياً</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- كارت تذكرة تجريبي 1 -->
            <div
                class="backdrop-blur-xl bg-slate-900/50 border border-white/10 p-6 rounded-2xl hover:border-indigo-500/50 transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <span
                        class="px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-xs font-bold border border-indigo-500/20">TCK-2026-01</span>
                    <span class="px-2.5 py-1 rounded-full bg-amber-500/10 text-amber-400 text-xs font-semibold">قيد
                        المعالجة</span>
                </div>
                <h3 class="text-lg font-bold mb-2 group-hover:text-indigo-400 transition-colors">مشكلة في ربط بوابة
                    الدفع</h3>
                <p class="text-slate-400 text-sm mb-4 line-clamp-2">تواجهني مشكلة أثناء محاولة إتمام عملية الدفع عبر
                    واجهة API الخاصة بالمتجر...</p>
                <div class="flex items-center justify-between text-xs text-slate-500 border-t border-white/5 pt-4">
                    <span><i class="fa-regular fa-user ml-1"></i> أحمد لؤي</span>
                    <span><i class="fa-regular fa-clock ml-1"></i> منذ ساعتين</span>
                </div>
            </div>

            <!-- كارت تذكرة تجريبي 2 -->
            <div
                class="backdrop-blur-xl bg-slate-900/50 border border-white/10 p-6 rounded-2xl hover:border-indigo-500/50 transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <span
                        class="px-3 py-1 rounded-full bg-purple-500/10 text-purple-400 text-xs font-bold border border-purple-500/20">TCK-2026-02</span>
                    <span class="px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-semibold">تم
                        الحل</span>
                </div>
                <h3 class="text-lg font-bold mb-2 group-hover:text-indigo-400 transition-colors">استفسار حول ترقية باقة
                    الاشتراكات</h3>
                <p class="text-slate-400 text-sm mb-4 line-clamp-2">أرغب بمعرفة تفاصيل الانتقال من الباقة العادية إلى
                    الباقة الاحترافية وتكلفة الإضافات...</p>
                <div class="flex items-center justify-between text-xs text-slate-500 border-t border-white/5 pt-4">
                    <span><i class="fa-regular fa-user ml-1"></i> محمد خالد</span>
                    <span><i class="fa-regular fa-clock ml-1"></i> منذ 5 ساعات</span>
                </div>
            </div>

            <!-- كارت تذكرة تجريبي 3 -->
            <div
                class="backdrop-blur-xl bg-slate-900/50 border border-white/10 p-6 rounded-2xl hover:border-indigo-500/50 transition-all duration-300 group">
                <div class="flex items-center justify-between mb-4">
                    <span
                        class="px-3 py-1 rounded-full bg-pink-500/10 text-pink-400 text-xs font-bold border border-pink-500/20">TCK-2026-03</span>
                    <span
                        class="px-2.5 py-1 rounded-full bg-blue-500/10 text-blue-400 text-xs font-semibold">جديد</span>
                </div>
                <h3 class="text-lg font-bold mb-2 group-hover:text-indigo-400 transition-colors">طلب إضافة تقرير
                    المبيعات الشهري</h3>
                <p class="text-slate-400 text-sm mb-4 line-clamp-2">نحتاج إلى ميزة تصدير تقارير المبيعات بصيغة Excel
                    مخصصة لتحليل البيانات...</p>
                <div class="flex items-center justify-between text-xs text-slate-500 border-t border-white/5 pt-4">
                    <span><i class="fa-regular fa-user ml-1"></i> سارة أحمد</span>
                    <span><i class="fa-regular fa-clock ml-1"></i> منذ يوم</span>
                </div>
            </div>
        </div>
    </section>

    <!-- الفوتر -->
    <footer class="relative z-10 border-t border-white/10 py-8 text-center text-slate-500 text-sm">
        <p>جميع الحقوق محفوظة © 2026 - منصة سندك للدعم الفني والأتمتة الذكية</p>
    </footer>

    <!-- SwiperJS Script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.clientDashboardSwiper', {
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>

    <!-- تضمين مكتبة SweetAlert2 الجاهزة -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'تم إرسال الطلب بنجاح!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'حسناً',
                    background: '#020617', // يتطابق مع لون خلفية الموقع bg-slate-950
                    color: '#f8fafc', // لون النص
                    confirmButtonColor: '#4f46e5', // لون أزرار Tailwind Indigo
                    customClass: {
                        popup: 'border border-white/10 rounded-3xl backdrop-blur-xl shadow-2xl'
                    }
                });
            });
        </script>
    @endif
</body>

</html>

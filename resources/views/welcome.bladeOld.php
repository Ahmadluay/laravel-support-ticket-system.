<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة الدعم الفني الذكية | نظام إدارة التذاكر</title>
    <!-- تضمين Tailwind CSS عبر CDN -->
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body
    class="bg-slate-950 text-slate-100 min-h-screen relative overflow-x-hidden selection:bg-indigo-500 selection:text-white">

    <!-- خلفية متحركة تفاعلية عالية الدقة (Animated Glowing Orbs) -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div
            class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-purple-600/30 rounded-full blur-[120px] animate-blob">
        </div>
        <div class="absolute top-[30%] left-[-10%] w-[600px] h-[600px] bg-indigo-600/30 rounded-full blur-[140px] animate-blob"
            style="animation-delay: 2s;"></div>
        <div class="absolute bottom-[-10%] right-[20%] w-[550px] h-[550px] bg-blue-600/20 rounded-full blur-[130px] animate-blob"
            style="animation-delay: 4s;"></div>
    </div>

    <!-- شريط التنقل العلوي (Navbar) -->
    <header class="relative z-50 border-b border-white/10 backdrop-blur-md bg-slate-900/40 sticky top-0">
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
                <a href="/admin"
                    class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-sm font-semibold transition-all duration-300 flex items-center gap-2">
                    <i class="fa-solid fa-gauge-high text-indigo-400"></i>
                    لوحة المشرفين
                </a>
                <a href="#submit-ticket"
                    class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-sm font-bold shadow-lg shadow-indigo-600/30 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-plus-circle ml-1"></i>
                    إرسال تذكرة جديدة
                </a>
            </div>
        </div>
    </header>

    <!-- القسم الرئيسي (Hero Section) -->
    <section class="relative z-10 pt-20 pb-16 px-6 text-center max-w-4xl mx-auto">
        <div
            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-sm font-medium mb-8 backdrop-blur-sm animate-pulse-slow">
            <span class="w-2 h-2 rounded-full bg-indigo-400 animate-ping"></span>
            نظام تذاكر مدعوم بالأتمتة والذكاء الاصطناعي
        </div>
        <h1 class="text-4xl md:text-6xl font-black tracking-tight leading-tight mb-6">
            كيف يمكننا مساعدتك <br>
            <span
                class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">اليوم
                بكل سرعة واحترافية؟</span>
        </h1>
        <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
            منصة متكاملة لإرسال ومتابعة طلباتك الفنية لحظياً، مع تنبيهات فورية ومتابعة دقيقة لحالة كل طلب.
        </p>
    </section>

    <!-- قسم نموذج إرسال التذكرة (Interactive Form Card) -->
    <section id="submit-ticket" class="relative z-15 max-w-3xl mx-auto px-6 mb-24">
        <div
            class="backdrop-blur-xl bg-slate-900/70 border border-white/10 p-8 md:p-10 rounded-3xl shadow-2xl shadow-indigo-950/50 relative overflow-hidden">
            <!-- خط مضيء علوي -->
            <div
                class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-indigo-500 to-transparent">
            </div>

            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold mb-2">تقديم تذكرة دعم فني جديدة</h2>
                <p class="text-slate-400 text-sm">املأ الحقول التالية وسيتم توجيه طلبك فوراً لمسؤولي الدعم والأتمتة</p>
            </div>

            <form action="#" method="POST" class="space-y-6">
                <!-- CSRF Token (إذا كان مفعلاً بلارافيل) -->
                <!-- @csrf -->

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

    <!-- الفوتر (Footer) -->
    <footer class="relative z-10 border-t border-white/10 py-8 text-center text-slate-500 text-sm">
        <p>جميع الحقوق محفوظة © 2026 - منصة سندك للدعم الفني والأتمتة الذكية</p>
    </footer>

</body>

</html>

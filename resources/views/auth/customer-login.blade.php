<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - بوابة العملاء</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-slate-100 font-sans min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-slate-900 border border-slate-800 rounded-2xl p-8 shadow-2xl space-y-6">
        <div class="text-center space-y-2">
            <h1 class="text-2xl font-bold text-slate-100">تسجيل الدخول للعملاء</h1>
            <p class="text-sm text-slate-400">أدخل بياناتك لمتابعة تذاكر الدعم الفني الخاصة بك</p>
        </div>

        @if ($errors->any())
            <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 p-3 rounded-xl text-sm text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('client.login.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-2.5 text-slate-100 text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1">كلمة المرور</label>
                <input type="password" name="password" required
                    class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-2.5 text-slate-100 text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-medium py-2.5 rounded-xl transition shadow-lg shadow-indigo-600/30">
                دخول
            </button>
        </form>

        <p class="text-center text-xs text-slate-400">
            ليس لديك حساب؟ <a href="{{ route('client.register') }}"
                class="text-indigo-400 hover:underline font-bold">أنشئ حساباً جديداً</a>
        </p>
    </div>
</body>

</html>

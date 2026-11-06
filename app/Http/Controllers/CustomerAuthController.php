<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    // عرض صفحة تسجيل الدخول
    public function showLogin()
    {
        return view('auth.customer-login');
    }

    // معالجة تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // التأكد من أن المستخدم ليس أدمن (أو توجيه حسب الدور)
            if (Auth::user()->role === UserRole::ADMIN) {
                return redirect()->intended('/admin');
            }

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة.',
        ])->onlyInput('email');
    }

    // عرض صفحة إنشاء حساب جديد
    public function showRegister()
    {
        return view('auth.customer-register');
    }

    // معالجة إنشاء حساب جديد
    public function register(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => UserRole::CLIENT, // إعطاء الدور العميل تلقائياً
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}

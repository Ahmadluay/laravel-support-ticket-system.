<?php

use App\Enums\UserRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\CustomerAuthController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// 1. الصفحة الرئيسية (صفحة الهبوط)
Route::get('/', function () {
    return view('welcome');
});

// 2. مسارات المصادقة للعملاء (Guest Only)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'login'])->name('client.login.store');

    Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('client.register');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('client.register.store');
});

// 3. مسارات لوحة العميل (Auth Only)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');

    // مسار تسجيل الخروج
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

// 4. مسارات إدارة التذاكر (Auth Only)
Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');

// عرض تفاصيل تذكرة معينة للعميل
Route::get('/dashboard/tickets/{ticket}', [ClientDashboardController::class, 'show'])->name('client.ticket.show');



// لانشاء مستخدم تجريبي من خلال الرابط التالي (للاختبار فقط)
Route::get('/test-create-user', function () {
    $user = User::create([
        'name'     => 'أحمد',
        'email'    => 'ahmad@example.com',
        'password' => Hash::make('password123'),
        'role'     => UserRole::CLIENT,
    ]);

    return "تم إنشاء المستخدم بنجاح: " . $user->name;
});

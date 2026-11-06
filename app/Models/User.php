<?php
namespace App\Models;

use Filament\Panel;
use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // استدعاء الـ Enum

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class, // لارافيل سيقوم بتحويل القائمة من وإلى Enum تلقائياً!
        ];
    }

    /**
     * التحكم في من يسمح له بدخول لوحة تحكم الأدمن (Filament)
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // السماح فقط للمستخدمين الذين يمتلكون رتبة ADMIN
        return $this->role === UserRole::ADMIN;
    }
}

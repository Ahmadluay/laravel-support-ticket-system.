<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ticket_number',
        'customer_name',
        'customer_email',
        'category',
        'priority',
        'subject',
        'description',
        'status',
        'created_at_n8n',
    ];

    /**
     * علاقة التذكرة بالمستخدم صاحب الحساب
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

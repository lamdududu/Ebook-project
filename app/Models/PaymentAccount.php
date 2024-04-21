<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'so_tai_khoan',
        'mat_khau',
        'tai_khoan',
    ];

    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            'mat_khau' => 'hashed',
        ];
    }
}

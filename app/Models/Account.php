<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ten_tai_khoan',
        'email',
        'mat_khau',
    ];
    
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['mat_khau'] = Hash::make($value);
    // }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'mat_khau',
        // 'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            'mat_khau' => 'hashed',
        ];
    }

    public function isAdmin() {
        return $this->loai_tai_khoan == '1';
    }

    public function isEditor() {
        return $this->loai_tai_khoan == '2';
    }
}


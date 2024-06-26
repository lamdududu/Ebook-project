<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    public function time() {
        return $this->belongsTo(Time::class);
    }

    public function work() {
        return $this->belongsTo(Work::class);
    }

    protected $fillable = [
        'thoi_diem',
        'tac_pham',
        'gia_ban_thuong',
        'gia_ban_db'
    ];
}

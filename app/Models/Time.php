<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    public function prices() {
        return $this->hasMany(Price::class);
    }

    protected $fillable = [
        'thoi_diem',
    ];
}

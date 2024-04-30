<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = [
        'nha_xuat_ban',
        'email',
        'so_dien_thoai',
        'dia_chi',
    ];
}

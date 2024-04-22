<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyrightProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'ten_nha_cung_cap',
    ];
}

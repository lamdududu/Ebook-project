<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'ngay_lap',
        'thanh_tien',
        'tai_khoan',
        'loai_hoa_don',
        'khuyen_mai',
    ];
}

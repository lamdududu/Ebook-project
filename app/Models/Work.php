<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;
    
    public function prices() {
        return $this->hasMany(Price::class);
    }

    protected $fillable = [
        'tua_de',
        'tac_gia',
        'dich_gia',
        'ngon_ngu',
        'nha_xuat_ban',
        'nam_xuat_ban',
        'tong_bien_tap',
        'bien_tap_vien',
        'so_dkxb',
        'so_qdxb',
        'ngay_cap_qdxb',
        'ma_so_isbn',
        'anh_bia',
        'tep_tin',
        'mo_ta_noi_dung',
        'tai_khoan_dang_tai',
        'trang_thai',
        'ban_quyen',
        'created_at',
        'updated_at',
    ];
}

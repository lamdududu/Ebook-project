<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'tac_pham',
        'hoa_don',
        'gia_thanh',
        'phien_ban',
    ];
}

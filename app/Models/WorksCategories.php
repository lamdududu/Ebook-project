<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorksCategories extends Model
{
    use HasFactory;
    protected $fillable = [
        'tac_pham',
        'the_loai',
    ];
}


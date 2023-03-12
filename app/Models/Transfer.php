<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends BaseModel
{
    use HasFactory,SoftDeletes;

    const status = [
        '1' => 'Beklemede',
        '2' => 'Onaylandı',
        '3' => 'Reddedildi',
    ];
}

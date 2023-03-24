<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends BaseModel
{
    use HasFactory;

    protected $fillable = ['name','is_status','phone','company_id','user_id'];
}

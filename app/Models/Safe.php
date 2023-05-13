<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Safe extends BaseModel
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','is_status','company_id','user_id'];

    public function invoice()
    {
        return $this->hasOne(Invoice::class,'id','invoice_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}

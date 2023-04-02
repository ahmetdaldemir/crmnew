<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalService extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'physical_condition',
        'accessories',
        'fault_information',
        'process',
        'products',
        'seller_id',
        'brand_id',
        'total_price',
        'customer_price',
        'process_type',
        'delivery_staff',
        'company_id',
        'user_id',
    ];

    protected $casts = ['products' => 'array'];


    public function seller()
    {
        return $this->hasOne(Seller::class,'id','seller_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class,'id','brand_id');
    }

    public function version()
    {
        return $this->hasOne(Version::class,'id','version_id');
    }

    public function delivery()
    {
        return $this->hasOne(User::class,'id','delivery_staff');
    }
    public function customer()
    {
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}

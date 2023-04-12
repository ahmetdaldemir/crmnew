<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalService extends Model
{
    use HasFactory;
    protected $casts = ['version_id' => 'array','products' => 'array'];

    protected $fillable = [
        'customer_id',
        'physical_condition',
        'accessories',
        'fault_information',
        'process',
        'products',
        'seller_id',
        'brand_id',
        'version_id',
        'total_price',
        'customer_price',
        'process_type',
        'delivery_staff',
        'company_id',
        'user_id',
    ];



    public function seller()
    {
        return $this->hasOne(Seller::class,'id','seller_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class,'brand','brand_id');
    }

    public function version()
    {
        $array = $this->version_id;
        $names = collect($array)->map(function($name, $key) {
            return Brand::find($name)->name;
        });
        return $names->toJson();
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

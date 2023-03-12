<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockCard extends BaseModel
{

    protected $table = "stock_cards";
    use HasFactory,SoftDeletes;


    protected $fillable = [
        'company_id',
        'user_id',
        'category_id',
        'warehouse_id',
        'seller_id',
        'brand_id',
        'version_id',
        'color_id',
        'sku',
        'barcode',
        'tracking',
        'unit',
        'tracking_quantity',
        'is_status',
        'name'
    ];

    public function hasSeller($id): string
    {
        return $this->seller_id == $id ? 'true':'false';
    }

    public function hasCategory($id): string
    {
        return $this->category_id == $id ? 'true':'false';
    }

    public function hasWarehouse($id): string
    {
        return $this->warehouse_id == $id ? 'true':'false';
    }

    public function hasBrand($id): string
    {
        return $this->brand_id == $id ? 'true':'false';
    }
    public function hasVersion($id): string
    {
        return $this->version_id == $id ? 'true':'false';
    }

    public function hasColor($id): string
    {
        return $this->color_id == $id ? 'true':'false';
    }

    public function hasStock($id): string
    {
        return $this->id == $id ? 'true':'false';
    }


    public function seller()
    {
        return $this->hasOne(Seller::class,'id','seller_id');
    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class,'id','warehouse_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class,'id','brand_id');
    }

    public function version()
    {
        return $this->hasOne(Version::class,'id','version_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Symfony\Component\Translation\t;

class StockCardMovement extends BaseModel
{

    protected $table = "stock_card_movements";
    use HasFactory,SoftDeletes;


    protected $fillable = [
        'stock_card_id',
        'user_id',
        'color_id',
        'warehouse_id',
        'seller_id',
        'reason_id',
        'type',
        'quantity',
        'serial_number',
        'invoice_id',
        'tax',
        'cost_price',
        'base_cost_price',
        'sale_price',
        'description',
        'assigned_accessory',
        'assigned_device'
    ];

    public function stock(): BelongsTo
    {
        return $this->belongsTo(StockCard::class,'stock_card_id','id');
    }
    public function quantityCheck($serial_number)
    {
      $in =  StockCardMovement::where('serial_number',$serial_number)->where('type',1)->sum('quantity');
      $out = StockCardMovement::where('serial_number',$serial_number)->where('type',2)->sum('quantity');
      return $in - $out;
    }

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
        return $this->stock_card_id == $id ? 'true':'false';
    }

    public function hasReason($id): string
    {
        return $this->reason_id == $id ? 'true':'false';
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

    public function transfer()
    {
        return $this->hasOne(Transfer::class,'stock_card_movement_id','id');
    }

    public function stockcard()
    {
        return StockCard::find($this->stock_card_id);
    }
}

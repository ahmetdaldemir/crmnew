<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalServiceProducts extends Model
{
    use HasFactory;


    public function stock_card()
    {
        return $this->hasOne(StockCard::class,"id","stock_card_id");
    }
}

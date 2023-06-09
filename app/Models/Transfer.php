<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends BaseModel
{
    use SoftDeletes;

    const STATUS = [
        '1' => 'Beklemede',
        '2' => 'Onaylandı',
        '3' => 'Reddedildi',
    ];

    const STATUS_COLOR = [
        '1' => 'primary',
        '2' => 'success',
        '3' => 'danger',
    ];


    protected $fillable = [
        'company_id',
        'user_id',
        'is_status',
        'main_seller_id',
        'comfirm_id',
        'comfirm_date',
        'delivery_id',
        'stocks',
        'number',
        'delivery_seller_id',
        'description',
        'serial_list'
    ];

    protected $casts = ['stocks' => 'array','serial_list' => 'array'];


    public function seller($id)
    {
      return Seller::find($id);
    }

    public function user($id)
    {
        return User::find($id);
    }

    public function hasStaff($id): string
    {
        return $this->staff_id == $id ? 'true':'false';
    }

    public function hasColor($id): string
    {
        return $this->color_id == $id ? 'true':'false';
    }


}

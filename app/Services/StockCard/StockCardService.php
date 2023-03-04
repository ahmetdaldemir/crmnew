<?php

namespace App\Services\StockCard;

use Illuminate\Database\Eloquent\Collection;
use LaravelEasyRepository\BaseService;

interface StockCardService extends BaseService{

    public function all(): ?Collection;
    public function get(): ?Collection;
}

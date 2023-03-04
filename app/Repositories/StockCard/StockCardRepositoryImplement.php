<?php

namespace App\Repositories\StockCard;

use Illuminate\Support\Facades\Auth;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\StockCard;

class StockCardRepositoryImplement extends Eloquent implements StockCardRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(StockCard $model)
    {
        $this->model = $model;
    }
    public function get()
    {
        return $this->model->where('company_id',Auth::user()->company_id)->get();
    }
}

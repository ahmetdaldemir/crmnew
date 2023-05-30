<?php

namespace App\Repositories\EInvoice;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\EInvoice;

class EInvoiceRepositoryImplement extends Eloquent implements EInvoiceRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(EInvoice $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}

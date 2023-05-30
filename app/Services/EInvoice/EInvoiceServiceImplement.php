<?php

namespace App\Services\EInvoice;

use LaravelEasyRepository\Service;
use App\Repositories\EInvoice\EInvoiceRepository;

class EInvoiceServiceImplement extends Service implements EInvoiceService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(EInvoiceRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}

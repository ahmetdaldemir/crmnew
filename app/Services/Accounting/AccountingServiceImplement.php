<?php

namespace App\Services\Accounting;

use LaravelEasyRepository\Service;
use App\Repositories\Accounting\AccountingRepository;

class AccountingServiceImplement extends Service implements AccountingService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(AccountingRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}

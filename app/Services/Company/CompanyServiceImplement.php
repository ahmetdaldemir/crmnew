<?php

namespace App\Services\Company;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use LaravelEasyRepository\Service;
use App\Repositories\Company\CompanyRepository;

class CompanyServiceImplement extends Service implements CompanyService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(CompanyRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function all(): ?Collection
    {
        try {
            return $this->mainRepository->all();
        } catch (\Exception $exception) {
            Log::debug($exception->getMessage());
            return [];
        }
    }
}

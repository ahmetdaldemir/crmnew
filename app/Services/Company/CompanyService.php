<?php

namespace App\Services\Company;

use Illuminate\Database\Eloquent\Collection;
use LaravelEasyRepository\BaseService;

interface CompanyService extends BaseService{

    public function all(): ?Collection;

}

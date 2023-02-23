<?php

namespace App\Services\User;

use Illuminate\Database\Eloquent\Collection;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService{

    public function all(): ?Collection;
}

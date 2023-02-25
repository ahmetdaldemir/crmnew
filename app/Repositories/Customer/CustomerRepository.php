<?php

namespace App\Repositories\Customer;

use LaravelEasyRepository\Repository;

interface CustomerRepository extends Repository{

    public function get();
    public function fileUpload($file);

}

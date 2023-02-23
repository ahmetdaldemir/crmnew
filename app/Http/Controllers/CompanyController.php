<?php

namespace App\Http\Controllers;

use App\Services\Company\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    protected function index()
    {
        $data['users'] = $this->companyService->all();
        return view('module.company.index',$data);
    }
}

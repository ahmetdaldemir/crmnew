<?php

namespace App\Http\Controllers;

use App\Services\Seller\SellerService;
use Illuminate\Http\Request;

class SellerController extends Controller
{

    private SellerService $sellerService;

    public function __construct(SellerService $sellerService)
    {
        $this->sellerService = $sellerService;
    }

    protected function index()
    {
        $data['users'] = $this->sellerService->all();
        return view('module.seller.index',$data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Jobs\ElogoCreateInvoice;
use App\Models\City;
use App\Services\Brand\BrandService;
use App\Services\Category\CategoryService;
use App\Services\Color\ColorService;
use App\Services\Customer\CustomerService;
use App\Services\Invoice\InvoiceService;
use App\Services\Reason\ReasonService;
use App\Services\Seller\SellerService;
use App\Services\StockCard\StockCardService;
use App\Services\User\UserService;
use App\Services\Version\VersionService;
use App\Services\Warehouse\WarehouseService;
use Illuminate\Http\Request;

class EInvoiceController extends Controller
{


    private InvoiceService $invoiceService;
    private SellerService $sellerService;
    private WarehouseService $warehouseService;
    private BrandService $brandService;
    private CategoryService $categoryService;
    private ColorService $colorService;
    private VersionService $versionService;
    private ReasonService $reasonService;
    private CustomerService $customerService;
    private UserService $userService;
    private StockCardService $stockCardService;


    public function __construct(InvoiceService   $invoiceService,
                                SellerService    $sellerService,
                                WarehouseService $warehouseService,
                                BrandService     $brandService,
                                CategoryService  $categoryService,
                                ColorService     $colorService,
                                VersionService   $versionService,
                                ReasonService    $reasonService,
                                CustomerService  $customerService,
                                UserService      $userService,
                                StockCardService $stockCardService
    )
    {
        $this->invoiceService = $invoiceService;
        $this->sellerService = $sellerService;
        $this->warehouseService = $warehouseService;
        $this->brandService = $brandService;
        $this->versionService = $versionService;
        $this->colorService = $colorService;
        $this->categoryService = $categoryService;
        $this->reasonService = $reasonService;
        $this->customerService = $customerService;
        $this->userService = $userService;
        $this->stockCardService = $stockCardService;
    }

    public function create(Request $request)
    {
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['users'] = $this->userService->get();
        $data['reasons'] = $this->reasonService->get();
        $data['customers'] = $this->customerService->get();
        $data['citys'] = City::all();
        $data['stocks'] = $this->stockCardService->all();
        $data['request'] = $request;
        $data['stocks'] = $this->stockCardService->filter($request->sell);
       return view('module.einvoice.form',$data);
    }

    public function e_invoice_create(Request $request)
    {
        ElogoCreateInvoice::dispatch($request)->delay(now()->addMinutes(1));
    }
}

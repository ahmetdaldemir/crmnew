<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Currency;
use App\Services\AccountingCategory\AccountingCategoryService;
use App\Services\Brand\BrandService;
use App\Services\Category\CategoryService;
use App\Services\Color\ColorService;
use App\Services\Customer\CustomerService;
use App\Services\Invoice\InvoiceService;
use App\Services\Reason\ReasonService;
use App\Services\Safe\SafeService;
use App\Services\Seller\SellerService;
use App\Services\StockCard\StockCardService;
use App\Services\User\UserService;
use App\Services\Version\VersionService;
use App\Services\Warehouse\WarehouseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
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
    private Currency $currency;
    private AccountingCategoryService $accountingCategoryService;
    private SafeService $safeService;


    public function __construct(InvoiceService            $invoiceService,
                                SellerService             $sellerService,
                                WarehouseService          $warehouseService,
                                BrandService              $brandService,
                                CategoryService           $categoryService,
                                ColorService              $colorService,
                                VersionService            $versionService,
                                ReasonService             $reasonService,
                                CustomerService           $customerService,
                                UserService               $userService,
                                StockCardService          $stockCardService,
                                Currency                  $currency,
                                AccountingCategoryService $accountingCategoryService,
                                SafeService               $safeService
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
        $this->currency = $currency;
        $this->accountingCategoryService = $accountingCategoryService;
        $this->safeService = $safeService;
        setlocale(LC_TIME, 'Turkish');  // ya da tr_TR.utf8

    }

    protected function index()
    {
        $data['invoices'] = $this->invoiceService->get();
        return view('module.sale.index',$data);
    }

    protected function create()
    {
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['users'] = $this->userService->get();
        $data['reasons'] = $this->reasonService->get();
        $data['customers'] = $this->customerService->get();
        $data['citys'] = City::all();
        $data['stocks'] = $this->stockCardService->all();
        $data['categories'] = $this->accountingCategoryService->all();
        $data['safes'] = $this->safeService->all();
        $data['taxs'] = ['0' => '%0','1' => '%1','8' => '%8','18' => '%18'];
        return view('module.sale.form',$data);
    }
    protected function edit(Request $request)
    {
        $data['invoices'] = $this->invoiceService->find($request->id);
        return view('module.sale.form',$data);
    }

    protected function delete(Request $request)
    {
        $this->invoiceService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        $data = array('name' => $request->name,'company_id' => Auth::user()->company_id);
        if(empty($request->id))
        {
            $this->invoiceService->create($data);
        }else{
            $this->invoiceService->update($request->id,$data);
        }

        return redirect()->route('sale.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->invoiceService->update($request->id,$data);
    }
}

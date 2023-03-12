<?php

namespace App\Http\Controllers;

use App\Enums\Unit;
use App\Models\City;
use App\Models\StockCardMovement;
use App\Models\Transfer;
use App\Services\Brand\BrandService;
use App\Services\Category\CategoryService;
use App\Services\Color\ColorService;
use App\Services\Customer\CustomerService;
use App\Services\Reason\ReasonService;
use App\Services\Seller\SellerService;
use App\Services\Invoice\InvoiceService;
use App\Services\StockCard\StockCardService;
use App\Services\User\UserService;
use App\Services\Version\VersionService;
use App\Services\Warehouse\WarehouseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
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

    protected function index()
    {
        $data['invoices'] = $this->invoiceService->get();
        $data['sellers'] = $this->sellerService->get();
        return view('module.invoice.index', $data);
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
        return view('module.invoice.form', $data);
    }

    protected function edit(Request $request)
    {
        $data['invoices'] = $this->invoiceService->find($request->id);
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['users'] = $this->userService->get();
        $data['reasons'] = $this->reasonService->get();
        $data['customers'] = $this->customerService->get();
        $data['citys'] = City::all();
        $data['stocks'] = $this->stockCardService->all();
        return view('module.invoice.form', $data);
    }

    protected function show(Request $request)
    {
        $data['invoice'] = $this->invoiceService->find($request->id);
        return view('module.invoice.show',$data);
    }

    protected function movement(Request $request)
    {
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['reasons'] = $this->reasonService->get();
        $data['stock_card_id'] = $request->id;
        $data['movements'] = InvoiceMovement::where('stock_card_id', $request->id)->get();
        return view('module.invoice.movement', $data);
    }

    protected function sevk(Request $request)
    {
        $serial_stock_card_movement = InvoiceMovement::where('serial_number', $request->serial_number)->first();

        if (is_null($serial_stock_card_movement) || $serial_stock_card_movement->quantityCheck($request->serial_number) >= 0) {
            return response()->json("Seri Numarası Bulunamadı Veya Stok Yetersiz", 400);
        }
        if ($serial_stock_card_movement->transfer->is_status == 1) {
            return response()->json("Beklemede olan sevk işlemi var", 400);
        }

        $transfer = new Transfer();
        $transfer->stock_card_id = $request->stock_card_id;
        $transfer->serial_number = $request->serial_number;
        $transfer->stock_card_movement_id = $serial_stock_card_movement->id;
        $transfer->user_id = Auth::user()->id;
        $transfer->is_status = 1;
        $transfer->save();
        return response()->json("Sevk Başlatıldı", 200);

    }

    protected function delete(Request $request)
    {
        $this->invoiceService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        $data = array(
            'type' => $request->type,
            'number' => $request->number,
            'create_date' => Carbon::parse($request->create_date)->format('Y-m-d'),
            'payment_type' => $request->payment_type,
            'description' => $request->description,
            'is_status' => 1,
            'total_price' => 1,
            'tax_total' => 1,
            'discount_total' => 1,
            'staff_id' => $request->staff_id,
            'customer_id' => $request->customer_id,
            'user_id' => Auth::user()->id,
            'company_id' => Auth::user()->company_id,
        );

        if (empty($request->id)) {
            $invoiceID = $this->invoiceService->create($data);
        } else {
            $this->invoiceService->update($request->id, $data);
            $invoiceID =  $this->invoiceService->find($request->id);
        }

        $this->stockCardService->add_movement($request->group_a, $invoiceID, $request->type);
        $total = 0;
        $taxtotal = 0;
        $discount_total = 0;

        foreach ($request->group_a as $item) {
            $total += $item['cost_price'] + (($item['cost_price'] *  $item['tax']) /100) * $item['quantity'];
            $taxtotal   += (($item['cost_price'] *  $item['tax']) /100) * $item['quantity'];
            $discount_total  +=  (($item['cost_price'] *  $item['discount'] ?? 0) /100) * $item['quantity'];
        }
         $totalprice = $total-$discount_total;

        $newdata = array(
            'total_price' => $totalprice,
            'discount_total' => $discount_total,
            'taxtotal' => $taxtotal,
        );

        $this->invoiceService->update($invoiceID->id, $newdata);

        return response()->json('Kaydedildi',200);
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->invoiceService->update($request->id, $data);
    }


}

<?php

namespace App\Http\Controllers;

use App\Enums\Unit;
use App\Models\Transfer;
use App\Services\Brand\BrandService;
use App\Services\Category\CategoryService;
use App\Services\Color\ColorService;
use App\Services\Reason\ReasonService;
use App\Services\Seller\SellerService;
use App\Services\Invoice\InvoiceService;
use App\Services\Version\VersionService;
use App\Services\Warehouse\WarehouseService;
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

    public function __construct(InvoiceService $invoiceService,
                                SellerService    $sellerService,
                                WarehouseService $warehouseService,
                                BrandService     $brandService,
                                CategoryService  $categoryService,
                                ColorService     $colorService,
                                VersionService   $versionService,
                                ReasonService    $reasonService
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
    }

    protected function index()
    {
        $data['invoices'] = $this->invoiceService->get();
        $data['sellers'] = $this->sellerService->get();
        return view('module.invoice.index', $data);
    }

    protected function create()
    {

        $data['brands'] = $this->brandService->get();
        $data['versions'] = $this->versionService->get();
        $data['categories'] = $this->categoryService->get();
        $data['units'] = Unit::Unit()->value;
        return view('module.invoice.form', $data);
    }

    protected function edit(Request $request)
    {
        $data['invoices'] = $this->invoiceService->find($request->id);
        $data['sellers'] = $this->sellerService->get();
        return view('module.invoice.form', $data);
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
        $serial_stock_card_movement = InvoiceMovement::where('serial_number',$request->serial_number)->first();

        if(is_null($serial_stock_card_movement) || $serial_stock_card_movement->quantityCheck($request->serial_number) >= 0)
        {
            return response()->json("Seri Numarası Bulunamadı Veya Stok Yetersiz", 400);
        }
        if($serial_stock_card_movement->transfer->is_status == 1)
        {
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
            'name' => $request->name,
            'company_id' => Auth::user()->company_id,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'version_id' => $request->version_id,
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'tracking' => $request->tracking == 'on' ? '1' : '0',
            'unit' => $request->unit_id,
            'tracking_quantity' => $request->tracking_quantity,
            'is_status' => 1,
        );

        if (empty($request->id)) {
            $this->invoiceService->create($data);
        } else {
            $this->invoiceService->update($request->id, $data);
        }

        return redirect()->route('invoice.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->invoiceService->update($request->id, $data);
    }


}

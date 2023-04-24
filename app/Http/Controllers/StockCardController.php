<?php

namespace App\Http\Controllers;

use App\Enums\Unit;
use App\Models\StockCard;
use App\Models\StockCardMovement;
use App\Models\Transfer;
use App\Models\User;
use App\Services\Brand\BrandService;
use App\Services\Category\CategoryService;
use App\Services\Color\ColorService;
use App\Services\FakeProduct\FakeProductService;
use App\Services\Reason\ReasonService;
use App\Services\Seller\SellerService;
use App\Services\StockCard\StockCardService;
use App\Services\Transfer\TransferService;
use App\Services\Version\VersionService;
use App\Services\Warehouse\WarehouseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockCardController extends Controller
{

    private StockCardService $stockcardService;
    private SellerService $sellerService;
    private WarehouseService $warehouseService;
    private BrandService $brandService;
    private CategoryService $categoryService;
    private ColorService $colorService;
    private VersionService $versionService;
    private ReasonService $reasonService;
    private FakeProductService $fakeProductService;
    private TransferService $transferService;

    public function __construct(StockCardService $stockcardService,
                                SellerService    $sellerService,
                                WarehouseService $warehouseService,
                                BrandService     $brandService,
                                CategoryService  $categoryService,
                                ColorService     $colorService,
                                VersionService   $versionService,
                                ReasonService    $reasonService,
                                FakeProductService $fakeProductService,
                                TransferService $transferService
    )
    {
        $this->stockcardService = $stockcardService;
        $this->sellerService = $sellerService;
        $this->warehouseService = $warehouseService;
        $this->brandService = $brandService;
        $this->versionService = $versionService;
        $this->colorService = $colorService;
        $this->categoryService = $categoryService;
        $this->reasonService = $reasonService;
        $this->fakeProductService = $fakeProductService;
        $this->transferService = $transferService;
    }

    protected function index()
    {
        $data['stockcards'] = $this->stockcardService->get();
        $data['sellers'] = $this->sellerService->get();
        return view('module.stockcard.index', $data);
    }

    protected function create()
    {
        $data['brands'] = $this->brandService->get();
        $data['versions'] = $this->versionService->get();
        $data['categories'] = $this->categoryService->get();
        $data['fakeproducts'] = $this->stockcardService->get();
        $data['units'] = Unit::Unit()->value;
        return view('module.stockcard.form', $data);
    }

    protected function edit(Request $request)
    {
        $data['stockcards'] = $this->stockcardService->find($request->id);
        $data['sellers'] = $this->sellerService->get();
        $data['brands'] = $this->brandService->get();
        $data['versions'] = $this->versionService->get();
        $data['categories'] = $this->categoryService->get();
        $data['fakeproducts'] = $this->fakeProductService->get();
        $data['units'] = Unit::Unit()->value;
        return view('module.stockcard.form', $data);
    }

    protected function movement(Request $request)
    {
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['reasons'] = $this->reasonService->get();
        $data['stock_card_id'] = $request->id;
        $data['movements'] = StockCardMovement::where('stock_card_id', $request->id)->get();
        return view('module.stockcard.movement', $data);
    }

    protected function sevk(Request $request)
    {
        $serial_stock_card_movement = StockCardMovement::where('serial_number',$request->serial_number)->first();

         if(is_null($serial_stock_card_movement) || $serial_stock_card_movement->quantityCheck($request->serial_number) <= 0)
        {
            return response()->json("Seri Numarası Bulunamadı Veya Stok Yetersiz", 400);
        }


        $stock = ['stock_card_id' => $request->stock_card_id];
        $serialList[$request->stock_card_id] = array($request->serial_number);

        $data = array(
            'company_id' => Auth::user()->company_id,
            'user_id' => Auth::user()->id,
            'is_status' => 1,
            'main_seller_id' => Auth::user()->seller_id,
            'delivery_id' => User::where('seller_id',$request->seller_id)->first()->id ?? 1,
            'description' => $request->description,
            'number' => $request->number??null,
            'stocks' => json_encode($stock),
            'serial_list' => json_encode($serialList),
            'delivery_seller_id' => $request->seller_id,
        );
        if (empty($request->id)) {
            $transfer = $this->transferService->create($data);
        } else {
            $transfer = $this->transferService->update($request->id, $data);
        }
        return response()->json($transfer, 200);

    }

    protected function delete(Request $request)
    {
        $this->stockcardService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        if(is_null($request->name))
        {
            $name = $request->fakeproduct;
        }else{
            $name = $request->name;
        }
        $data = array(
            'name' => $name,
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
            $this->stockcardService->create($data);
        } else {
            $this->stockcardService->update($request->id, $data);
        }

        return redirect()->route('stockcard.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->stockcardService->update($request->id, $data);
    }


}

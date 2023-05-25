<?php

namespace App\Http\Controllers;

use App\Enums\Unit;
use App\Models\Brand;
use App\Models\Category;
use App\Models\StockCard;
use App\Models\StockCardMovement;
use App\Models\StockCardPrice;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Version;
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
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function __construct(StockCardService   $stockcardService,
                                SellerService      $sellerService,
                                WarehouseService   $warehouseService,
                                BrandService       $brandService,
                                CategoryService    $categoryService,
                                ColorService       $colorService,
                                VersionService     $versionService,
                                ReasonService      $reasonService,
                                FakeProductService $fakeProductService,
                                TransferService    $transferService
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

    protected function index(Request $request)
    {
        $stockcards = $this->stockcardService->stockSearch($request);
        if ($stockcards) {
            $data['stockcards'] = $stockcards;
        } else {
            $stockcards = StockCard::all();
            foreach ($stockcards as $item) {
                $data[] = array(
                    'id' => $item->id,
                    'name' => $item->name,
                    'sku' => $item->sku,
                    'barcode' => $item->barcode,
                    'is_status' => $item->is_status,
                    'category' => $this->category($item->category_id) ?? "Bulunamadı",
                    'quantity' => (new \App\Models\StockCard)->quantityId($item->id),
                    'brand' => Brand::find($item->brand_id)->name ?? "Bulunamadı",
                    'version' => $this->version($item->version_id) ?? [],
                    'cost_price' => $item->stockCardPrice->cost_price,
                    'base_cost_price' => $item->stockCardPrice->cost_price,
                    'sale_price' => $item->stockCardPrice->cost_price,
                );
            }
            $data['stockcards'] = $data;
        }

        $data['sellers'] = $this->sellerService->get();
        $data['brands'] = $this->brandService->get();
        $data['categories'] = $this->categoryService->get();
        $data['reasons'] = $this->reasonService->get();
        return view('module.stockcard.index', $data);
    }

    public function category($categories)
    {
        if (gettype($categories) == 'array') {
            $json = $categories;
        } else {
            $json = json_decode($categories, TRUE);
        }
        foreach ($json as $item) {
            $category[] = Category::when($item, function ($query) use ($item) {
                $query->where('id', $item);
            })->first()->name ?? "Bulunamadı";
        }


        return $category;
    }

    public function version($versions)
    {
        if (gettype($versions) == 'array') {
            $json = $versions;
        } else {
            $json = json_decode($versions, TRUE);

        }
        foreach ($json as $item) {
            $version[] = Version::when($item, function ($query) use ($item) {
                $query->where('id', $item);
            })->first()->name ?? "Bulunamadı";
        }

        return $version;
    }

    protected function create(Request $request)
    {
        $data['brands'] = $this->brandService->get();
        $data['versions'] = $this->versionService->get();
        $data['categories'] = $this->categoryService->get();
       // $a = $this->categoryService->getList($request->category);
        // $data['categoriestest'] = $this->getNestedItems($a);
        //dd($data['categoriestest']);
        $data['fakeproducts'] = StockCard::select('name')->distinct()->get();
        $data['units'] = Unit::Unit()->value;
        $data['request'] = $request;
        return view('module.stockcard.form', $data);
    }

    function getNestedItems($input, $level = array()){

        $a = [];

        if(!empty($input))
        {
            foreach ($input as $item)
            {
                if(gettype($item) == 'array')
                {
                    $a[] = $item['name'].">";
                }

                if(is_array($item))
                {
                     $this->getNestedItems($item['list']);
                }else{
                    if(gettype($item) == 'array')
                    {
                        $a[] = $item['name'].">";
                    }
                }
            }

        }

        return $a;
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
        $serial_stock_card_movement = StockCardMovement::where('serial_number', $request->serial_number)->first();

        if (is_null($serial_stock_card_movement) || $serial_stock_card_movement->quantityCheck($request->serial_number) <= 0) {
            return response()->json("Seri Numarası Bulunamadı Veya Stok Yetersiz", 400);
        }

        $transfer = Transfer::whereJsonContains('serial_list', $request->serial_number)->whereNull('comfirm_id')->whereNull('comfirm_date')->first();
        if ($transfer) {
            return response()->json("Transferi kabul edilmemiş", 400);
        }
        $stock = ['stock_card_id' => $request->stock_card_id];
        $serialList[$request->stock_card_id] = array($request->serial_number);

        $data = array(
            'company_id' => Auth::user()->company_id,
            'user_id' => Auth::user()->id,
            'is_status' => 1,
            'main_seller_id' => Auth::user()->seller_id,
            'delivery_id' => User::where('seller_id', $request->seller_id)->first()->id ?? 1,
            'description' => $request->description,
            'number' => $request->number ?? rand(333333, 999999),
            'stocks' => $request->serial_number,
            'serial_list' => $request->serial_number,
            'delivery_seller_id' => $request->seller_id,
            'reason_id' => $request->reason_id,

        );

        $transfer = $this->transferService->create($data);

        return response()->json($transfer, 200);

    }

    protected function delete(Request $request)
    {
        $this->stockcardService->delete($request->id);
        $stockcardmovements = StockCardMovement::where('stock_card_id', $request->id)->get();
        foreach ($stockcardmovements as $stockcardmovement) {
            $stockcardmovement->delete();
        }
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        if (is_null($request->name)) {
            $name = $request->fakeproduct;
        } else {
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
    //public function list(Request $request)
    // {
    //     $data['stockcards'] = $this->stockcardService->get();
    //     $data['category'] = $request->id;
    //     $data['sellers'] = $this->sellerService->get();
    //     $data['brands'] = $this->brandService->get();
    //     $data['categories'] = $this->categoryService->get();
    //     return view('module.stockcard.list', $data);
    // }
    protected function show(Request $request)
    {
        $data['stockcardsmovement'] = StockCardMovement::where('stock_card_id', $request->id)->get();
        return view('module.stockcard.show', $data);
    }

    public function list(Request $request)
    {
        $categorylist = Category::where('id', $request->category_id)->orWhere('parent_id', $request->category_id)->get()->pluck('id')->toArray();
        $stockcardsList = StockCard::whereIn('category_id', $categorylist);

        if ($request->filled('brand')) {
            $stockcardsList->where('brand_id', $request->brand);
        }

        if ($request->filled('version')) {
            $stockcardsList->whereJsonContains('version_id', $request->version);
        }

        if ($request->filled('stockName')) {
            $stockcardsList->where('name', 'like', '%' . $request->stockName . '%');
        }

        $s = $stockcardsList->get()->pluck('id')->toArray();

        $t = StockCardMovement::whereIn('stock_card_id', $s);
        if ($request->filled('serialNumber')) {
            $t->where('serial_number', 'like', '%' . $request->serialNumber . '%');
        }
        if ($request->filled('seller')) {
            $t->where('seller_id', $request->seller);
        }
        $data['stockcards'] = $t->groupBy('serial_number')->having(DB::raw('count(serial_number)'), 1)->get();
        $data['category'] = $request->category_id;
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['brands'] = $this->brandService->get();
        $data['categories'] = $this->categoryService->get();
        return view('module.stockcard.list', $data);
    }

    public function priceupdate(Request $request)
    {
        $stockcardMovement = StockCardMovement::where('stock_card_id', $request->stock_card_id)->orderBy('id', 'desc')->first();
        $stockcardprice = new StockCardPrice();
        $stockcardprice->stock_card_id = $request->stock_card_id;
        $stockcardprice->user_id = Auth::id();
        $stockcardprice->company_id = Auth::user()->company_id;
        $stockcardprice->cost_price = $stockcardMovement->cost_price;
        $stockcardprice->base_cost_price = $stockcardMovement->base_cost_price;
        $stockcardprice->sale_price = $request->sale_price;
        $stockcardprice->save();

        $stockcardmovement = StockCardMovement::where('stock_card_id', $request->stock_card_id)->where('type', 1)->get();
        foreach ($stockcardmovement as $item) {
            $item->sale_price = $request->sale_price;
            $item->save();
        }
        return response()->json('Kayıt Güncellendi', 200);
    }

    public function singlepriceupdate(Request $request)
    {


        $stockcardmovement = StockCardMovement::where('id', $request->stock_card_id)->where('type', 1)->get();
        foreach ($stockcardmovement as $item) {
            $item->sale_price = $request->sale_price;
            $item->save();
        }
        return response()->json('Kayıt Güncellendi', 200);
    }

    public function singleserialprint(Request $request)
    {
        $movements = StockCardMovement::find($request->id);


        $data[] = array(
            'title' => 'Barkod',
            'id' => $movements->id,
            'serial_number' => $movements->serial_number,
            'sale_price' => $movements->sale_price,
            'brand_name' => $movements->stockcard()->brand->name,
            'name' => $movements->stockcard()->name,
            'version' => $this->getVersionMap($movements->stockcard()->version()),
        );


        $pdf = PDF::loadView('module.stockcard.print', ['data' => $data]);

        return $pdf->download('codesolutionstuff.pdf');

    }

    public function getVersionMap($map)
    {
        $datas = json_decode($map, TRUE);
        foreach ($datas as $mykey => $myValue) {
            return "$myValue,";
        }
    }

}

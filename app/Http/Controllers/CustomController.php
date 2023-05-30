<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Customer;
use App\Models\StockCard;
use App\Models\StockCardMovement;
use App\Models\Town;
use App\Models\Version;
use App\Services\Customer\CustomerService;
use App\Services\Seller\SellerService;
use App\Services\StockCard\StockCardService;
use App\Services\Transfer\TransferService;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomController extends Controller
{
    private CustomerService $customerService;
    private SellerService $sellerService;
    private StockCardService $stockCardService;
    private TransferService $transferService;

    protected StockCardMovement $stockCardMovement;

    public function __construct(CustomerService $customerService, SellerService $sellerService, StockCardService $stockCardService, TransferService $transferService)
    {
        $this->customerService = $customerService;
        $this->sellerService = $sellerService;
        $this->stockCardService = $stockCardService;
        $this->transferService = $transferService;
        $this->stockCardMovement = new StockCardMovement();
    }

    public function get_cities(Request $request)
    {
        $town = Town::where('city_id', $request->id)->get();
        return response()->json($town, 200);
    }

    public function customerstore(Request $request)
    {
        $data = array(
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'fullname' => $request->firstname . ' ' . $request->lastname,
            'iban' => $request->iban,
            'code' => Str::uuid(),
            'tc' => $request->tc,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'address' => $request->address,
            'city' => $request->city,
            'district' => $request->district,
            'email' => $request->email,
            'note' => $request->note,
            'seller_id' => $request->seller_id,
            'type' => $request->type,
            'company_id' => Auth::user()->company_id,
            'user_id' => Auth::id()
        );
        if (empty($request->id)) {
            $this->customerService->create($data);
        } else {
            $this->customerService->update($request->id, $data);
        }

        return Customer::latest()->first();
    }

    public function customerget(Request $request)
    {
        $data = $this->customerService->find($request->id);
        return response()->json($data, 200);
    }

    public function getStock(Request $request)
    {
        return $this->stockCardMovement->quantityCheck($request->serialCode);
    }

    public function get_version(Request $request)
    {
        $version = Version::where('brand_id', $request->id)->where('company_id', Auth::user()->company_id)->get();
        return $version;
    }

    public function getStockCard(Request $request)
    {
        $data = [];
        $in = StockCardMovement::where('stock_card_id', $request->id)->where('type', 1)->sum('quantity');
        $out = StockCardMovement::where('stock_card_id', $request->id)->where('type', 2)->sum('quantity');
        $quantity = $in - $out;
        $item = StockCardMovement::where('stock_card_id', $request->id)->where('type', 1)->orderBy('id', 'desc')->first();
        if ($item) {

            $data = array(
                'stockmovementId' => $item->id,
                'stockId' => $item->stock_card_id,
                'serialNumber' => $item->serial_number,
                'quantity' => $quantity,
                'salePrice' => $item->sale_price,
                'baseCostPrice' => $item->base_cost_price,
            );
        }
        return response()->json($data, 200);
    }


    public function customers()
    {
        $array = [];
        $data = $this->customerService->get();
        return response()->json($data, 200);
    }

    public function transferList()
    {
        return response()->json($this->transferService->get(), 200);
    }


    public function searchStockCard(Request $request)
    {
        $keyword = $request->key;
        $stockcard = StockCard::where('name', 'LIKE', '%' . $keyword . '%')->get();
        if (count($stockcard) == 0) {
            $stockcardmovement = StockCardMovement::where('serial_number', 'LIKE', '%' . $keyword . '%')->first();
            if ($stockcardmovement) {
                $stockcard[] = StockCard::find($stockcardmovement->stock_card_id);
            }
        }
        foreach ($stockcard as $item) {
            $data[] = array(
                'name' => $item->name . " - " . Brand::find($item->brand_id)->name . " - " . $this->getVersionName($item->version_id),
                'quantity' => $this->getStockQuantity($item->id),
            );
        }

        return response()->json($data, 200);

        //  $data = array(
        //      'stockmovementId' => $item->id,
        //      'stockId' => $item->stock_card_id,
        //      'serialNumber' => $item->serial_number,
        //      'quantity' => $quantity,
        //      'salePrice' => $item->sale_price,
        //      'bestCostPrice' => $item->best_cost_price,
        //  );
        //  return response()->json($data,200);
    }

    public function getVersionName($id)
    {
        $x = "";
        foreach ($id as $item) {
            $x .= "<b>" . Version::find($item)->name . "- <b>";
        }
        return $x;
    }


    public function getStockQuantity($id)
    {
        $request = new \Illuminate\Http\Request();

        $request->replace(['id' => $id]);

        return $this->stockCardMovement->quantityCheck($request);
    }


    public function stockSearch(Request $request)
    {

        if ($request->filled('serialNumber')) {
            $stockcardmovement = StockCardMovement::where('serial_number', $request->serialNumber);
            $in = $stockcardmovement->where('type', 1)->sum('quantity');
            $out = $stockcardmovement->where('type', 2)->sum('quantity');
            $response = $in - $out;
            if ($response > 0) {
                $stockcardmovement = StockCardMovement::where('serial_number', $request->serialNumber)->first();
                if ($stockcardmovement->quantityCheckData() <= 0) {
                    return response()->json(['autoredirect' => false, 'id' => $stockcardmovement->stock_card_id, 'serial' => $request->serialNumber], 200);;
                }
                return response()->json(['autoredirect' => true, 'id' => $stockcardmovement->stock_card_id, 'serial' => $request->serialNumber], 200);
            }
        }

        $data = [];
        $stock = DB::table('stock_cards')->whereNull('deleted_at');
        if ($request->filled('stockName')) {
            $stock->where('name', 'like', '%' . $request->stockName . '%');
        }
        if ($request->filled('category')) {
            $categorylist = Category::where('parent_id', $request->category)->pluck('id')->toArray();
            $categorylist[] = $request->category;
            $stock->whereIn('category_id', $categorylist);
        }

        if ($request->filled('brand')) {
            $stock->where('brand_id', $request->brand);
        }
        if ($request->filled('version')) {
            $stock = $stock->whereJsonContains('version_id', $request->version);
        }

        // $stocks =  array_merge((array)$stock->get(), (array)$stock1->get());
        $stocks = $stock->get();
        foreach ($stocks as $item) {
            $data[] = array(
                'id' => $item->id,
                'name' => $item->name,
                'sku' => $item->sku,
                'barcode' => $item->barcode,
                'category' => Category::find($item->category_id)->name ?? "Bulunamadı",
                'quantity' => (new \App\Models\StockCard)->quantityId($item->id),
                'brand' => Brand::find($item->brand_id)->name ?? "Bulunamadı",
                'version' => $this->version($item->version_id)
            );
        }
        return response()->json($data, 200);
    }

    public function version($versions)
    {
        if(gettype($versions) == 'array')
        {
            $json = $versions;

        }else{
            $json = json_decode($versions, TRUE);

        }
        foreach ($json as $item) {
            $version[] = Version::when($item, function ($query) use ($item) {
                $query->where('id', $item);
            })->first()->name ?? "Bulunamadı";
        }

        return $version;
    }

    public function serialcheck(Request $request)
    {
        $stockcardmovement = StockCardMovement::where('type', 1)->where("serial_number", $request->id)->first();

        if ($stockcardmovement) {
            $in = StockCardMovement::where('serial_number', $request->id)->where('type', 1)->sum('quantity');
            $out = StockCardMovement::where('serial_number', $request->id)->where('type', 2)->sum('quantity');
            $response = $in - $out;
            if ($response > 0) {
                return response()->json(true, 200);
            }
        }
        return response()->json(false, 200);
    }


    public function getStockCardCategory(Request $request)
    {
        $data = [];
        $newArray = array((int)$request->id);
        $ids = Category::where('parent_id', $request->id)->get()->pluck('id')->toArray();
        $categoryids = array_merge($ids, $newArray);

        $stocks = StockCard::whereIn('category_id', $categoryids)->get();
        if ($stocks) {
            foreach ($stocks as $item) {
                $data[] = array(
                    'id' => $item->id,
                    'name' => $item->name,
                    'sku' => $item->sku,
                    'barcode' => $item->barcode,
                    'category' => Category::find($item->category_id)->name ?? "Bulunamadı",
                    'quantity' => (new \App\Models\StockCard)->quantityId($item->id),
                    'brand' => Brand::find($item->brand_id)->name ?? "Bulunamadı",
                    'version' => $this->version($item->version_id),
                    'cost_price' => $item->stockCardPrice,
                    'base_cost_price' => $item->stockCardPrice,
                    'sale_price' => $item->stockCardPrice,
                );
            }
        }
        return response()->json($data, 200);
    }

    public function quantity($id)
    {
        $in = StockCardMovement::where('stock_card_id', $id)->where('type', 1)->sum('quantity');
        $out = StockCardMovement::where('stock_card_id', $id)->where('type', 2)->sum('quantity');
        $quantity = $in - $out;
        return $quantity;
    }

    public function getStockSeller(Request $request)
    {
         $StockIn = StockCardMovement::with('seller')->where('stock_card_id',$request->id)->where('type',1)
            ->selectRaw("SUM(quantity) as quantitya,seller_id")
            ->groupBy('seller_id')
            ->get();

         foreach ($StockIn as $item)
         {
             $data[] = array(
                 'sellerName' => $item->seller->name,
                 'quantity' => $item->quantitya - $this->SellerQuantityCalculate($item->seller_id,$request->id,$item->quantitya)
             );
         }
         return $data;
    }

    public function SellerQuantityCalculate($id,$stockId,$quantity)
    {
       return StockCardMovement::where('seller_id',$id)->where('stock_card_id',$stockId)->where('type',2)->sum('quantity');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\StockCardMovement;
use App\Models\Town;
use App\Models\Version;
use App\Services\Customer\CustomerService;
use App\Services\Seller\SellerService;
use App\Services\StockCard\StockCardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomController extends Controller
{
    private CustomerService $customerService;
    private SellerService $sellerService;
    private StockCardService $stockCardService;

    protected StockCardMovement $stockCardMovement;

    public function __construct(CustomerService $customerService, SellerService $sellerService, StockCardService $stockCardService)
    {
        $this->customerService = $customerService;
        $this->sellerService = $sellerService;
        $this->stockCardService = $stockCardService;
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
            'company_type' => $request->company_type,
            'web_sites' => $request->web_sites,
            'code' => Str::uuid(),
            'tc' => $request->tc,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'address' => $request->address,
            'city' => $request->city,
            'district' => $request->district,
            'email' => $request->email,
            'note' => $request->note,
            'image' => $request->file('image'),
            'seller_id' => $request->seller_id,
            'company_id' => Auth::user()->company_id,
            'user_id' => Auth::id()
        );
        if (empty($request->id)) {
            $this->customerService->create($data);
        } else {
            $this->customerService->update($request->id, $data);
        }

        return $data;
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
        $in =  StockCardMovement::where('stock_card_id',$request->id)->where('type',1)->sum('quantity');
        $out = StockCardMovement::where('stock_card_id',$request->id)->where('type',2)->sum('quantity');
        $quantity =  $in - $out;
        $item = StockCardMovement::where('stock_card_id',$request->id)->where('type',1)->orderBy('id','desc')->first();
        if($item)
        {
                $data = array(
                    'stockmovementId' => $item->id,
                    'stockId' => $item->stock_card_id,
                    'serialNumber' => $item->serial_number,
                    'quantity' => $quantity,
                    'salePrice' => $item->sale_price,
                    'bestCostPrice' => $item->best_cost_price,
                );
        }
        return response()->json($data,200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Safe;
use App\Models\Setting;
use App\Models\TechnicalCustomService;
use App\Models\TechnicalProcess;
use App\Models\TechnicalServiceProducts;
use App\Models\Town;
use App\Models\Version;
use App\Services\Brand\BrandService;
use App\Services\Customer\CustomerService;
use App\Services\Modules\Sms\SendSms;
use App\Services\Seller\SellerService;
use App\Services\StockCard\StockCardService;
use App\Services\Technical\TechnicalService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicalServiceController extends Controller
{

    private TechnicalService $technicalService;
    private StockCardService $stockCardService;
    private SellerService $sellerService;
    private CustomerService $customerService;
    private BrandService $brandService;
    private UserService $userService;

    public function __construct(
        TechnicalService $technicalService,
        StockCardService $stockCardService,
        SellerService    $sellerService,
        CustomerService  $customerService,
        BrandService     $brandService,
        UserService      $userService)
    {
        $this->technicalService = $technicalService;
        $this->stockCardService = $stockCardService;
        $this->sellerService = $sellerService;
        $this->customerService = $customerService;
        $this->brandService = $brandService;
        $this->userService = $userService;

    }

    protected function index()
    {
        $data['technical_services'] = $this->technicalService->get();
        $data['technical_covering_services'] = TechnicalCustomService::all();
        $data['brands'] = $this->brandService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['sms'] = Setting::where('category', 'sms')->get();
        $data['users'] = $this->userService->get();

        return view('module.technical_service.index', $data);
    }

    protected function create()
    {
        $data['stocks'] = $this->stockCardService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['customers'] = $this->customerService->get();
        $data['brands'] = $this->brandService->get();
        $data['users'] = $this->userService->get();
        $data['citys'] = City::all();
        $data['categories_all'] =  TechnicalProcess::all();
        $data['tows'] = Town::where('city_id',34)->get();

        return view('module.technical_service.form', $data);
    }
    protected function payment(Request $request)
    {
        $data['technical_service'] = \App\Models\TechnicalService::find($request->id);
        $data['users'] = $this->userService->get();
        return view('module.technical_service.payment', $data);
    }
    public function paymentcomplate(Request $request)
    {

        $total = $request->payment_type['cash'] + $request->payment_type['credit_card'] + $request->payment_type['installment'];
        if($total < $request->total_price)
        {
            return redirect()->back();
        }
        $technicalservice = \App\Models\TechnicalService::find($request->id);
        $technicalservice->payment_status = 1;
        $technicalservice->save();

        $safe = new Safe();
        $safe->name = "Şirket";
        $safe->company_id = Auth::user()->company_id;
        $safe->user_id = Auth::user()->id;
        $safe->seller_id = Auth::user()->seller_id;
        $safe->type = "in";
        $safe->incash = $request->payment_type['cash'] ?? 0;
        $safe->outcash = "0";
        $safe->amount = $request->total_price ?? 0;
        $safe->invoice_id = $request->id;
        $safe->credit_card = $request->payment_type['credit_card'] ?? 0;
        $safe->installment = 0;
        $safe->description = "Teknik Servis";
        $safe->save();

        return redirect()->back();
    }

    protected function edit(Request $request)
    {
        $data['technical_services'] = $this->technicalService->find($request->id);
        $data['stocks'] = $this->stockCardService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['customers'] = $this->customerService->get();
        $data['brands'] = $this->brandService->get();
        $data['users'] = $this->userService->get();
        $data['citys'] = City::all();
        return view('module.technical_service.form', $data);
    }
    protected function coveredit(Request $request)
    {
        $data['technical_service_cover'] = TechnicalCustomService::find($request->id);
        $data['stocks'] = $this->stockCardService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['customers'] = $this->customerService->get();
        $data['brands'] = $this->brandService->get();
        $data['users'] = $this->userService->get();
        $data['citys'] = City::all();
        $data['tows'] = Town::where('city_id',$data['technical_service_cover']->customer->city)->get();
        return view('module.technical_service.coveredit', $data);
    }
    protected function detail(Request $request)
    {
        $technical_services = $this->technicalService->find($request->id);
        $data['technical_services'] = $technical_services;
        $data['technical_service_products'] = TechnicalServiceProducts::where('technical_service_id',$request->id)->get();
        $data['stocks'] = $this->stockCardService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['customers'] = $this->customerService->get();
        $data['brands'] = $this->brandService->get();
        $data['versions'] = Version::where('brand_id',$technical_services->brand_id)->get();
        $data['users'] = $this->userService->get();
        $data['citys'] = City::all();
         return view('module.technical_service.detail', $data);
    }
    protected function show(Request $request)
    {
        $data['technical_services'] = $this->technicalService->find($request->id);
        $data['stocks'] = $this->stockCardService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['customers'] = $this->customerService->get();
        $data['brands'] = $this->brandService->get();
        $data['users'] = $this->userService->get();
        $data['citys'] = City::all();
        return view('module.technical_service.form', $data);
    }

    protected function delete(Request $request)
    {
        $this->technicalService->delete($request->id);
        return redirect()->back();
    }
    protected function categorydelete(Request $request)
    {
        $t = TechnicalProcess::find($request->id);
        $t->delete();
        return redirect()->back();
    }

    protected function detaildelete(Request $request)
    {
        $technicalService = \App\Models\TechnicalService::find($request->technical_service_id);
        if($technicalService->status == "new")
        {
            $technicalServiceProduct = TechnicalServiceProducts::find($request->id);
            $technicalServiceProduct->delete();
        }
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        $data = array(
            'customer_id' => $request->customer_id,
            'physical_condition' => $request->physical_condition,
            'accessories' => $request->accessories,
            'fault_information' => $request->fault_information,
            'products' => '',
            'accessory_category'=> $request->accessory_category,
            'physically_category'=> $request->physically_category,
            'fault_category'=> $request->fault_category,
            'seller_id' => $request->seller_id,
            'brand_id' => $request->brand_id,
            'version_id' => $request->version_id,
            'total_price' => $request->total_price,
            'customer_price' => $request->customer_price,
            'delivery_staff' => $request->delivery_staff,
            'device_password' => $request->device_password,
            'company_id' => Auth::user()->company_id,
            'status' => $request->status,
            'user_id' => Auth::user()->id
        );
        if (empty($request->id)) {
           $tech =  $this->technicalService->create($data);
        } else {
            $tech = $this->technicalService->update($request->id, $data);
            return  response()->json(true,200);

        }
         return  response()->json($tech->id,200);
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->technicalService->update($request->id, $data);
    }


    protected function detailstore(Request $request)
    {
        $detail = new TechnicalServiceProducts();
        $detail->user_id = Auth::id();
        $detail->company_id = Auth::user()->company_id;
        $detail->technical_service_id = $request->id;
        $detail->stock_card_id = $request->stock_card_id;
        $detail->stock_card_movement_id = $request->stock_card_movement_id;
        $detail->serial_number = $request->serial;
        $detail->quantity = $request->quantity;
        $detail->sale_price = $request->sale_price;
        $detail->save();
        return redirect()->back();
    }


    protected function sms(Request $request)
    {
        new SendSms($request);
        return redirect()->back();
    }


    protected function category()
    {
        $data['categories_all'] =  TechnicalProcess::all();
        return view('module.technical_service.process', $data);
    }

    protected function categorystore(Request $request)
    {
        $technicalprocess = new TechnicalProcess();
        $technicalprocess->name = $request->name;
        $technicalprocess->parent_id = $request->parent_id;
        $technicalprocess->company_id = Auth::user()->company_id;
        $technicalprocess->user_id = Auth::id();
        $technicalprocess->save();
        return redirect()->back();
     }

    public function covering(Request $request)
    {
        $data['stocks'] = $this->stockCardService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['customers'] = $this->customerService->get();
        $data['brands'] = $this->brandService->get();
        $data['users'] = $this->userService->get();
        $data['citys'] = City::all();
        $data['categories_all'] =  TechnicalProcess::all();
        $data['tows'] = Town::where('city_id',34)->get();
        return view('module.technical_service.covering', $data);
    }

    public function coveringstore(Request $request)
    {
        $technical_custom_service = new TechnicalCustomService();
        $technical_custom_service->company_id = Auth::user()->company_id;
        $technical_custom_service->user_id = Auth::user()->id;
        $technical_custom_service->brand_id = $request->brand_id;
        $technical_custom_service->seller_id = $request->seller_id;
        $technical_custom_service->version_id = $request->version_id;
        $technical_custom_service->customer_id = $request->customer_id;
        $technical_custom_service->total_price = $request->total_price;
        $technical_custom_service->customer_price = 0;
        $technical_custom_service->type = $request->type;
        $technical_custom_service->coating_information = $request->coating_information;
        $technical_custom_service->print_information = $request->print_information;
        $technical_custom_service->delivery_staff = $request->delivery_staff;
        $technical_custom_service->save();
        $id = $technical_custom_service->id;

        $safe = new Safe();
        $safe->name = "Şirket";
        $safe->company_id = Auth::user()->company_id;
        $safe->user_id = Auth::user()->id;
        $safe->seller_id = Auth::user()->seller_id;
        $safe->type = "in";
        $safe->incash = $request->payment_type['cash'] ?? 0;
        $safe->outcash = "0";
        $safe->amount = $request->total_price ?? 0;
        $safe->invoice_id = $id;
        $safe->credit_card = $request->payment_type['credit_card'] ?? 0;
        $safe->installment = 0;
        $safe->description = "Kaplama";
        $safe->save();

        return redirect()->to('technical_service');
    }
    public function coveringupdate(Request $request)
    {
        $technical_custom_service = TechnicalCustomService::find($request->id);
        $technical_custom_service->company_id = Auth::user()->company_id;
        $technical_custom_service->user_id = Auth::user()->id;
        $technical_custom_service->brand_id = $request->brand_id;
        $technical_custom_service->seller_id = $request->seller_id;
        $technical_custom_service->version_id = $request->version_id;
        $technical_custom_service->customer_id = $request->customer_id;
        $technical_custom_service->total_price = $request->total_price;
        $technical_custom_service->customer_price = 0;
        $technical_custom_service->type = $request->type;
        $technical_custom_service->coating_information = $request->coating_information;
        $technical_custom_service->print_information = $request->print_information;
        $technical_custom_service->delivery_staff = $request->delivery_staff;
        $technical_custom_service->save();

        $saferecord   =Safe::where('invoice_id',$request->id)->where('description','Kaplama')->first();
        $saferecord->delete();

        $safe = new Safe();
        $safe->name = "Şirket";
        $safe->company_id = Auth::user()->company_id;
        $safe->user_id = Auth::user()->id;
        $safe->seller_id = Auth::user()->seller_id;
        $safe->type = "in";
        $safe->incash = $request->payment_type['cash'] ?? 0;
        $safe->outcash = "0";
        $safe->amount = $request->total_price ?? 0;
        $safe->invoice_id = $request->id;
        $safe->credit_card = $request->payment_type['credit_card'] ?? 0;
        $safe->installment = 0;
        $safe->description = "Kaplama";
        $safe->save();

        return redirect()->to('technical_service');
    }


    public function coverprint(Request $request)
    {
        $data['cover'] = TechnicalCustomService::find($request->id);
        return view('module.technical_service.coverprint', $data);
    }

    public function print(Request $request)
    {
        $data['technical_service'] = \App\Models\TechnicalService::find($request->id);
        return view('module.technical_service.print', $data);
    }


}

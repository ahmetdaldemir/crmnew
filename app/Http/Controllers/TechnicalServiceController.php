<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Setting;
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
        $data['sms'] = Setting::where('category','sms')->get();
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
        return view('module.technical_service.form', $data);
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

    protected function delete(Request $request)
    {
        $this->technicalService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        $data = array(
           'customer_id' => $request->customer_id,
           'physical_condition' => $request->physical_condition,
           'accessories' => $request->accessories,
           'fault_information' => $request->fault_information,
           'process' => $request->process,
           'products' => json_encode($request->group_a),
           'seller_id' => $request->seller_id,
           'brand_id' => $request->brand_id,
           'total_price' => $request->total_price,
           'customer_price' => $request->customer_price,
           'process_type' => $request->process_type,
           'delivery_staff' => $request->delivery_staff,
           'company_id' => Auth::user()->company_id,
           'user_id' => Auth::user()->id
        );
        if (empty($request->id)) {
            $this->technicalService->create($data);
        } else {
            $this->technicalService->update($request->id, $data);
        }

        return redirect()->route('technical_service.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->technicalService->update($request->id, $data);
    }


    protected function sms(Request $request)
    {
        new SendSms($request);
        return redirect()->back();
    }
}

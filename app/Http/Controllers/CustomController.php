<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Town;
use App\Services\Customer\CustomerService;
use App\Services\Seller\SellerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomController extends Controller
{
    private CustomerService $customerService;
    private SellerService $sellerService;

    public function __construct(CustomerService $customerService,SellerService $sellerService)
    {
        $this->customerService = $customerService;
        $this->sellerService = $sellerService;
    }
   public function get_cities(Request $request)
   {
       $town =  Town::where('city_id',$request->id)->get();
       return response()->json($town,200);
   }

    public function customerstore(Request $request)
    {
        $data = array(
            'fullname' => $request->fullname,
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
            'image' => $request->file('image'),
            'seller_id' => $request->seller_id,
            'company_id' => Auth::user()->company_id,
            'user_id' => Auth::id()
        );
        if(empty($request->id))
        {
            $this->customerService->create($data);
        }else{
            $this->customerService->update($request->id,$data);
        }

        return $data;
    }

    public function customerget(Request $request)
    {
        $data = $this->customerService->find($request->id);
        return response()->json($data,200);

     }


}

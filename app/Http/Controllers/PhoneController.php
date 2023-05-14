<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\City;
use App\Models\Color;
use App\Models\Phone;
use App\Models\Safe;
use App\Models\Seller;
use App\Services\Brand\BrandService;
use App\Services\Invoice\InvoiceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneController extends Controller
{

    private InvoiceService $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    protected function index()
    {
        $data['phones'] = Phone::all()->sortByDesc('id');
        return view('module.phone.index', $data);
    }

    protected function create()
    {
        $data['brands'] = Brand::all();
        $data['colors'] = Color::all();
        $data['sellers'] = Seller::all();
        $data['citys'] = City::all();
        return view('module.phone.form', $data);
    }

    protected function edit(Request $request)
    {
        $data['phone'] = Phone::find($request->id);
        $data['brands'] = Brand::all();
        $data['colors'] = Color::all();
        $data['sellers'] = Seller::all();
        $data['citys'] = City::all();
        return view('module.phone.edit', $data);
    }

    protected function show(Request $request)
    {
        $data['phone'] = Phone::find($request->id);
        $data['brands'] = Brand::all();
        $data['colors'] = Color::all();
        $data['sellers'] = Seller::all();
        $data['citys'] = City::all();
        return view('module.phone.show', $data);
    }
    protected function sale(Request $request)
    {
        $data['phone'] = Phone::find($request->id);
        $data['citys'] = City::all();
        $data['sellers'] = Seller::all();
        $data['citys'] = City::all();
        return view('module.phone.sale', $data);
    }

    protected function barcode(Request $request)
    {
        $data['phone'] = Phone::find($request->id);
        return view('module.phone.barcode', $data);
    }

    protected function delete(Request $request)
    {
        $phone = Phone::find($request->id);
        $phone->delete();
        return redirect()->back();
    }

    protected function store(Request $request)
    {
          Phone::updateOrCreate(
            ['imei' => $request->imei],
            [
                'user_id' => $request->user_id,
                'company_id' => $request->company_id,
                'brand_id' => $request->brand_id,
                'version_id' => $request->version_id,
                'color_id' => $request->color_id,
                'seller_id' => $request->seller_id,
                'quantity' => $request->quantity,
                'type' => $request->type,
                'barcode' => $request->barcode,
                'description' => $request->description,
                'cost_price' => $request->cost_price,
                'sale_price' => $request->sale_price,
                'customer_id' => $request->customer_id,
                'altered_parts' => $request->altered_parts,
                'physical_condition' => $request->physical_condition,
                'memory' => $request->memory,
                'batery' => $request->batery,
                'warranty' => $request->warranty,
            ]
        );
        return redirect()->route('phone.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->brandService->update($request->id, $data);
    }

    public function salestore(Request $request)
    {
        $data = array(
            'type' => 2,
            'number' =>   null,
            'create_date' => date('Y-m-d'),
            'credit_card' => $request->payment_type['credit_card'],
            'cash' => $request->payment_type['cash'],
            'installment' => $request->payment_type['installment'],
            'description' => $request->description ?? null,
            'is_status' => 1,
            'total_price' => $request->payment_type['credit_card'] + $request->payment_type['cash'] + $request->payment_type['installment'],
            'tax_total' => 18,
            'discount_total' => $request->discount_total,
            'staff_id' => Auth::user()->id,
            'customer_id' => $request->customer_id ?? null,
            'user_id' => Auth::user()->id,
            'company_id' => Auth::user()->company_id,
            'exchange' =>  null,
            'tax' => 18,
            'file' =>  null,
            'paymentStatus' =>  1,
            'paymentDate' =>  date('Y-m-d'),
            'paymentStaff' =>  Auth::user()->id,
            'periodMounth' =>  date('m'),
            'periodYear' =>  date('Y'),
            'accounting_category_id' =>  9999999,
            'currency' =>  null,
            'safe_id' => null,
        );

        $invoiceID = $this->invoiceService->create($data);

        $safe = new Safe();
        $safe->name = "Şirket";
        $safe->company_id = Auth::user()->company_id;
        $safe->user_id = Auth::user()->id;
        $safe->seller_id = Auth::user()->seller_id;
        $safe->type = "in";
        $safe->incash = $request->payment_type['cash'];
        $safe->outcash ="0";
        $safe->amount =	 $request->payment_type['cash'] + $request->payment_type['credit_card']  + $request->payment_type['installment'];
        $safe->invoice_id = $invoiceID->id;
        $safe->credit_card = $request->payment_type['credit_card'];
        $safe->installment = $request->payment_type['installment'];
        $safe->description = "TELEFON";
        $safe->save();

        $phone = Phone::find($request->phone_id);
        $phone->invoice_id = $invoiceID->id;
        $phone->status = 1;
        $phone->save();
    }
}

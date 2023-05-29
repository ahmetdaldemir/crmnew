<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\Color;
use App\Models\Phone;
use App\Models\Safe;
use App\Models\Seller;
use App\Models\StockCard;
use App\Models\StockCardMovement;
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
        $data['brands'] = Brand::all();
        $data['colors'] = Color::all();
        $data['sellers'] = Seller::all();
        $data['phones'] = Phone::where('company_id', Auth::user()->company_id)->orderBy('id', 'desc')->get();
        return view('module.phone.index', $data);
    }


    public function list(Request $request)
    {
        $stockcardsList = Phone::where('company_id', Auth::user()->company_id);

        if ($request->filled('brand')) {
            $stockcardsList->where('brand_id', $request->brand);
        }

        if ($request->filled('version')) {
            $stockcardsList->where('version_id', $request->version);
        }

        if ($request->filled('color')) {
            $stockcardsList->where('color_id', $request->color);
        }

        if ($request->filled('barcode')) {
            $stockcardsList->where('barcode', $request->barcode);
        }

        if ($request->filled('seller')) {
            $stockcardsList->where('seller_id', $request->seller);
        }
        $data['brands'] = Brand::all();
        $data['colors'] = Color::all();
        $data['sellers'] = Seller::all();
        $data['phones'] = $stockcardsList;
        return view('module.phone.index', $data);
    }

    protected function create()
    {
        $this->authorize('create-phone');
        $data['brands'] = Brand::where('company_id', Auth::user()->company_id)->get();
        $data['colors'] = Color::where('company_id', Auth::user()->company_id)->get();
        $data['sellers'] = Seller::where('company_id', Auth::user()->company_id)->get();
        $data['citys'] = City::all();
        return view('module.phone.form', $data);
    }

    protected function edit(Request $request)
    {
        $this->authorize('create-phone');

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
        $this->authorize('create-phone');

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
                'barcode' => 'PH' . rand(1111111, 9999999),
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

    protected function confirm(Request $request)
    {
        $phone = Phone::find($request->id);
        $phone->is_confirm = 1;
        $phone->save();
        return redirect()->back();
    }

    protected function printconfirm(Request $request)
    {
        $data['phone'] = Phone::find($request->id);
        return view('module.phone.printconfirm', $data);
    }

    public function salestore(Request $request)
    {

        $salePrice = $request->payment_type['credit_card'] + $request->payment_type['cash'] + $request->payment_type['installment'];
        if ($salePrice < $request->sale_price) {
            return redirect()->back();
        }


        $data = array(
            'type' => 2,
            'number' => null,
            'create_date' => date('Y-m-d'),
            'credit_card' => $request->payment_type['credit_card'] ?? 0,
            'cash' => $request->payment_type['cash'] ?? 0,
            'installment' => $request->payment_type['installment'] ?? 0,
            'description' => $request->description ?? null,
            'is_status' => 1,
            'total_price' => $request->payment_type['credit_card'] + $request->payment_type['cash'] + $request->payment_type['installment'],
            'tax_total' => 18,
            'discount_total' => $request->discount_total,
            'staff_id' => Auth::user()->id,
            'customer_id' => $request->customer_id ?? null,
            'user_id' => Auth::user()->id,
            'company_id' => Auth::user()->company_id,
            'exchange' => null,
            'tax' => 18,
            'file' => null,
            'paymentStatus' => 1,
            'paymentDate' => date('Y-m-d'),
            'paymentStaff' => Auth::user()->id,
            'periodMounth' => date('m'),
            'periodYear' => date('Y'),
            'accounting_category_id' => 9999999,
            'currency' => null,
            'safe_id' => null,
        );

        $invoiceID = $this->invoiceService->create($data);

        $safe = new Safe();
        $safe->name = "Şirket";
        $safe->company_id = Auth::user()->company_id;
        $safe->user_id = Auth::user()->id;
        $safe->seller_id = Auth::user()->seller_id;
        $safe->type = "in";
        $safe->incash = $request->payment_type['cash'] ?? 0;
        $safe->outcash = "0";
        $safe->amount = $request->payment_type['cash'] ?? 0 + $request->payment_type['credit_card'] ?? 0 + $request->payment_type['installment'] ?? 0;
        $safe->invoice_id = $invoiceID->id;
        $safe->credit_card = $request->payment_type['credit_card'] ?? 0;
        $safe->installment = $request->payment_type['installment'] ?? 0;
        $safe->description = "TELEFON";
        $safe->save();

        $phone = Phone::find($request->phone_id);
        $phone->invoice_id = $invoiceID->id;
        $phone->status = 1;
        $phone->save();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Enums\Tax;
use App\Models\AccountingCategory;
use App\Models\City;
use App\Models\Currency;
use App\Models\Invoice;
use App\Models\Safe;
use App\Models\StockCardMovement;
use App\Models\Transfer;
use App\Services\AccountingCategory\AccountingCategoryService;
use App\Services\Brand\BrandService;
use App\Services\Category\CategoryService;
use App\Services\Color\ColorService;
use App\Services\Customer\CustomerService;
use App\Services\Reason\ReasonService;
use App\Services\Safe\SafeService;
use App\Services\Seller\SellerService;
use App\Services\Invoice\InvoiceService;
use App\Services\StockCard\StockCardService;
use App\Services\User\UserService;
use App\Services\Version\VersionService;
use App\Services\Warehouse\WarehouseService;
use Carbon\Carbon;
use elogo_api\elogo_api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Picqer\Barcode\BarcodeGeneratorHTML;
use SN;

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
    private CustomerService $customerService;
    private UserService $userService;
    private StockCardService $stockCardService;
    private Currency $currency;
    private AccountingCategoryService $accountingCategoryService;
    private SafeService $safeService;


    public function __construct(InvoiceService            $invoiceService,
                                SellerService             $sellerService,
                                WarehouseService          $warehouseService,
                                BrandService              $brandService,
                                CategoryService           $categoryService,
                                ColorService              $colorService,
                                VersionService            $versionService,
                                ReasonService             $reasonService,
                                CustomerService           $customerService,
                                UserService               $userService,
                                StockCardService          $stockCardService,
                                Currency                  $currency,
                                AccountingCategoryService $accountingCategoryService,
                                SafeService               $safeService
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
        $this->customerService = $customerService;
        $this->userService = $userService;
        $this->stockCardService = $stockCardService;
        $this->currency = $currency;
        $this->accountingCategoryService = $accountingCategoryService;
        $this->safeService = $safeService;
        setlocale(LC_TIME, 'Turkish');  // ya da tr_TR.utf8

    }

    protected function index(Request $request)
    {
        $data['invoices'] = $this->invoiceService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['type'] = $request->type;
        return view('module.invoice.index', $data);
    }

    protected function create(Request $request)
    {
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['users'] = $this->userService->get();
        $data['reasons'] = $this->reasonService->get();
        $data['customers'] = $this->customerService->get();
        $data['citys'] = City::all();
        $data['stocks'] = $this->stockCardService->all();
        $data['categories'] = $this->accountingCategoryService->all();
        $data['safes'] = $this->safeService->all();
        $data['taxs'] = ['0' => '%0', '1' => '%1', '8' => '%8', '18' => '%18'];
        $data['stock_card_id'] = $request->id;
        return view('module.invoice.form', $data);
    }

    protected function fast()
    {
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['users'] = $this->userService->get();
        $data['reasons'] = $this->reasonService->get();
        $data['customers'] = $this->customerService->get();
        $data['citys'] = City::all();
        $data['currencies'] = $this->currency->all();
        $data['taxs'] = ['0' => '%0', '1' => '%1', '8' => '%8', '18' => '%18'];
        $data['categories'] = $this->accountingCategoryService->all();
        $data['safes'] = $this->safeService->all();
        return view('module.invoice.fast', $data);
    }


    protected function personal()
    {
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['users'] = $this->userService->get();
        $data['reasons'] = $this->reasonService->get();
        $data['customers'] = $this->customerService->get();
        $data['citys'] = City::all();
        $data['currencies'] = $this->currency->all();
        $data['taxs'] = ['0' => '%0', '1' => '%1', '8' => '%8', '18' => '%18'];
        $data['categories'] = $this->accountingCategoryService->all();
        $data['safes'] = $this->safeService->all();
        return view('module.invoice.personal', $data);
    }


    protected function bank()
    {
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['users'] = $this->userService->get();
        $data['categories'] = $this->accountingCategoryService->all();
        $data['safes'] = $this->safeService->all();
        $data['currencies'] = $this->currency->all();
        return view('module.invoice.bank', $data);
    }


    protected function tax()
    {
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['users'] = $this->userService->get();
        $data['currencies'] = $this->currency->all();
        $data['taxs'] = ['0' => '%0', '1' => '%1', '8' => '%8', '18' => '%18'];
        $data['categories'] = $this->accountingCategoryService->all();
        $data['safes'] = $this->safeService->all();
        return view('module.invoice.tax', $data);
    }


    protected function edit(Request $request)
    {
        $data['invoices'] = $this->invoiceService->find($request->id);
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['users'] = $this->userService->get();
        $data['reasons'] = $this->reasonService->get();
        $data['customers'] = $this->customerService->get();
        $data['citys'] = City::all();
        $data['stocks'] = $this->stockCardService->all();
        $data['categories'] = $this->accountingCategoryService->all();
        $data['safes'] = $this->safeService->all();
        $data['taxs'] = ['0' => '%0', '1' => '%1', '8' => '%8', '18' => '%18'];
        return view('module.invoice.form', $data);
    }

    protected function show(Request $request)
    {
        $data['invoice'] = $this->invoiceService->find($request->id);
        return view('module.invoice.show', $data);
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
        $serial_stock_card_movement = InvoiceMovement::where('serial_number', $request->serial_number)->first();

        if (is_null($serial_stock_card_movement) || $serial_stock_card_movement->quantityCheck($request->serial_number) >= 0) {
            return response()->json("Seri Numarası Bulunamadı Veya Stok Yetersiz", 400);
        }
        if ($serial_stock_card_movement->transfer->is_status == 1) {
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
            'type' => $request->type,
            'number' => $request->number ?? null,
            'create_date' => Carbon::parse($request->create_date)->format('Y-m-d') ?? null,
            'payment_type' => $request->payment_type,
            'description' => $request->description ?? null,
            'is_status' => 1,
            'total_price' => 1,
            'tax_total' => 1,
            'discount_total' => 1,
            'staff_id' => $request->staff_id ?? null,
            'customer_id' => $request->customer_id ?? null,
            'user_id' => Auth::user()->id,
            'company_id' => Auth::user()->company_id,
            'exchange' => $request->exchange ?? null,
            'tax' => $request->tax ?? null,
            'file' => $request->file ?? null,
            'paymentStatus' => $request->paymentStatus ?? null,
            'paymentDate' => $request->paymentDate ?? null,
            'paymentStaff' => $request->paymentStaff ?? null,
            'periodMounth' => $request->periodMounth ?? null,
            'periodYear' => $request->periodYear ?? null,
            'accounting_category_id' => $request->accounting_category_id ?? null,
            'currency' => $request->currency ?? null,
            'safe_id' => $request->safe_id ?? null,
        );

        if (empty($request->id)) {
            $invoiceID = $this->invoiceService->create($data);
        } else {
            $this->invoiceService->update($request->id, $data);
            $invoiceID = $this->invoiceService->find($request->id);
        }

        if (isset($request->group_a)) {

            if (empty($request->id)) {
                $this->stockCardService->add_movement($request->group_a, $invoiceID, $request->type);
            } else {
                $this->stockCardService->add_movementupdate($request->group_a, $invoiceID, $request->type);
            }

            $total = 0;
            $taxtotal = 0;
            $discount_total = 0;

            foreach ($request->group_a as $item) {
                $costprice = str_replace(",", ".", $item['cost_price']);
                $total += $costprice + (($costprice * $item['tax']) / 100) * $item['quantity'];
                $taxtotal += (($costprice * $item['tax']) / 100) * $item['quantity'];
                $discount_total += (($costprice * $item['discount'] ?? 0) / 100) * $item['quantity'];
            }
            $totalprice = $total - $discount_total;

            $newdata = array(
                'total_price' => $totalprice,
                'discount_total' => $discount_total,
                'taxtotal' => $taxtotal,
            );

            $this->invoiceService->update($invoiceID->id, $newdata);
        }

        $total = $request->payment_type['cash'] +  $request->payment_type['credit_card'];
        $safe = new Safe();
        $safe->name = "Şirket";
        $safe->company_id = Auth::user()->company_id;
        $safe->user_id = Auth::user()->id;
        $safe->type = "out";
        $safe->incash = $request->payment_type['cash'] ?? 0;
        $safe->outcash ="0";
        $safe->amount =	 $total ?? 0;
        $safe->invoice_id = $invoiceID->id;
        $safe->credit_card = $request->payment_type['credit_card'] ?? 0;
        $safe->installment = 0;
        $safe->description = AccountingCategory::find($request->accounting_category_id)->name;
        $safe->save();

        return response()->json('Kaydedildi', 200);
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->invoiceService->update($request->id, $data);
    }


    public function einvoice()
    {
        $elogo_username = '3600330874';
        $elogo_password = 'Erktelekom123*';

        $elogo = new elogo_api($elogo_username, $elogo_password, false);
        $elogo->invoce_prefix = 'ERK'; //FATURA NUMARASI OLUŞTURMASI İÇİN EN FAZLA 3 KARAKTER

        $result = $elogo->get_documents_list();
        dd($result['message']->Document);
        //E-ARŞİV FATURASI BİLGİSİ ALMA
        // $result = $elogo->get_document_info('1dfe9cfa-2c86-4e28-b7f5-5104faf00197', 'EARCHIVE');
        // print_r($result);
        // //E-ARŞİV FATURASI BİLGİSİ ALMA

        // //E-FATURA BİLGİSİ ALMA
        // $result = $elogo->get_document_info('1dfe9cfa-2c86-4e28-b7f5-5104faf00197', 'EINVOICE');
        // print_r($result);
        // //E-FATURA BİLGİSİ ALMA

    }


    public function serialprint(Request $request)
    {
        $movements = $this->stockCardService->getInvoiceForSerial($request->id);
        return view('module.stockcard.print', compact('movements'));
    }

    public function sales(Request $request)
    {
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['users'] = $this->userService->get();
        $data['reasons'] = $this->reasonService->get();
        $data['customers'] = $this->customerService->get();
        $data['citys'] = City::all();
        $data['stocks'] = $this->stockCardService->all();
        $data['categories'] = $this->accountingCategoryService->all();
        $data['safes'] = $this->safeService->all();
        $data['taxs'] = ['0' => '%0', '1' => '%1', '8' => '%8', '18' => '%18'];
        $data['request'] = $request;
        $product = $this->stockCardService->getStockData($request);
        if (empty($product['stock_card'])) {
            return redirect()->back();
        }
        $data['product'] = $this->stockCardService->getStockData($request);
        return view('module.invoice.sales', $data);
    }

    public function salesedit(Request $request)
    {
        $data['warehouses'] = $this->warehouseService->get();
        $data['sellers'] = $this->sellerService->get();
        $data['colors'] = $this->colorService->get();
        $data['users'] = $this->userService->get();
        $data['reasons'] = $this->reasonService->get();
        $data['customers'] = $this->customerService->get();
        $data['citys'] = City::all();
        $data['stocks'] = $this->stockCardService->all();
        $data['categories'] = $this->accountingCategoryService->all();
        $data['safes'] = $this->safeService->all();
        $data['taxs'] = ['0' => '%0', '1' => '%1', '8' => '%8', '18' => '%18'];
        $data['request'] = $request;

        $data['invoice'] = Invoice::find($request->id);
        $data['stockcardmovements'] = StockCardMovement::where('invoice_id', $request->id)->get();
        return view('module.invoice.salesedit', $data);
    }

    public function salesstore(Request $request)
    {

        foreach ($request->group_a as $item) {
            $stockcard = StockCardMovement::where('serial_number', $item['serial'])->where('type', 1)->orderBy('id', 'desc')->first();
            if (!$stockcard) {
                return false;
            }
        }

        $data = array(
            'type' => $request->type,
            'number' => $request->number ?? null,
            'create_date' => Carbon::parse($request->create_date)->format('Y-m-d') ?? null,
            'credit_card' => $request->payment_type['credit_card'],
            'cash' => $request->payment_type['cash'],
            'installment' => $request->payment_type['installment'],
            'description' => $request->description ?? null,
            'is_status' => 1,
            'total_price' => 1,
            'tax_total' => 1,
            'discount_total' => 1,
            'staff_id' => $request->staff_id ?? null,
            'customer_id' => $request->customer_id ?? null,
            'user_id' => Auth::user()->id,
            'company_id' => Auth::user()->company_id,
            'exchange' => $request->exchange ?? null,
            'tax' => $request->tax ?? null,
            'file' => $request->file ?? null,
            'paymentStatus' => $request->paymentStatus ?? null,
            'paymentDate' => $request->paymentDate ?? null,
            'paymentStaff' => $request->paymentStaff ?? null,
            'periodMounth' => $request->periodMounth ?? null,
            'periodYear' => $request->periodYear ?? null,
            'accounting_category_id' => $request->accounting_category_id ?? null,
            'currency' => $request->currency ?? null,
            'safe_id' => $request->safe_id ?? null,
        );
        if (empty($request->id)) {
            $invoiceID = $this->invoiceService->create($data);
        } else {
            $this->invoiceService->update($request->id, $data);
            $invoiceID = $this->invoiceService->find($request->id);
        }

        if (isset($request->group_a)) {
            $this->stockCardService->add_movement_sales($request->group_a, $invoiceID, $request->type);
            $total = 0;
            $taxtotal = 0;
            $discount_total = 0;

            foreach ($request->group_a as $item) {
                $total += $item['sale_price'] + (($item['sale_price'] * 18) / 100) * 1;
                $taxtotal += (($item['sale_price'] * 18) / 100) * 1;
                $discount_total += (($item['sale_price'] * $item['discount'] ?? 0) / 100) * 1;
            }
            $totalprice = $total - $discount_total;

            $newdata = array(
                'total_price' => $totalprice,
                'discount_total' => $discount_total,
                'taxtotal' => $taxtotal,
            );

            $this->invoiceService->update($invoiceID->id, $newdata);
        }

        $safe = new Safe();
        $safe->name = "Şirket";
        $safe->company_id = Auth::user()->company_id;
        $safe->user_id = Auth::user()->id;
        $safe->type = "in";
	    $safe->incash = $request->payment_type['cash'];
        $safe->outcash ="0";
	 	$safe->amount =	 $request->payment_type['cash'] + $request->payment_type['credit_card']  + $request->payment_type['installment'];
        $safe->invoice_id = $invoiceID->id;
        $safe->credit_card = $request->payment_type['credit_card'];
        $safe->installment = $request->payment_type['installment'];
        $safe->description = "SATIŞ";
        $safe->save();

        return response()->json('Kaydedildi', 200);
    }

    public function salesupdate(Request $request)
    {

        foreach ($request->group_a as $item) {
            $stockcard = StockCardMovement::where('serial_number', $item['serial'])->where('type', 2)->orderBy('id', 'desc')->first();
            if (!$stockcard) {
                return false;
            }
        }

        $data = array(
            'type' => $request->type,
            'number' => $request->number ?? null,
            'create_date' => Carbon::parse($request->create_date)->format('Y-m-d') ?? null,
            'credit_card' => $request->payment_type['credit_card'],
            'cash' => $request->payment_type['cash'],
            'installment' => $request->payment_type['installment'],
            'description' => $request->description ?? null,
            'is_status' => 1,
            'total_price' => 1,
            'tax_total' => 1,
            'discount_total' => 1,
            'staff_id' => $request->staff_id ?? null,
            'customer_id' => $request->customer_id ?? null,
            'user_id' => Auth::user()->id,
            'company_id' => Auth::user()->company_id,
            'exchange' => $request->exchange ?? null,
            'tax' => $request->tax ?? null,
            'file' => $request->file ?? null,
            'paymentStatus' => $request->paymentStatus ?? null,
            'paymentDate' => $request->paymentDate ?? null,
            'paymentStaff' => $request->paymentStaff ?? null,
            'periodMounth' => $request->periodMounth ?? null,
            'periodYear' => $request->periodYear ?? null,
            'accounting_category_id' => $request->accounting_category_id ?? null,
            'currency' => $request->currency ?? null,
            'safe_id' => $request->safe_id ?? null,
        );
        $this->invoiceService->update($request->id, $data);
        $invoiceID = $this->invoiceService->find($request->id);
        if (isset($request->group_a)) {
            $this->stockCardService->add_movement_update($request->group_a, $invoiceID, $request->type);
            $total = 0;
            $taxtotal = 0;
            $discount_total = 0;

            foreach ($request->group_a as $item) {
                $total += $item['sale_price'] + (($item['sale_price'] * 18) / 100) * 1;
                $taxtotal += (($item['sale_price'] * 18) / 100) * 1;
                $discount_total += (($item['sale_price'] * $item['discount'] ?? 0) / 100) * 1;
            }
            $totalprice = $total - $discount_total;

            $newdata = array(
                'total_price' => $totalprice,
                'discount_total' => $discount_total,
                'taxtotal' => $taxtotal,
            );

            $this->invoiceService->update($invoiceID->id, $newdata);
        }
        return response()->json('Kaydedildi', 200);
    }

}

<?php

namespace App\Http\Controllers;

use App\Jobs\SendTransferInfo;
use App\Models\StockCardMovement;
use App\Services\Color\ColorService;
use App\Services\Reason\ReasonService;
use App\Services\Seller\SellerService;
use App\Services\StockCard\StockCardService;
use App\Services\Transfer\TransferService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{

    private TransferService $transferService;
    private SellerService $sellerService;
    private StockCardService $stockCardService;
    private ReasonService $reasonService;
    private UserService $userService;
    private ColorService $colorService;

    public function __construct(TransferService  $transferService,
                                SellerService    $sellerService,
                                StockCardService $stockCardService,
                                UserService      $userService,
                                ReasonService    $reasonService,
                                ColorService     $colorService,
    )
    {
        $this->transferService = $transferService;
        $this->sellerService = $sellerService;
        $this->stockCardService = $stockCardService;
        $this->reasonService = $reasonService;
        $this->userService = $userService;
        $this->colorService = $colorService;

    }

    protected function index()
    {
        $data['transfers'] = $this->transferService->all();
        return view('module.transfer.index', $data);
    }

    protected function create()
    {
        $data['sellers'] = $this->sellerService->get();
        $data['stocks'] = $this->stockCardService->all();
        $data['reasons'] = $this->reasonService->get();
        $data['users'] = $this->userService->get();
        $data['colors'] = $this->colorService->get();

        return view('module.transfer.form', $data);
    }

    protected function edit(Request $request)
    {
        $data['sellers'] = $this->sellerService->get();
        $data['stocks'] = $this->stockCardService->all();
        $data['reasons'] = $this->reasonService->get();
        $data['users'] = $this->userService->get();
        $data['colors'] = $this->colorService->get();
        $data['transfers'] = $this->transferService->find($request->id);
        return view('module.transfer.form', $data);
    }

    protected function delete(Request $request)
    {
        $this->transferService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        $data = array(
            'company_id' => Auth::user()->company_id,
            'user_id' => Auth::user()->id,
            'is_status' => 1,
            'main_seller_id' => Auth::user()->seller_id,
            'delivery_id' => $request->delivery_id,
            'description' => $request->description,
            'number' => $request->number??null,
            'stocks' => array_unique($request->sevkList),
            'serial_list' => array_unique($request->sevkList),
            'delivery_seller_id' => $request->delivery_seller_id,
        );

        if (empty($request->id)) {
            $transfer = $this->transferService->create($data);
        } else {
            $transfer = $this->transferService->update($request->id, $data);
        }
        //$this->dispatch(new SendTransferInfo($transfer));
        return response()->json('Transfer Gerçekleşti', 200);
    }

    protected function update(Request $request)
    {
        $transfer = $this->transferService->find($request->id);
        if ($transfer->serial_list) {
            foreach ($transfer->serial_list as $key => $value) {
                foreach ($value as $item) {
                    StockCardMovement::where('serial_number', $item)->update(['seller_id' => $transfer->delivery_seller_id]);
                }
            }
            $data = array('is_status' => $request->is_status);
            $this->transferService->update($request->id, $data);
            return redirect()->back();
        }
        return redirect()->back()->withErrors(['msg' => 'Seri Numaraları Seçilmedi']);
    }

    protected function show(Request $request)
    {
        $data['transfer'] = $this->transferService->find($request->id);
        return view('module.transfer.show', $data);
    }

    public function getSerialList($stockCardId, $quantity,$color_id)
    {
        return StockCardMovement::select('serial_number')->where('stock_card_id', $stockCardId)->where('color_id', $color_id)->pluck('serial_number')->take($quantity);
    }
}

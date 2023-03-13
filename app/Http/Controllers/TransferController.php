<?php

namespace App\Http\Controllers;

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
        $stock = $request->group_a;

        $data = array(
            'company_id' => Auth::user()->company_id,
            'user_id' => Auth::user()->id,
            'is_status' =>1,
            'main_seller_id' => Auth::user()->seller_id,
            'delivery_id' =>$request->delivery_id,
            'description' =>$request->description,
            'number' =>$request->number,
            'stocks' => json_encode($stock),
            'delivery_seller_id' =>$request->delivery_seller_id,
        );

        if (empty($request->id)) {
            $this->transferService->create($data);
        } else {
            $this->transferService->update($request->id, $data);
        }

        return response()->json('Transfer Gerçekleşti',200);
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->transferService->update($request->id, $data);
    }

    protected function show(Request $request)
    {
        $data['transfer'] = $this->transferService->find($request->id);
        return view('module.transfer.show',$data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\Seller\SellerService;
use App\Services\StockCard\StockCardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockCardController extends Controller
{

    private StockCardService $stockcardService;
    private SellerService $sellerService;

    public function __construct(StockCardService $stockcardService, SellerService $sellerService)
    {
        $this->stockcardService = $stockcardService;
        $this->sellerService = $sellerService;
    }

    protected function index()
    {
        $data['stockcards'] = $this->stockcardService->get();
        return view('module.stockcard.index',$data);
    }

    protected function create()
    {
        $data['sellers'] = $this->sellerService->get();
        return view('module.stockcard.form',$data);
    }
    protected function edit(Request $request)
    {
        $data['stockcards'] = $this->stockcardService->find($request->id);
        $data['sellers'] = $this->sellerService->get();
        return view('module.stockcard.form',$data);
    }

    protected function delete(Request $request)
    {
        $this->stockcardService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        $data = array('name' => $request->name,'company_id' => Auth::user()->company_id,'user_id' => Auth::user()->id);
        if(empty($request->id))
        {
            $this->stockcardService->create($data);
        }else{
            $this->stockcardService->update($request->id,$data);
        }

        return redirect()->route('stockcard.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->stockcardService->update($request->id,$data);
    }
}

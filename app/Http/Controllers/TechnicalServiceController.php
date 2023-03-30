<?php

namespace App\Http\Controllers;

use App\Services\Seller\SellerService;
use App\Services\StockCard\StockCardService;
use App\Services\Technical\TechnicalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicalServiceController extends Controller
{

    private TechnicalService $technicalService;
    private StockCardService $stockCardService;
    private SellerService $sellerService;

    public function __construct(TechnicalService $technicalService,StockCardService $stockCardService,SellerService $sellerService)
    {
        $this->technicalService = $technicalService;
        $this->stockCardService = $stockCardService;
        $this->sellerService = $sellerService;
    }

    protected function index()
    {
        $data['technical_services'] = $this->technicalService->get();
        return view('module.technical_service.index',$data);
    }

    protected function create()
    {
        $data['stocks'] = $this->stockCardService->get();
        $data['sellers'] = $this->sellerService->get();

        return view('module.technical_service.form',$data);
    }
    protected function edit(Request $request)
    {
        $data['technical_services'] = $this->technicalService->find($request->id);
        return view('module.technical_service.form',$data);
    }

    protected function delete(Request $request)
    {
        $this->technicalService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        $data = array('name' => $request->name,'phone' => $request->phone,'company_id' => Auth::user()->company_id,'user_id' => Auth::user()->id);
        if(empty($request->id))
        {
            $this->technicalService->create($data);
        }else{
            $this->technicalService->update($request->id,$data);
        }

        return redirect()->route('technical_service.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->technicalService->update($request->id,$data);
    }
}

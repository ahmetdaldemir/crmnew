<?php

namespace App\Http\Controllers;

use App\Services\Seller\SellerService;
use Illuminate\Http\Request;

class SellerController extends Controller
{

    private SellerService $sellerService;

    public function __construct(SellerService $sellerService)
    {
        $this->sellerService = $sellerService;
    }

    protected function index()
    {
        $data['sellers'] = $this->sellerService->get();
        return view('module.seller.index',$data);
    }

    protected function create()
    {
        return view('module.seller.form');
    }
    protected function edit(Request $request)
    {
        $data['sellers'] = $this->sellerService->find($request->id);
        return view('module.seller.form',$data);
    }

    protected function delete(Request $request)
    {
        $this->sellerService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        $data = array('name' => $request->name,'phone' => $request->phone);
        if(empty($request->id))
        {
            $this->sellerService->create($data);
        }else{
            $this->sellerService->update($request->id,$data);
        }

        return redirect()->route('seller.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->sellerService->update($request->id,$data);
    }
}

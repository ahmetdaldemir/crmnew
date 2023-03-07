<?php

namespace App\Http\Controllers;

use App\Services\Transfer\TransferService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{

    private TransferService $transferService;

    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    protected function index()
    {
        $data['transfers'] = $this->transferService->all();
        return view('module.transfer.index',$data);
    }

    protected function create()
    {
        return view('module.transfer.form');
    }
    protected function edit(Request $request)
    {
        $data['transfers'] = $this->transferService->find($request->id);
        return view('module.transfer.form',$data);
    }

    protected function delete(Request $request)
    {
        $this->transferService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        $data = array('name' => $request->name,'phone' => $request->phone,'company_id' => Auth::user()->company_id);
        if(empty($request->id))
        {
            $this->transferService->create($data);
        }else{
            $this->transferService->update($request->id,$data);
        }

        return redirect()->route('transfer.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->transferService->update($request->id,$data);
    }
}

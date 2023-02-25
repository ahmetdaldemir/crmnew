<?php

namespace App\Http\Controllers;

use App\Services\Safe\SafeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SafeController extends Controller
{
    private SafeService $safeService;

    public function __construct(SafeService $safeService)
    {
        $this->safeService = $safeService;
    }

    protected function index()
    {
        $data['safes'] = $this->safeService->get();
        return view('module.safe.index',$data);
    }

    protected function create()
    {
        return view('module.safe.form');
    }
    protected function edit(Request $request)
    {
        $data['safes'] = $this->safeService->find($request->id);
        return view('module.safe.form',$data);
    }

    protected function delete(Request $request)
    {
        $this->safeService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        $data = array('name' => $request->name,'company_id' => Auth::user()->company_id,'user_id'=>Auth::id());
        if(empty($request->id))
        {
            $this->safeService->create($data);
        }else{
            $this->safeService->update($request->id,$data);
        }

        return redirect()->route('safe.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->safeService->update($request->id,$data);
    }
}

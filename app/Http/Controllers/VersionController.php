<?php

namespace App\Http\Controllers;

use App\Services\Version\VersionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VersionController extends Controller
{
    private VersionService $versionService;

    public function __construct(VersionService $versionService)
    {
        $this->versionService = $versionService;
    }
    protected function index()
    {
        $data['versions'] = $this->versionService->get();
        return view('module.version.index',$data);
    }

    protected function create(Request $request)
    {
        $data['brand_id'] = $request->id;
        return view('module.version.form',$data);
    }
    protected function edit(Request $request)
    {
        $data['versions'] = $this->versionService->find($request->id);
        return view('module.version.form',$data);
    }

    protected function delete(Request $request)
    {
        $this->versionService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        $data = array('name' => $request->name,'brand_id' => $request->brand_id,'image' => $request->file('image'),'company_id' => Auth::user()->company_id,'user_id' => Auth::id());
        if(empty($request->id))
        {
            $this->versionService->create($data);
        }else{
            $this->versionService->update($request->id,$data);
        }

        return redirect()->route('version.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->versionService->update($request->id,$data);
    }
}

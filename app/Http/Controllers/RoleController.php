<?php

namespace App\Http\Controllers;

use App\Services\Role\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    protected function index()
    {
        $data['sellers'] = $this->roleService->get();
        return view('module.role.index',$data);
    }

    protected function create()
    {
        return view('module.role.form');
    }
    protected function edit(Request $request)
    {
        $data['sellers'] = $this->roleService->find($request->id);
        return view('module.role.form',$data);
    }

    protected function delete(Request $request)
    {
        $this->roleService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        $data = array('name' => $request->name,'phone' => $request->phone);
        if(empty($request->id))
        {
            $this->roleService->create($data);
        }else{
            $this->roleService->update($request->id,$data);
        }

        return redirect()->route('role.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->roleService->update($request->id,$data);
    }
}

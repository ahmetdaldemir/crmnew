<?php

namespace App\Http\Controllers;

use App\Services\Seller\SellerService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private UserService $userService;
    private SellerService $sellerService;

    public function __construct(UserService $userService, SellerService $sellerService)
    {
        $this->userService = $userService;
        $this->sellerService = $sellerService;
    }

    protected function index()
    {
        $data['users'] = $this->userService->all();
        $data['roles'] = Role::all();
        return view('module.users.index', $data);
    }

    protected function create()
    {
        $data['sellers'] = $this->sellerService->get();
        $data['roles'] = Role::all();
        return view('module.users.form', $data);
    }

    protected function edit(Request $request)
    {
        $data['users'] = $this->userService->find($request->id);
        $data['roles'] = Role::all();
        $data['sellers'] = $this->sellerService->get();
        return view('module.users.form', $data);
    }

    protected function delete(Request $request)
    {
        $this->userService->delete($request->id);
        return redirect()->back();
    }

    protected function store(Request $request)
    {
        if($request->filled('password'))
        {
            $data = array(
                'name' => $request->name, 'email' => $request->email,
                'company_id' => Auth::user()->company_id,
                'user_id' => Auth::user()->id,
                'seller_id' =>$request->seller_id,
                'is_status' => 1,
                'password' => bcrypt($request->password));
        }else{
            $data = array(
                'name' => $request->name, 'email' => $request->email,
                'company_id' => Auth::user()->company_id,
                'user_id' => Auth::user()->id,
                'seller_id' =>$request->seller_id,
                'is_status' => 1,
                'password' => bcrypt($request->password));
        }

        if (empty($request->id)) {
            $this->userService->create($data);
            $user_id = $this->userService->lastInsertId();
        } else {
            $this->userService->update($request->id, $data);
            $user_id = $request->id;
        }

        $this->userService->role($user_id, $request->role);
        return redirect()->route('user.index');
    }

    protected function update(Request $request)
    {
        $data = array('is_status' => $request->is_status);
        return $this->userService->update($request->id, $data);
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $data['settings'] = Setting::all();
        return view('module.settings.index',$data);
    }


    public function store(Request $request)
    {
        $setting = new Setting();
        $setting->key = $request->key;
        $setting->value = $request->value;
        $setting->type = $request->type;
        $setting->category = $request->category;
        $setting->company_id = Auth::user()->company_id;
        $setting->user_id = Auth::user()->id;
        $setting->save();
        return redirect()->back();
    }
}

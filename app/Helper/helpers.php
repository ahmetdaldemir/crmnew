<?php

if (! function_exists('setting')) {
    function setting($key) {
        \App\Models\Setting::where('key',$key)->first()->value;
    }
}


if (! function_exists('sevkcount')) {
    function sevkcount() {
      return  \App\Models\Transfer::where('delivery_seller_id',auth()->user()->seller_id)->where('is_status',1)->get()->count();
    }
}


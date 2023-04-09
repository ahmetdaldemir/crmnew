<?php

if (! function_exists('setting')) {
    function setting($key) {
        \App\Models\Setting::where('key',$key)->first()->value;
    }
}

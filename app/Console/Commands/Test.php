<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Version;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $brands = Brand::all();
        foreach ($brands as $brand)
        {
            $brandall = \DB::table('brands_test')->where('brand',$brand->name)->get();
            foreach ($brandall as $key)
            {
                $version = new Version();
                $version->name = $key->model;
                $version->image = "";
                $version->brand_id = $brand->id;
                $version->user_id = 1;
                $version->company_id = 1;
                $version->is_status = 1;
                $version->save();
            }
        }

    }
}

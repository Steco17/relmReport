<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords = [
        	['id'=>1, 'name'=>'Put Power','status'=>1],
        	['id'=>2, 'name'=>'Rudeeely Arrogant Clothing','status'=>1],
        	['id'=>3, 'name'=>'Monte Carlo','status'=>1],
        	['id'=>4, 'name'=>'Striveille','status'=>1],
        	['id'=>5, 'name'=>'Thieves','status'=>1],
        ];

          Brand::insert($brandRecords);
    }
}

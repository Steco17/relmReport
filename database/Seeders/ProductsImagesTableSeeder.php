<?php

use Illuminate\Database\Seeder;
use App\ProductsImage;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImageRecords = [
            ['id'=>1,'product_id'=>3,'images'=>'19702211_10209547972711818_8590282203149249672_n.jpg-49199.jpg', 'status'=>1]
        ];
        ProductsImage::insert($productImageRecords);
    }
}

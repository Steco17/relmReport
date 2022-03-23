<?php

use Illuminate\Database\Seeder;
use App\ProductsAttribute;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productArributesRecords = [
            ['id'=>1,'product_id'=>1, 'size'=>'Small', 'price'=>200, 'stock'=>10, 'sku'=>'ST005', 'status'=>1],
            ['id'=>2,'product_id'=>1, 'size'=>'Medium', 'price'=>600, 'stock'=>10, 'sku'=>'ST005', 'status'=>1],
            ['id'=>3,'product_id'=>1, 'size'=>'Large', 'price'=>400, 'stock'=>10, 'sku'=>'ST005', 'status'=>1]
        ];

        ProductsAttribute::insert($productArributesRecords);
    }
}

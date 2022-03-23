<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
       // $this->call(ProductsTableSeeder::class);
        //$this->call(ProductsAttributesTableSeeder::class);
        //$this->call(ProductsImagesTableSeeder::class);
        //$this->call(BrandsTableSeeder::class);
    	//$this->call(SectionstableSeeder::class);
        //$this->call(CategoryTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}

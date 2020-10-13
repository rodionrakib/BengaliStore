<?php

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(ProductCategory::class)->create([ 'name' => 'Shirt' , 'slug' => 'shirt']);
        factory(ProductCategory::class)->create([ 'name' => 'Sharee' , 'slug' => 'sharee']);
        factory(ProductCategory::class)->create([ 'name' => 'Kamis' , 'slug' => 'kamis']);
        factory(ProductCategory::class)->create([ 'name' => 'T-Shirt' , 'slug' => 't-shirt']);
    }
}

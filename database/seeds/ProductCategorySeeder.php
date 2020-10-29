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
        
        $fasCat = factory(ProductCategory::class)->create([ 'name' => 'Fashion' , 'slug' => 'fashion']);
        $men = factory(ProductCategory::class)->create([ 'name' => 'Men' , 'slug' => 'men']);
        $women = factory(ProductCategory::class)->create([ 'name' => 'Women' , 'slug' => 'women']);
        $jw = factory(ProductCategory::class)->create([ 'name' => 'jewellery' , 'slug' => 'jewellery']);
        $fasCat->appendNode($men);
        $fasCat->appendNode($women);
        $fasCat->appendNode($jw);
    }
}

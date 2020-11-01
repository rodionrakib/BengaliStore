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
        
        $women = factory(ProductCategory::class)->create([ 'name' => 'Woman\'s Fashion' , 'slug' => 'womans-fashion']);
        $men = factory(ProductCategory::class)->create([ 'name' => 'Men\'s Shopping'   , 'slug' => 'mens-shopping']);

        $shirt =  factory(ProductCategory::class)->create([ 'name' => 'Shirt'   , 'slug' => 'shirt']);
        $tShirt =  factory(ProductCategory::class)->create([ 'name' => 'T-Shirt'   , 'slug' => 't-shirt']);
        $pant =  factory(ProductCategory::class)->create([ 'name' => 'Pant'   , 'slug' => 'pant']);
        $panjabi =  factory(ProductCategory::class)->create([ 'name' => 'Panjabi'   , 'slug' => 'panjabi']);
        
        $men->appendNode($shirt);
        $men->appendNode($tShirt);
        $men->appendNode($pant);
        $men->appendNode($panjabi);

        $shari =  factory(ProductCategory::class)->create([ 'name' => 'Sharee'   , 'slug' => 'sharee']);
        $kurti =  factory(ProductCategory::class)->create([ 'name' => 'Kurti'   , 'slug' => 'kurti']);
        $salwar =  factory(ProductCategory::class)->create([ 'name' => 'Salwar Kamis'   , 'slug' => 'salwar-kamis']);

        $women->appendNode($shari);
        $women->appendNode($kurti);
        $women->appendNode($salwar);


    }
}

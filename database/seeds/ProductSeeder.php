<?php

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class ProductSeeder extends Seeder
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

        $file = UploadedFile::fake()->image('product.png', 600, 600);
        factory(Product::class,4)->states(['featured','enabled'])->create()->each(function($product) use($women,$salwar,$file){
          $product->categories()->attach([$women->id,$salwar->id]);
          // $product->addCover($file);
        });

        factory(Product::class,4)->states(['featured','enabled'])->create()->each(function($product) use($men,$shirt,$file){
          $product->categories()->attach([$men->id,$shirt->id]);
          // $product->addCover($file);
        });


    }
}

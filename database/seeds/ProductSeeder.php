<?php

use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // factory(Size::class)->create(['name'=> 'Large','short_name'=>'L']);
       // factory(Size::class)->create(['name'=> 'Medium','short_name'=>'M']);
       // factory(Size::class)->create(['name'=> 'Small','short_name'=>'S']);
       // factory(Size::class)->create(['name'=> 'Extra Large','short_name'=>'XL']);

       factory(Product::class,10)->create();


    }
}

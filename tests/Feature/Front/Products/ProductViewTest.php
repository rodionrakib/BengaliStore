<?php

namespace Tests\Feature\Front\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductViewTest extends TestCase
{
    use RefreshDatabase;

    // /** @test */
    // public function can_visit_product_single_view()
    // {
    //     $this->withoutExceptionHandling();

    //     $product = factory(Product::class)->create([
    //         'title' => 'Silver Porto Headset',
    //         'slug' => 'silver-proto-headset',
    //         'price' => 2500,
    //         'short_description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non',
    //         'long_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat',
    //         'featured' => false,  

    //     ]);


    //     $this->get('products/'.$product->slug)
    //     ->assertSee('Silver Porto Headset')
    //     ->assertSee("Tk 2500")
    //     ->assertSee('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non')
    //     ->assertSee('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat');

    // }


    // /** @test */
    // public function home_page_display_featured_products()
    // {
    //     $this->withoutExceptionHandling();
    //     $fp =  factory(Product::class)->state('featured')->create();
    //     $this->get('/')->assertSee($fp->title)->assertSee($fp->price);
    // }

    // public function product_single_can_find_populat_items_form_its_category()
    // {
    //     $men = factory(ProductCategory::class)->create([ 'name' => 'Men\'s Shopping'   , 'slug' => 'mens-shopping']);

    //     $shirt =  factory(ProductCategory::class)->create([ 'name' => 'Shirt'   , 'slug' => 'shirt']);
    //     $tShirt =  factory(ProductCategory::class)->create([ 'name' => 'T-Shirt'   , 'slug' => 't-shirt']);
    //     $pant =  factory(ProductCategory::class)->create([ 'name' => 'Pant'   , 'slug' => 'pant']);
    //     $panjabi =  factory(ProductCategory::class)->create([ 'name' => 'Panjabi'   , 'slug' => 'panjabi']);
        
    //     $men->appendNode($shirt);
    //     $men->appendNode($tShirt);
    //     $men->appendNode($pant);
    //     $men->appendNode($panjabi);


    //     $product = factory(Product::class)->create();
    //     $product->categories()->attach([$men->id,$shirt->id]);

        

    // }


}

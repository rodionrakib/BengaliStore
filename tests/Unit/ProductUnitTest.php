<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductUnitTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function can_find_visible_product()
	{
		$disabledProduct = factory(Product::class)->state('disabled')->create();
		$enabledProduct = factory(Product::class)->state('enabled')->create();

		$visibleProducts = Product::visible()->get();

		$this->assertFalse($visibleProducts->contains($disabledProduct));
		$this->assertTrue($visibleProducts->contains($enabledProduct));
	}
    /** @test */
    public function can_find_featured_product()
    {
    	$fp = factory(Product::class)->states('featured','enabled',)->create();
    	$nfp = factory(Product::class)->states( 'enabled')->create();

    	$this->assertTrue(Product::featured()->get()->contains($fp)); 
    	$this->assertFalse(Product::featured()->get()->contains($nfp));
    }

    /** @test */
    public function product_category_can_find_products_order_by_popularity()
    {
    	// have a category with 3 products 
    	$category = factory(ProductCategory::class)->create();
    	// product one count 3 
    	$productOne = factory(Product::class)->create(['view_count' =>  3]);
    	$productTwo = factory(Product::class)->create(['view_count' =>  7]);
    	$productThree = factory(Product::class)->create(['view_count' =>  2]);
    	// product two  count 7
    	// product one 2
    	$category->products()->attach([$productOne->id,$productTwo->id,$productThree->id]);

    	$popularProducts = $category->popularProducts(2);
    	$this->assertEquals($popularProducts->first()->id,$productTwo->id);
    	$this->assertEquals(2,$popularProducts->count());


    }

    /** @test */
    public function can_count_product_view()
    {
    	$product = factory(Product::class)->create(['view_count' =>  0]);

    	$this->get($product->path());

    	$fresh = $product->fresh();

    	$this->assertEquals(1,$fresh->view_count);

    	$this->get($product->path());

    	$fresh = $product->fresh();

    	$this->assertEquals(2,$fresh->view_count);

    }
}

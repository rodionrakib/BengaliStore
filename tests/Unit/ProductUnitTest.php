<?php

namespace Tests\Unit;

use App\Models\Product;
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
}

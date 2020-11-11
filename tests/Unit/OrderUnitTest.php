<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderUnitTest extends TestCase
{
	use RefreshDatabase;
    


    /** @test */
    public function order_can_have_many_products()
    {
    	$order = factory(Order::class)->create();
    	$productOne = factory(Product::class)->create();
    	$productTwo = factory(Product::class)->create();

    	$order->addProduct($productOne);
    	$order->addProduct($productTwo);

    	$this->assertInstanceOf(Collection::class,$order->products);
    	$this->assertCount(2,$order->products);
    }
}

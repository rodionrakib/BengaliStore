<?php

namespace Tests\Feature\Orders;

use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function it_can_associate_the_product_in_the_order()
    {
        $products = factory(Product::class,2)->create();
        $order = factory(Order::class)->create();



        $products = $order->addProducts($products);

        $this->assertCount(2,$order->products);
        $this->assertTrue($order->products->contains(Product::find(3)));
    }

    /** @test */
    public function order_has_a_shipping_address()
    {
        $order = factory(Order::class)->create();

        $this->assertInstanceOf(CustomerAddress::class,$order->address);
    }

 
}

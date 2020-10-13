<?php

namespace Tests\Feature\Front\Cart;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartFeatureTest extends TestCase
{
    use RefreshDatabase;



        /** @test */
    public function it_can_add_to_cart()
    {
        $product = factory(Product::class)->create();

        $data = [
            'id' => $product->id,
            'quantity' => 1
        ];

        $this
            ->post(route('cart.store', $data))
            ->assertStatus(302)
            ->assertSessionHas('message', 'Add to cart successful')
            ->assertRedirect(route('cart.index'));
    }

    /** @test */
    public function it_can_show_the_customer_cart()
    {
        $this->withoutExceptionHandling();
        $product = factory(Product::class)->create();

        $data = [
            'id' => $product->id,
            'quantity' => 1
        ];

        $this
            ->actingAs($this->customer, 'web')
            ->post(route('cart.store', $data));

        $this
            ->actingAs($this->customer, 'web')
            ->get(route('cart.index'))
            ->assertStatus(200)
            ->assertSee($product->name);
    }

}

<?php

namespace Tests\Feature\Front\Cart;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartFeatureTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function it_shows_the_login_form_when_checking_out()
    {
        $this->get(route('checkout.index'))->assertRedirect(route('login'));        
        
    }



    /** @test */
    public function it_errors_when_customer_has_no_address_yet_upon_checkout()
    {
        $this->withoutExceptionHandling();
        $product = factory(Product::class)->create();
        $cartItem = Cart::add($product,2);

        $this
            ->actingAs($this->customer, 'web')
            ->get(route('checkout.index'))
            ->assertStatus(200)
            ->assertSee('No address found. You need to create an address first here.');
    }

    /** @test */
    public function it_shows_the_checkout_page_when_user_is_logged_in()
    {
        
        $this
            ->actingAs($this->customer, 'web')
            ->get(route('checkout.index'))
            ->assertStatus(200);
    }


    /** @test */
    public function it_can_update_the_cart()
    {
        $this->withoutExceptionHandling();
        $product = factory(Product::class)->create();

        $cartItem = Cart::add($product,2);
        
        $this
            ->actingAs($this->customer, 'web')
            ->patch(route('cart.update', $cartItem->rowId), ['quantity' => 1])
            ->assertStatus(302)
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas('message', 'Update cart successful');

    }

        /** @test */
    public function it_can_add_product_to_cart()
    {
        $this->withoutExceptionHandling();
        $product = factory(Product::class)->create();

        $this->assertCount(0,Cart::content());
        $data = [
            'id' => $product->id,
            'quantity' => 3
        ];

        $this
            ->post(route('cart.store', $data))
            ->assertStatus(302)
            ->assertSessionHas('message', 'Add to cart successful')
            ->assertRedirect(route('cart.index'));

         $this->assertEquals(1,Cart::content()->count());


    }


    /** @test */
    public function it_can_remove_the_item_in_the_cart()
    {

        $product = factory(Product::class)->create();

        $cartItem = Cart::add($product,2);


            $this
                ->actingAs($this->customer, 'web')
                ->delete(route('cart.destroy', $cartItem->rowId))
                ->assertStatus(302)
                ->assertRedirect(route('cart.index'))
                ->assertSessionHas('message', 'Removed to cart successful');
        
    }


    /** @test */
    public function it_can_show_the_cart_page()
    {

        $this
            ->actingAs($this->customer, 'web')
            ->get(route('cart.index'))
            ->assertStatus(200);
    }

    // WISH LIST RELETD TEST 

    /** @test */
    public function can_store_item_in_wishlist()
    {
        $this->actingAs($this->customer,'web');

        $product = factory(Product::class)->create();

        $this->customer->wish($product);

        dd($this->customer->wishlists()->all()['default']);
        
    }


}

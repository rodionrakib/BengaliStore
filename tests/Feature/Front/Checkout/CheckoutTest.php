<?php

namespace Tests\Feature\Front\Checkout;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;




    /** @test */
    public function it_shows_error_page_when_checking_out_without_item_in_the_cart()
    {
        $this->withoutExceptionHandling();
        $this
            ->actingAs($this->customer, 'web')
            ->get(route('checkout.index'))
            ->assertStatus(200)
            ->assertSee('No products in cart yet.')
            ->assertSee('Show now!');
    }

   
    /** @test */
    public function it_redirects_to_login_screen_when_checking_out_while_you_are_still_logged_out()
    {
        $this
            ->get(route('checkout.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

}

<?php

namespace Tests\Feature\Front\Checkout;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;



    /** @test */
    public function logedin_user_go_to_shipping_page_after_clicking_checkout_button()
    {
    	$this->withoutExceptionHandling();
        $this->actingAs($this->customer,'web');
        $this->get('checkout/shipping')->assertStatus(200);
    }

   
    

}

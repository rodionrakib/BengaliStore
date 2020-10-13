<?php

namespace Tests\Feature\Front\Checkout;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_not_visit_checkout_shiping_with_empty_cart()
    {
        $this->withoutExceptionHandling();
        $this->get('checkout/shipping')->assertRedirect(route('home'));;
    }


    /** @test */
    public function by_givining_valid_shipping_data_guest_user_can_proceed_to_payment()
    {
        $this->withoutExceptionHandling();
        $attr = [
            'name' => 'Rakib Ahmed',
            'mobile' => '01717416646',
            'address' => '112 Kawranbajar',
            'zip' => '9302'

        ];

        $response = $this->post('checkout/shipping',$attr);
        // one order can contain 2 address  shipping / billing 
        
        // make sure and address is created / stored in session 
        $response->assertSessionHasAll(['shipping' =>  $attr]);

        $response->assertRedirect(route('checkout.payment'));

    }


        /** @test */
    public function can_not_visit_payment_page_without_added_shipping_address()
    {
        $this->withoutExceptionHandling();
        $this->get('checkout/payment')->assertRedirect(route('checkout.shipping'));;
    }

}

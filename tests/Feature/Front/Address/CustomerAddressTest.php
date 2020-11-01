<?php

namespace Tests\Feature\Front\Address;

use App\Models\City;
use App\Models\CustomerAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerAddressTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function it_can_show_the_list_of_address_of_the_customer()
    {
        $address = factory(CustomerAddress::class)->create(['customer_id' => $this->customer->id]);

        $this->withoutExceptionHandling();

        $this
            ->actingAs($this->customer, 'web')
            ->get(route('accounts.address', $this->customer->id))
            ->assertStatus(200)
            ->assertSee('Alias');
    }

    /** @test */
    public function it_can_show_the_create_address()
    {


        $this
            ->actingAs($this->customer, 'web')
            ->get(route('accounts.address.create',['account' => $this->customer->id]))
            ->assertStatus(200);

    }

    /** @test */
    public function alias_is_required_to_create_customer_address()
    {
        
        $attributes = factory(CustomerAddress::class)->raw(['alias' => '' ]);


        $this
            ->actingAs($this->customer, 'web')
            ->post(route('accounts.address.store'), $attributes)
            ->assertSessionHasErrors('alias');

    }
    /** @test */
    public function phone_is_required_to_create_customer_address()
    {
        
        $attributes = factory(CustomerAddress::class)->raw(['phone' => '' ]);


        $this
            ->actingAs($this->customer, 'web')
            ->post(route('accounts.address.store'), $attributes)
            ->assertSessionHasErrors('phone');

    }


    /** @test */
    public function authenticated_customer_can_save_his_address()
    {

        $this->withoutExceptionHandling();

        $attributes = factory(CustomerAddress::class)->raw(['customer_id' => $this->customer->id]);



        $this
            ->actingAs($this->customer, 'web')
            ->post(route('accounts.address.store'), $attributes)
            ->assertStatus(302)
            ->assertRedirect(route('accounts.address'));

        $this->assertDatabaseHas('customer_addresses',$attributes);
    }

    /** @test */
    public function authenticated_customer_can_update_his_address()
    {

        $this->withoutExceptionHandling();

        $myAddress = factory(CustomerAddress::class)->create(['customer_id' => $this->customer->id]);

        $attributes = [
            'phone' => '01539542041',
            'alias' => 'Foo'
        ];

        $this
            ->actingAs($this->customer, 'web')
            ->patch(route('accounts.address.update',['address' => $myAddress->id]), $attributes)
            ->assertRedirect(route('accounts.address'));
            
        $this->assertDatabaseHas('customer_addresses',$attributes);
    }

    /** @test */
    public function authenticated_customer_can_not_update_other_customers_address()
    {


        $jonsAddress = factory(CustomerAddress::class)->create();

        $attributes = [
            'phone' => '01539542041',
            'alias' => 'Foo'
        ];

        $this
            ->actingAs($this->customer, 'web')
            ->patch(route('accounts.address.update',['address' => $jonsAddress->id]), $attributes)
            ->assertStatus(403);
            
    }
}

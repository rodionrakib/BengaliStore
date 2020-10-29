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
            ->get(route('accounts.address.index', $this->customer->id))
            ->assertStatus(200)
            ->assertSee('Alias')
            ->assertSee('Address 1')
            ->assertSee('Country')
            ->assertSee('City')
            ->assertSee('Zip Code');
    }

    /** @test */
    public function it_can_show_the_create_address()
    {
        // $this->withoutExceptionHandling();
        factory(City::class)->create();

        $this
            ->actingAs($this->customer, 'web')
            ->get(route('accounts.address.create',['account' => $this->customer->id]))
            ->assertStatus(200);

    }


    /** @test */
    public function it_can_save_the_customer_address()
    {
        $this->withoutExceptionHandling();

        $data = [
            'status' => 1,
            'alias' => 'home',
            'address' => $this->faker->address,
        ];

        $this
            ->actingAs($this->customer, 'web')
            ->post(route('accounts.address.store',[ 'account' => $this->customer->id ] ), $data)
            ->assertStatus(302)
            ->assertRedirect(route('accounts.address'));
    }
}

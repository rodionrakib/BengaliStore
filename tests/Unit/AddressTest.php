<?php

namespace Tests\Unit;

use App\Models\City;
use App\Models\CustomerAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressTest extends TestCase
{
	use RefreshDatabase;
	/** @test */
	public function address_belongs_to_city()
	{
		$address = factory(CustomerAddress::class)->create();
		$this->assertInstanceOf(City::class,$address->city);
	}    
}

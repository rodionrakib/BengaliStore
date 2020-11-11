<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
use App\Models\CustomerAddress;
use App\User;
use Faker\Generator as Faker;

$factory->define(CustomerAddress::class, function (Faker $faker) {
    return [
        'address' => $faker->address,
        'customer_id' => factory(User::class)->create()->id,
        'city_id' => factory(City::class)->create()->id,
		'phone' => $faker->phoneNumber,        
    ];
});

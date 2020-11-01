<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CustomerAddress;
use App\User;
use Faker\Generator as Faker;

$factory->define(CustomerAddress::class, function (Faker $faker) {
    return [
        'alias' => $faker->word,
        'address' => $faker->address,
        'customer_id' => factory(User::class)->create()->id,
		'phone' => $faker->phoneNumber,        
    ];
});

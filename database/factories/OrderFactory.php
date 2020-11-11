<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CustomerAddress;
use App\Models\Order;
use App\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_id' => factory(User::class)->create()->id,
        'address_id' => factory(CustomerAddress::class)->create()->id,
        'amount' => $faker->numberBetween(100,200000),
        'transaction_id' => uniqid(),
        'status' => 'ORDERED',
        'cus_name' => $faker->name,
        'cus_email' => $faker->email,
        'cus_addr1' => $faker->address,
        'cus_phone' => $faker->phoneNumber,

    ];
});

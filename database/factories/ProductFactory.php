<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
	$name = $faker->sentence;
    return [
        'sku' => $faker->numberBetween(111111,999999),
        'name' => $name,
        'slug' => Str::slug($name),
        'price' => $faker->numberBetween(50,10000),
        'quantity' => $faker->numberBetween(0,1000),
        'short_description' => $faker->paragraph,
        'long_description' => $faker->text,
        'featured' => false, 
        'status' => 0
    ];
});


$factory->state(Product::class, 'featured', function (Faker $faker) {
    return [
        'featured' => true,
        
    ];
});

$factory->state(Product::class, 'enabled', function (Faker $faker) {
    return [
        'status' => 1,
        
    ];
});

$factory->state(Product::class, 'disabled', function (Faker $faker) {
    return [
        'status' => 0,
        
    ];
});
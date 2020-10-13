<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Size;
use Faker\Generator as Faker;

$factory->define(Size::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'short_name' => $faker->randomLetter,
    ];
});

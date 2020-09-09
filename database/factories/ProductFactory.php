<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Product::class, function (Faker $faker) {

    return [
        'name' => $faker->unique()->word,
        'slug' => $faker->unique()->word,
        'detales' => $faker->sentence,
        'price' => $faker->biasedNumberBetween($min = 10, $max = 500, $function = 'sqrt'),
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
    ];
});

// $factory->define(Product::class, function (Faker $faker) {
//     $name = $faker->word." ". $faker->word;
//
//     return [
//         'name' => $name,
//         'slug' => str_replace(' ', '-', strtolower($name))->unique(),
//         'detales' => $faker->sentence,
//         'price' => $faker->biasedNumberBetween($min = 10, $max = 500, $function = 'sqrt'),
//         'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
//     ];
// });

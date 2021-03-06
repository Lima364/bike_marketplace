<?php
namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Category::class, function (Faker $faker) {
    return [
        'nome'=> $faker->name,
        'description'=> $faker->sentence,
        'slug'=> $faker->slug
    ];
});

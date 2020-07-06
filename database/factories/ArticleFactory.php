<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    $title = $faker->sentence(4);
    return [
        'user_id' => 1,
        'category_id' => rand(1,20),
        'title' => $title,
        'slug' => str_slug($title),
        'excerpt' => $faker->text(200),
        'body' => $faker->text(500),
        'image' => $faker->imageUrl($width = 1920, $height = 1080),
        'status' => $faker->randomElement(['PUBLISHED', 'IN_REVIEW'])
    ];
});

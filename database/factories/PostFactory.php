<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->sentence(),
        'short_content' => $faker->sentence(15),
        'content' => $faker->paragraph(15),
        'photo' => $faker->imageUrl('https://onlinepngtools.com/images/examples-onlinepngtools/elephant-hd-quality.png'),
    ];
});

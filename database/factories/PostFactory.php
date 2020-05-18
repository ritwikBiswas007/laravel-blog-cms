<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => factory('App\User'),
        'title' => $faker->sentence(10, true),
        'cover' => 'https://picsum.photos/id/' . random_int(1, 1000) . '/1280/720',
        'content' => $faker->paragraphs(10, true),
        'slug' => $faker->slug()
    ];
});

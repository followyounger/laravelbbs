<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    $sentence = $faker->sentence();
    //  随机去一个月以内的时间
    $updated_at = $faker->dateTimeThisMonth();
    // 创建使劲永远比更改时间要早
    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        // 'name' => $faker->name,
        'title' => $sentence,
        'body' => $faker->text(),
        'excerpt' => $sentence,
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});

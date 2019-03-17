<?php

use Faker\Generator as Faker;

$factory->define(App\PackageType::class, function (Faker $faker) {
    $r = rand(10, 100);
    $extra = floor($r / 5);
    $ttl = $r + $extra;
    return [
        "name" => "PT {$r} + {$extra}",
        "sessions" => $ttl,
        "price" => rand(800, 1110) * $ttl,
        "expiry_days" => rand(90, 160)
    ];
});


// $table->increments('id');
// $table->string('name');
// $table->integer('sessions');
// $table->integer('price');
// $table->integer('session_length')->default(60);
// $table->integer('expiry_days')->defasult(90);

// $table->boolean('promo')->default(false);
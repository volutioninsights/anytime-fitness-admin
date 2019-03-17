<?php

use Faker\Generator as Faker;
use Faker\Factory as FakerFac;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$faker = FakerFac::create('en_PH');

$factory->define(App\Gyms::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => "Example Address",
        'city' => $faker->city,
        'zip' => "123454",
        'phone' => $faker->phoneNumber,
        'email' => "gyms@voluitioninsights.com"
    ];
});

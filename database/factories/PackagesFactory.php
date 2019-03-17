<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Packages::class, function (Faker $faker) {
    return [
        "expiry" => Carbon::today(),
        "valid" => Carbon::today(),
    ];
});

// $table->integer('trainer_id')->unsigned();
// $table->integer('client_id')->unsigned();
// $table->integer('package_type_id')->unsigned();

// $table->date("expiry");
// $table->date("valid");

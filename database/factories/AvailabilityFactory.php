<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Availability::class, function (Faker $faker) {
    static $days = 1;
    // $days++;
    return [
        'date' => Carbon::now()->addDays($days)->toDateString(),
        'start' => Carbon::now()->addDays($days)->setTime(9, 0, 0),
        'end' => Carbon::now()->addDays($days)->setTime(16, 0, 0),
        'day' => Carbon::now()->addDays($days)->dayOfWeekIso
    ];
});

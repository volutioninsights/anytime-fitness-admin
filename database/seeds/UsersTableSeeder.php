<?php

use App\PackageType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    private $avs, $hrs = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Scott Evans",
            'email' => 'scott@volutioninsights.com',
            'password' => bcrypt('r3gysc0tt'),
            'type' => "Admin",
            'admin' => true,
        ]);

        DB::table('users')->insert([
            'name' => "Adam Norton",
            'email' => 'adam@volutioninsights.com',
            'password' => bcrypt('anorton1'),
            'type' => "Admin",
        ]);

        DB::table('users')->insert([
            'name' => "Eliot Rigby",
            'email' => 'eliot@volutioninsights.com',
            'password' => bcrypt('12345'),
            "type" => "Admin",
        ]);

        // factory(App\User::class, 50)->create([
        //     'type' => 'PT',
        // ])->each(function ($pt) {

        //     $this->avs = factory(App\Availability::class, 1)->create([
        //         // 'date' => Carbon::now()->addDay(1)->toDateString(),
        //         'user_id' => $pt->id,
        //         'gym_id' => $pt->gym_id,
        //     ]);

        //     factory(App\Packages::class, 1)->make([
        //         'trainer_id' => $pt->id,
        //     ])->each(function ($package) {
        //         $hours = 10;
        //         $c = factory(App\User::class)->create([
        //             'type' => 'Client',
        //             'gym_id' => null,
        //         ]);

        //         $type = PackageType::inRandomOrder()->first();

        //         $package->client_id = $c->id;
        //         $package->package_type_id = $type->id;
        //         $package->valid = Carbon::today();
        //         $package->expiry = Carbon::today()->addDays($type->expiry_days);
        //         $package->save();

        //         foreach ($this->avs as $av) {
        //             $when = Carbon::createFromFormat('Y-m-d', $av->date);
        //             $when->setTime(rand(9, 14), 0);
        //             $d = DB::table('sessions')->insert([
        //                 'package_id' => $package->id,
        //                 'availability_id' => $av->id,
        //                 'when' => $when,
        //             ]);
        //         }
        //     });
        // });
    }
}

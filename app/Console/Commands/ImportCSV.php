<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Gym members CSVs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $gym = 4;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Pioneer.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);
        // array_shift($lines);

        // foreach($lines as $line){
        //     $vals = str_getcsv($line);

        //     $mem = new User;
        //     $mem->name = "{$vals[1]} {$vals[2]}";
        //     $mem->joined = new Carbon($vals[3]);
        //     $mem->phone = $vals[4];
        //     $mem->email = $vals[6];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }

        // $gym = 10;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Bacolod.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach($lines as $line){
        //     $vals = str_getcsv($line);

        //     $mem = new User;
        //     $mem->name = "{$vals[0]}";
        //     $mem->joined = new Carbon($vals[1]);
        //     $mem->phone = $vals[2];
        //     $mem->email = $vals[3];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }

        // $gym = 5;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Bfhomes.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach($lines as $line){
        //     $vals = str_getcsv($line);

        //     if("{$vals[0]} {$vals[1]}" == " " || $vals[0] == ""){
        //         continue;
        //     }

        //     $mem = new User;
        //     $mem->name = "{$vals[0]} {$vals[1]}";
        //     $mem->joined = new Carbon($vals[2]);
        //     $mem->phone = $vals[3];
        //     $mem->email = $vals[4];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }

        // $gym = 13;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/CongE.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);
        // array_shift($lines);
        // array_shift($lines);

        // foreach($lines as $line){
        //     $vals = str_getcsv($line);

        //     if("{$vals[0]} {$vals[1]}" == " " || $vals[0] == ""){
        //         continue;
        //     }

        //     $mem = new User;
        //     $mem->name = "{$vals[1]} {$vals[2]}";
        //     $mem->joined = new Carbon($vals[3]);
        //     $mem->phone = $vals[5];
        //     $mem->email = $vals[4];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }

        // $gym = 17;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Ilolio.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach($lines as $line){
        //     $vals = str_getcsv($line);

        //                 if("{$vals[0]} {$vals[1]}" == " " || $vals[0] == ""){
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[0]}";
        //     $mem->joined = new Carbon(@$vals[1]);
        //     $mem->phone = $vals[2];
        //     $mem->email = $vals[3];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }

        // $gym = 9;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Magallanes.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach($lines as $line){
        //     $vals = str_getcsv($line);

        //                 if("{$vals[0]} {$vals[1]}" == " " || $vals[0] == ""){
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[1]} {$vals[2]}";
        //     $mem->joined = new Carbon(@$vals[3]);
        //     $mem->phone = $vals[4];
        //     $mem->email = $vals[5];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }

        //  $gym = 12;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Marikina.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach($lines as $line){
        //     $vals = str_getcsv($line);

        //                 if("{$vals[0]} {$vals[1]}" == " " || $vals[0] == ""){
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[0]}";
        //     $mem->joined = new Carbon(@$vals[1]);
        //     $mem->phone = $vals[2];
        //     $mem->email = $vals[3];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }

        //          $gym = 20;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/MarikinaXel.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);
        // array_shift($lines);

        // foreach($lines as $line){
        //     $vals = str_getcsv($line);

        //                 if("{$vals[1]} {$vals[1]}" == " " || $vals[1] == ""){
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[1]} {$vals[2]}";
        //     $mem->joined = new Carbon(@$vals[3]);
        //     $mem->phone = $vals[5];
        //     $mem->email = $vals[4];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }

        // $gym = 16;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/MckinleyHill.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[0]} {$vals[1]}" == " " || $vals[0] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[0]}";
        //     $mem->joined = new Carbon(@$vals[1]);
        //     $mem->phone = $vals[2];
        //     $mem->email = $vals[3];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }


        // $gym = 18;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Moonwalk.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[0]} {$vals[1]}" == " " || $vals[0] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[0]} {$vals[1]}";
        //     $mem->joined = new Carbon(@$vals[2]);
        //     $mem->phone = $vals[3];
        //     $mem->email = $vals[4];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }

        // $gym = 15;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Ndomingo.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);
        // array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[0]} {$vals[1]}" == " " || $vals[0] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[0]}";
        //     $mem->joined = new Carbon(@$vals[1]);
        //     $mem->phone = $vals[2];
        //     $mem->email = $vals[3];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }

        // $gym = 6;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Nuvali.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);
        // array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[0]} {$vals[1]}" == " " || $vals[1] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[1]} {$vals[2]}";
        //     $mem->joined = new Carbon(@$vals[3]);
        //     $mem->phone = $vals[4];
        //     $mem->email = $vals[5];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }


        // $gym = 23;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Whiteplains.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[0]} {$vals[1]}" == " " || $vals[0] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[0]} {$vals[1]}";
        //     $mem->joined = new Carbon(@$vals[2]);
        //     $mem->phone = $vals[3];
        //     $mem->email = $vals[4];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }


        // $gym = 8;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Wilson.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);
        // array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[0]} {$vals[1]}" == " " || $vals[0] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[0]} {$vals[1]}";
        //     $mem->joined = new Carbon(@$vals[2]);
        //     $mem->phone = $vals[3];
        //     $mem->email = $vals[4];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }

        // $gym = 22;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Quezon.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[0]} {$vals[1]}" == " " || $vals[0] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[0]} {$vals[1]}";
        //     $mem->joined = new Carbon(@$vals[2]);
        //     $mem->phone = $vals[3];
        //     $mem->email = $vals[4];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }

        // $gym = 19;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Lightmall.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[0]} {$vals[1]}" == " " || $vals[0] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[0]} {$vals[1]}";
        //     $mem->joined = Carbon::createFromFormat('d/m/Y', @$vals[2]);
        //     $mem->phone = $vals[3];
        //     $mem->email = $vals[4];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        //     // dd($mem);
        // }


        // $gym = 7;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Cong.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[1]} {$vals[2]}" == " " || $vals[1] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[1]} {$vals[2]}";
        //     $mem->joined = Carbon::createFromFormat('d/m/Y', @$vals[16]);
        //     $mem->phone = $vals[3];
        //     $mem->email = $vals[10];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
            // dd($mem);
        // }

        // $gym = 14;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Scape.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[1]} {$vals[2]}" == " " || $vals[1] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[1]} {$vals[2]}";
        //     $mem->joined = Carbon::createFromFormat('d/m/Y', @$vals[10]);
        //     $mem->phone = $vals[3];
        //     $mem->email = $vals[7];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        // }

        // $gym = 11;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Better.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[1]} {$vals[2]}" == " " || $vals[1] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[1]} {$vals[2]}";
        //     $mem->joined = Carbon::createFromFormat('d/m/Y', @$vals[12]);
        //     $mem->phone = $vals[3];
        //     $mem->email = $vals[9];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        // }


        //   $gym = 21;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Santolan.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[1]} {$vals[2]}" == " " || $vals[1] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[1]} {$vals[2]}";
        //     $mem->joined = Carbon::createFromFormat('d/m/Y', @$vals[16]);
        //     $mem->phone = $vals[3];
        //     $mem->email = $vals[10];
        //     $mem->gym_id = $gym;
        //     $mem->type = "Client";
        //     $mem->save();
        // }

        // $gym = 26;

        // $directory = "storage/app/imports/";
        // // $files = Storage::allFiles("imports/members");
        // $file = Storage::get('imports/members/Greenhill.csv');
        // $lines = preg_split('/\n|\r\n?/', $file);

        // $hdr = array_shift($lines);

        // foreach ($lines as $line) {
        //     $vals = str_getcsv($line);

        //     if ("{$vals[1]} {$vals[2]}" == " " || $vals[1] == "") {
        //         continue;
        //     }

        //     dump($vals);

        //     $mem = new User;
        //     $mem->name = "{$vals[1]} {$vals[2]}";
        //     $mem->joined = Carbon::createFromFormat('d/m/Y', @$vals[16]);
        //     $mem->phone = $vals[3];
        //     $mem->email = $vals[10];
        //     $mem->gym_id = $gym;
        //     $mem->api_token = Str::random(100);
        //     $mem->type = "Client";
        //     $mem->save();
        // }
    }
}

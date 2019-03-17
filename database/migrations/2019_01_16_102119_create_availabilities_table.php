$<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->increments('id');

            $table->date("date");
            $table->datetime("start");
            $table->datetime("end");
            $table->boolean("available")->default(true);
            $table->integer('day');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('gym_id')->unsigned()->index();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('gym_id')->references('id')->on('gyms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availabilities');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('gym_id')->unsigned()->index();
            $table->string('name');
            $table->integer('capacity')->nullable();
            $table->integer('trainer_id')->unsigned()->index()->nullable();
            $table->string('freelance')->nullable();

            $table->date('class_date');
            $table->integer('day');
            $table->datetime('start');
            $table->datetime('end');

            $table->timestamps();

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
        Schema::dropIfExists('classes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gyms', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('address');

            $table->string('city')->nullable();
            $table->string('zip');

            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('lat')->default(53.478943);
            $table->string('lng')->default(-2.252200);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gyms');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSesasionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->integer('total_sessions')->default(0);
            $table->integer('session_number')->default(0);
            $table->string('payment_mode')->nullable();
            $table->date('date_purchased')->nullable();
            $table->date('expiry')->nullable();
            $table->integer('sessions_left')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

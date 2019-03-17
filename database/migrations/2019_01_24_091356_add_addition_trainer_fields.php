<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionTrainerFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainer_details', function (Blueprint $table) {
            $table->string('employee_number')->nullable();
            $table->string('job_title')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('status')->nullable();
            $table->string('employment_date')->nullable();
            $table->string('dob')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TrainerDetails', function (Blueprint $table) {
            //
        });
    }
}

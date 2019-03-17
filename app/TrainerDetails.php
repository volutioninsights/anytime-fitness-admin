<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainerDetails extends Model
{
    protected $fillable = ['user_id', 'expertise', 'education', 'employee_number', 'job_title', 'contract_type', 'status', 'employment_date', 'dob'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

// $table->string('employee_number')->nullable();
// $table->string('job_title')->nullable();
// $table->string('contract_type')->nullable();
// $table->string('status')->nullable();
// $table->string('employment_date')->nullable();
// $table->string('dob')->nullable();

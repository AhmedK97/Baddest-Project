<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DoctorProject extends Pivot
{
    public $guarded = [];


    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function transactions()
    {
        return $this->hasMany(DoctorProjectPayed::class, 'doctor_project_id');
    }
}

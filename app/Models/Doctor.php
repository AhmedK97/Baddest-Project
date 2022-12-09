<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->belongsToMany(Project::class)->using(DoctorProject::class)->withTimestamps();
    }
}

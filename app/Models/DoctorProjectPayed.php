<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorProjectPayed extends Model
{
    use HasFactory;

    public $table = 'doctor_project_payed';

    public $guarded = [];

    public function doctorProject()
    {
        $this->belongsTo(DoctorProject::class);
    }

}

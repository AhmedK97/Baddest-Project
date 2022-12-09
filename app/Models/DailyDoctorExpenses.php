<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyDoctorExpenses extends Model
{
    use HasFactory;
    protected $fillable  = ['bill', 'name', 'doctor'];
}

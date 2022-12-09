<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyDoctorExpensesDele extends Model
{
    use HasFactory;
    protected $fillable  = ['bill', 'name', 'doctor'];

}

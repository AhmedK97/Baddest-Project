<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyExpensesDele extends Model
{
    use HasFactory;
    protected $fillable  = ['bill', 'name'];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class msg extends Model
{
    use HasFactory;
    protected $fillable  = ['msg', 'project_id', 'mobile', 'status'];
}

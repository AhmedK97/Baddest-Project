<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable  = ['body', 'done', 'project_id'];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

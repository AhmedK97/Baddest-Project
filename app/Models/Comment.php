<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable  = ['comment', 'bill', 'project_id', 'num'];
    public function doctors()
    {
        return $this->belongsTo(Project::class);
    }
}

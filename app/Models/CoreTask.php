<?php

namespace App\Models;

use App\Models\Courses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoreTask extends Model
{
    use HasFactory;

    protected $table = 'coretasks';

    public function course() {
        return $this->belongsTo(Courses::class);
    }

    public function workProcesses()
    {
        return $this->hasMany(Workproces::class, 'coretask_id');
    }
}

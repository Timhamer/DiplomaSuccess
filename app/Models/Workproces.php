<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workproces extends Model
{
    use HasFactory;

    protected $table = 'workprocesses';

    public function tasks()
    {
        return $this->hasMany(Task::class, 'workprocess_id');
    }

    public function examWorkprocess()
    {
        return $this->hasMany(ExamWorkprocess::class, 'workprocess_id');
    }
}

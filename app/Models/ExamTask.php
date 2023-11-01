<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTask extends Model
{
    use HasFactory;

    protected $table = 'exam_task';
    protected $fillable = ['exam_id', 'task_id', 'answer'];
}

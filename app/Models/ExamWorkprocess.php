<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamWorkprocess extends Model
{

    use HasFactory;
    protected $table = 'exam_workprocess';

    protected $fillable = ['definitive', 'feedback', 'score'];


}



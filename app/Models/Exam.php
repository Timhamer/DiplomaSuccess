<?php

namespace App\Models;

use App\Models\Courses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    protected $table = 'exams';
    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }

    public function examiners() {
        return $this->belongsToMany(User::class, 'examiner', 'exam_id', 'user_id');
    }
}

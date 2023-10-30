<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';
    use HasFactory;

    public function examiners() {
        return $this->belongsToMany(User::class, 'examiner', 'exam_id', 'user_id');
    }
}

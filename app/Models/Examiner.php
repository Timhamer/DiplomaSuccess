<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examiner extends Model
{
    use HasFactory;
    protected $table = 'examiner';

    // Define the 'exams' relationship (reverse of 'examiner' in 'Exam' model)
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}


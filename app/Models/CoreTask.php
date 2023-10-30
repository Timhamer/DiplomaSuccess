<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreTask extends Model
{
    use HasFactory;

    protected $table = 'coretasks';

    public function workProcesses()
    {
        return $this->hasMany(Workproces::class, 'coretask_id');
    }
}

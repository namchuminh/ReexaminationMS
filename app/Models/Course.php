<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'is_oral_exam',
        'department_id',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}

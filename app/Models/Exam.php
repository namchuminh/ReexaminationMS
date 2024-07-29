<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'semester',
        'exam_date'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function reexaminations()
    {
        return $this->hasMany(Reexamination::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'teacher_id',
        'course_id',
        'classroom_id',
        'type',
        'start_time',
        'end_time',
        'day',
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'timetable_courses')
                    ->withPivot('teacher_id', 'start_time', 'end_time', 'day', 'classroom_id')
                    ->withTimestamps();
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

}

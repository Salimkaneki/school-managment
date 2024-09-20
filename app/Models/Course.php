<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'teacher_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_course');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_course');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function trimester()
    {
        return $this->belongsTo(Trimester::class);
    }

    public function timetables()
    {
        return $this->belongsToMany(Timetable::class, 'timetable_courses')
                    ->withPivot('teacher_id', 'start_time', 'end_time', 'day', 'classroom_id')
                    ->withTimestamps();
    }
}

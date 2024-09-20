<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimetableCourse extends Model
{
    use HasFactory;

    protected $table = 'timetable_courses';

    protected $fillable = [
        'timetable_id',
        'course_id',
        'teacher_id',
        'start_time',
        'end_time',
        'day',
        'classroom_id',
    ];

    // Relation avec le modèle Timetable
    public function timetable()
    {
        return $this->belongsTo(Timetable::class);
    }

    // Relation avec le modèle Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relation avec le modèle Teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // Relation avec le modèle Classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}

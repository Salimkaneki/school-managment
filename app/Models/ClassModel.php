<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'fees',  
        'trimester_id'

    ];
    public function students()
    {
        return $this->hasMany(Student::class);
    }


    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_class');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'class_course');
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }


    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function trimester()
    {
        return $this->belongsTo(Trimester::class);
    }
}

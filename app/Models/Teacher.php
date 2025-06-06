<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'gender',
        'nationality',
        'seniority',
        'subject',
        'photo',
        'is_active',
        'birthday',
        'marital_status',
        'address',
        'school_id',
        'academic_year_id'

    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function course()
    {
        return $this->belongsToMany(Course::class, 'teacher_course');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
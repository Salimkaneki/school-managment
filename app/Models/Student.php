<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'date_of_birth',
        'phone_number',
        'nationality',
        'class_id',
        'academic_year_id',
        'previous_school_name',
        'emergency_contacts',
        'photo',
        'gender',
        'address',
        'place_of_birth',
        'classroom_id'
    ];


    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}

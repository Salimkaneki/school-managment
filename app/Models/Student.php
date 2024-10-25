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
    'class_id',
    'previous_school_name',
    'emergency_contact_name',
    'emergency_contact_phone',
    'photo',
    'gender', 
];


    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

}

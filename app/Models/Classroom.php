<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'class_model_id',
        'school_id',
        'academic_year_id'
    ];



    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_model_id'); // Changez 'class_id' en 'class_model_id'
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    
    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_classroom', 'classroom_id', 'class_model_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}

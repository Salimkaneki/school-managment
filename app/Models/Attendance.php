<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_id',
        'school_id',
        'date',
        'present',
        'absence_times'
    ];

    protected $casts = [
        'absence_times' => 'array',
        'present' => 'boolean',
        'date' => 'date'
    ];

    // Optionnel : définir les relations
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

}





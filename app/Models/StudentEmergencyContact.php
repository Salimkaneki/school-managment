<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEmergencyContact extends Model
{
    // Correspond exactement aux colonnes de la migration
    protected $fillable = [
        'student_id', 
        'name', 
        'country_code', 
        'phone_number', 
        'type'
    ];

    // Relation avec le modèle Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
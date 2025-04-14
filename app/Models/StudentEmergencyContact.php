<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEmergencyContact extends Model
{
    protected $fillable = [
        'student_id', 
        'class_id', 
        'name', 
        'country_code', 
        'phone_number', 
        'type'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    // Accesseur pour le numéro de téléphone complet
    public function getFullPhoneNumberAttribute() 
    {
        return $this->country_code . $this->phone_number;
    }
}
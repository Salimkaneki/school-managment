<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_year',
        'end_year',
        'is_active',
    ];
    protected $casts = ['is_active' => 'boolean'];

    public function trimesters()
    {
        return $this->hasMany(Trimester::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }

        // Accesseur pour obtenir le nom de l'année académique
    public function getNameAttribute()
    {
        return $this->start_year . '-' . $this->end_year;
    }

    
}

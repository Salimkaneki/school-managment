<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trimester extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'academic_year_id',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

        // Méthode utilitaire pour obtenir la durée du trimestre
        public function getDurationAttribute()
        {
            return $this->start_date->diffInWeeks($this->end_date) . ' semaines';
        }
    
        // Méthode pour vérifier si une date donnée est dans ce trimestre
        public function isDateInTrimester($date)
        {
            return $date >= $this->start_date && $date <= $this->end_date;
        }
    
        // Méthode pour vérifier si le trimestre est en cours
        public function isCurrentTrimester()
        {
            $now = now();
            return $this->start_date <= $now && $this->end_date >= $now;
        }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_year',    // ✅ Ajouté
        'end_year',      // ✅ Ajouté
        'is_active',     // ✅ Ajouté
        'school_id',     // Gardé si nécessaire
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_archived' => 'boolean',
        'start_year' => 'integer',
        'end_year' => 'integer',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
    
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

    /**
     * Relation avec les archives
     */
    public function archives()
    {
        return $this->hasMany(Archive::class);
    }

    // Accesseur pour obtenir le nom de l'année académique
    public function getNameAttribute()
    {
        return $this->start_year . '-' . $this->end_year;
    }

    public function getDisplayNameAttribute()
    {
        return "{$this->start_year}-{$this->end_year}";
    }

    public function getSafeNameAttribute()
    {
        return $this->name ?? $this->getDisplayNameAttribute();
    }
}
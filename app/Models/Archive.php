<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_name',
        'record_id',
        'archived_data',
        'academic_year_id',
        'archived_by',
        'archive_reason',
        'archived_at'
    ];

    protected $casts = [
        'archived_data' => 'array',
        'archived_at' => 'datetime'
    ];

    /**
     * Relation avec l'année académique
     */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Relation avec l'utilisateur qui a archivé
     */
    public function archivedBy()
    {
        return $this->belongsTo(User::class, 'archived_by');
    }

    /**
     * Accessor pour formater le nom de la table
     */
    public function getFormattedTableNameAttribute()
    {
        $tableNames = [
            'payments' => 'Paiements',
            'class_models' => 'Modèles de classe',
            'classrooms' => 'Salles de classe',
            'courses' => 'Cours',
            'timetables' => 'Emplois du temps',
            'timetable_courses' => 'Cours d\'emploi du temps',
            'attendances' => 'Présences',
            'teacher_classes' => 'Classes des enseignants',
            'teacher_courses' => 'Cours des enseignants',
            'class_courses' => 'Cours des classes',
            'class_classroom' => 'Classes-Salles',
            'teachers' => 'Enseignants',
            'student_emergency_contacts' => 'Contacts d\'urgence',
            'school_events' => 'Événements scolaires',
            'exams' => 'Examens',
            'time_slots' => 'Créneaux horaires'
        ];

        return $tableNames[$this->table_name] ?? ucfirst($this->table_name);
    }
}
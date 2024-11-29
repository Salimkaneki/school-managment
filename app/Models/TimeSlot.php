<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $fillable = [
        'start_time', 
        'end_time', 
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];



    // Méthode pour valider les créneaux
    public static function validateTimeSlot($start_time, $end_time)
    {
        // Logique de validation des créneaux
        // Par exemple : vérifier que end_time > start_time
        return $end_time > $start_time;
    }
}
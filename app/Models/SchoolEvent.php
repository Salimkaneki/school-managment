<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SchoolEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'title',
        'description',
        'event_date',
        'is_notification',
        'parent_event_id',
        'read'
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function timeAgo()
    {
        return Carbon::parse($this->created_at)->locale('fr')->diffForHumans();
    }

    public function formattedEventDate()
    {
        return Carbon::parse($this->event_date)->format('d/m/Y');
    }

    public function parentEvent()
    {
        return $this->belongsTo(SchoolEvent::class, 'parent_event_id');
    }

    // Relation avec les notifications liées
    public function notifications()
    {
        return $this->hasMany(SchoolEvent::class, 'parent_event_id');
    }
}

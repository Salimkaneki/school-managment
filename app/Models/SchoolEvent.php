<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'title',
        'description',
        'event_date'
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

}

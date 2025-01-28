<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'languages',
        'staff_count',
        'email',
        'phone',
        'address',
        'city',
        'postal_code',
        'has_sports_equipment',
        'has_library',
        'has_computer_room',
        'has_handicap_access',
        'rules_document_path',
        'project_document_path',
        'logo_path'
    ];

    protected $casts = [
        'languages' => 'array',
        'has_sports_equipment' => 'boolean',
        'has_library' => 'boolean',
        'has_computer_room' => 'boolean',
        'has_handicap_access' => 'boolean',
    ];
}
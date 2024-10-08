<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        // 'password',
        'phone_number',
        'gender',
        'nationality',
        'seniority',
        'subject'
    ];

    public function course()
    {
        return $this->belongsToMany(Course::class, 'teacher_course');
    }
    




}

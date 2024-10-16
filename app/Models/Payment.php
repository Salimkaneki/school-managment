<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'student_id',
        'amount_due',
        'amount_paid',
        'balance',
        'payment_date',
        'remaining_balance',
        'is_paid_off',
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function fees()
    {
        return $this->hasMany(Payment::class);
    }

    public function parents()
    {
        return $this->hasMany(StudentsParent::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

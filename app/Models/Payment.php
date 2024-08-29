<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

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
}

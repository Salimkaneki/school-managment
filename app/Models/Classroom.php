<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'class_model_id'
    ];



    public function classModel()
    {
        return $this->belongsTo(ClassModel::class);
    }
    public function classes()
{
    return $this->belongsToMany(ClassModel::class, 'class_classroom');
}
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classroom;

class ClassroomSeeder extends Seeder
{
    public function run()
    {
        Classroom::create([
            'name' => 'Salle A',
            'capacity' => 30,
            'class_model_id' => 1, // ID de la classe associée
        ]);

        Classroom::create([
            'name' => 'Salle B',
            'capacity' => 25,
            'class_model_id' => 2,
        ]);

        Classroom::create([
            'name' => 'Salle C',
            'capacity' => 20,
            'class_model_id' => 3,
        ]);
    }
}


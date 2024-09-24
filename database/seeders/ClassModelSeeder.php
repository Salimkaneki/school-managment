<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassModel;

class ClassModelSeeder extends Seeder
{
    public function run()
    {
        ClassModel::create([
            'name' => 'Première',
            'description' => 'Classe pour les élèves en première année',
            'fees' => 250.00,
        ]);

        ClassModel::create([
            'name' => 'Terminale',
            'description' => 'Classe pour les élèves en dernière année',
            'fees' => 300.00,
        ]);

        ClassModel::create([
            'name' => 'Seconde',
            'description' => 'Classe pour les élèves en seconde année',
            'fees' => 200.00,
        ]);
    }
}


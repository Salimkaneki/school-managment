<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        Student::create([
            'first_name' => 'Jean',
            'last_name' => 'Dupont',
            'email' => 'jean.dupont@example.com',
            'phone_number' => '0123456789',
            'gender' => 'male',
            'date_of_birth' => '2005-06-15',
            'class_id' => 1, // ID de la classe
            'previous_school_name' => 'École Sainte-Marie',
            'emergency_contact_name' => 'Marie Dupont',
            'emergency_contact_phone' => '0987654321',
            'photo' => null, // Champ photo peut rester null
        ]);

        Student::create([
            'first_name' => 'Marie',
            'last_name' => 'Durand',
            'email' => 'marie.durand@example.com',
            'phone_number' => '0223456789',
            'gender' => 'female',
            'date_of_birth' => '2006-03-10',
            'class_id' => 2,
            'previous_school_name' => 'Collège Les Étoiles',
            'emergency_contact_name' => 'Paul Durand',
            'emergency_contact_phone' => '0987654322',
            'photo' => null,
        ]);

        Student::create([
            'first_name' => 'Pierre',
            'last_name' => 'Martin',
            'email' => 'pierre.martin@example.com',
            'phone_number' => '0323456789',
            'gender' => 'male',
            'date_of_birth' => '2007-01-22',
            'class_id' => 3,
            'previous_school_name' => 'École Louis Pasteur',
            'emergency_contact_name' => 'Sophie Martin',
            'emergency_contact_phone' => '0987654323',
            'photo' => null,
        ]);
    }
}


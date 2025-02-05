<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;
use Illuminate\Support\Facades\Hash;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::create([
            'name' => 'École Démo',
            'type' => 'École primaire',  // Exemple de valeur valide
            'languages' => json_encode(['Français', 'Anglais']),
            'teaching_staff_count' => 25,
            'email' => 'ecole.demo@example.com',
            'phone' => '+1234567890',
            'address' => '123, Rue de l\'Éducation',
            'city' => 'Ville Démo',
            'postal_code' => '10000',
            'username' => 'ecoledemo',
            'password' => Hash::make('password123'),
            'has_sports_equipment' => true,
            'has_library' => true,
            'has_computer_room' => true,
            'has_handicap_access' => false,
        ]);
    }
}

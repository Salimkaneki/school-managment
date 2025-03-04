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
        // School::create([
        //     'name' => 'École Démo',
        //     'type' => 'École primaire',  // Exemple de valeur valide
        //     'languages' => json_encode(['Français', 'Anglais']),
        //     'teaching_staff_count' => 25,
        //     'email' => 'ecole.demo@example.com',
        //     'phone' => '+1234567890',
        //     'address' => '123, Rue de l\'Éducation',
        //     'city' => 'Ville Démo',
        //     'postal_code' => '10000',
        //     'username' => 'ecoledemo',
        //     'password' => Hash::make('password123'),
        //     'has_sports_equipment' => true,
        //     'has_library' => true,
        //     'has_computer_room' => true,
        //     'has_handicap_access' => false,
        // ]);

        // School::create([
        //     'name' => 'École Les Moineaux',
        //     'type' => 'École primaire',
        //     'languages' => json_encode(['Français']),
        //     'teaching_staff_count' => 20,
        //     'email' => 'moineaux@example.com',
        //     'phone' => '+2287053xxxx',
        //     'address' => '456, Avenue des Oiseaux',
        //     'city' => 'Lomé',
        //     'postal_code' => '00000',
        //     'username' => 'moineaux',
        //     'password' => Hash::make('Moineaux2025@'),
        //     'has_sports_equipment' => true,
        //     'has_library' => true,
        //     'has_computer_room' => false,
        //     'has_handicap_access' => false,
        // ]);

        // School::create([
        //     'name' => 'École Divine Grace',
        //     'type' => 'École primaire',
        //     'languages' => json_encode(['Français', 'Anglais']),
        //     'teaching_staff_count' => 30,
        //     'email' => 'divine.grace@example.com',
        //     'phone' => '+2287053xxxx',
        //     'address' => '789, Boulevard de la Grâce',
        //     'city' => 'Lomé',
        //     'postal_code' => '00000',
        //     'username' => 'divinegrace',
        //     'password' => Hash::make('DivineGrace2025#'),
        //     'has_sports_equipment' => true,
        //     'has_library' => true,
        //     'has_computer_room' => true,
        //     'has_handicap_access' => true,
        // ]);

        School::create([
            'name' => 'École Sainte Marie',
            'type' => 'Collège',
            'languages' => json_encode(['Français', 'Anglais']),
            'teaching_staff_count' => 25,
            'email' => 'sainte.marie@gest-school.com',
            'phone' => '+2289023xxxx',
            'address' => '456, Rue de l’Éducation',
            'city' => 'Lomé',
            'postal_code' => '00001',
            'username' => 'saintemarie', // Un username unique !
            'password' => Hash::make('SainteMarie2025###'),
            'has_sports_equipment' => true,
            'has_library' => false,
            'has_computer_room' => true,
            'has_handicap_access' => true,
        ]);
        
    }
}

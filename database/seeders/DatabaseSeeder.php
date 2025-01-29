<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Alec Thompson',
            'email' => 'admin@corporateui.com',
            'password' => Hash::make('secret'),
            'about' => "Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).",
        ]);
        
        User::factory()->create([
            'name' => '@dmin',
            'email' => 'admin@gest-school.com',
            'password' => Hash::make('@dminsecret'),
            'about' => "Apllication de gestion d'école.",
        ]);

        User::factory()->create([
            'name' => 'Ecole Test',
            'email' => 'testeur@gest-platform.com',
            'password' => Hash::make('Ecole01@2025'), 
            'about' => 'Utilisateur test pour expérimenter la plateforme de gestion d’école.',
        ]);
    }
}

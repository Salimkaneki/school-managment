<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            
            // Informations générales
            $table->string('name');
            $table->enum('type', ['École primaire', 'Collège', 'Lycée', 'École professionnelle']);
            
            // Informations pédagogiques
            $table->json('languages'); // Stockage des langues en JSON
            $table->integer('teaching_staff_count');
            
            // Coordonnées
            $table->string('email')->unique();
            $table->string('phone');
            
            // Localisation
            $table->text('address');
            $table->string('city');
            $table->string('postal_code');
            
            // Équipements (boolean pour chaque équipement)
            $table->boolean('has_sports_equipment')->default(false);
            $table->boolean('has_library')->default(false);
            $table->boolean('has_computer_room')->default(false);
            $table->boolean('has_handicap_access')->default(false);
            
            // Documents administratifs (chemins des fichiers)
            $table->string('rules_document_path')->nullable();
            $table->string('project_document_path')->nullable();
            $table->string('logo_path')->nullable();
            
            // Timestamps
            $table->timestamps();
            $table->softDeletes(); // Permet la suppression douce
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
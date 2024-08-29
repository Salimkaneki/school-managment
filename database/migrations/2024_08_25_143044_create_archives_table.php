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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('table_name'); // Le nom de la table d'où provient l'enregistrement archivé
            $table->unsignedBigInteger('record_id'); // L'ID de l'enregistrement original
            $table->json('archived_data'); // Les données de l'enregistrement sous forme de JSON
            $table->timestamp('archived_at')->useCurrent(); // La date d'archivage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};

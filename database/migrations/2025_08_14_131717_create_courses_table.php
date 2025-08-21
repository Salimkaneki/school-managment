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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // Relation avec teacher
            $table->foreignId('teacher_id')
                  ->constrained('teachers')
                  ->onDelete('cascade');

            // Relation avec school
            $table->foreignId('school_id')
                  ->constrained('schools') // ⚠️ si tu veux lier aux écoles
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

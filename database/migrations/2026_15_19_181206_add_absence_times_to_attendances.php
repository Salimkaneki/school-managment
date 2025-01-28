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
        Schema::table('attendances', function (Blueprint $table) {
            // Suppression de la colonne timetable_course_id si elle existe
            if (Schema::hasColumn('attendances', 'timetable_course_id')) {
                $table->dropForeign(['timetable_course_id']);
                $table->dropColumn('timetable_course_id');
            }

            // Ajout de la nouvelle colonne
            $table->json('absence_times')->nullable()->after('present');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Suppression de la colonne ajoutée
            $table->dropColumn('absence_times');

            // Recréation de la colonne timetable_course_id
            $table->foreignId('timetable_course_id')
                  ->after('class_id')
                  ->constrained('timetable_courses')
                  ->onDelete('cascade');
        });
    }
};
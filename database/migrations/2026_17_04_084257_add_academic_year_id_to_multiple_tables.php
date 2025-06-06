<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'classrooms', 'courses', 'timetables', 'timetable_courses',
            'attendances','class_classroom', 'teachers',
            'student_emergency_contacts', 'school_events', 'exams',
            'time_slots', 
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                $table->foreignId('academic_year_id')
                    ->nullable()
                    ->constrained('academic_years')
                    ->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        $tables = [
            'classrooms', 'courses', 'timetables', 'timetable_courses',
            'attendances', 'class_classroom', 'teachers',
            'student_emergency_contacts', 'school_events', 'exams',
            'time_slots', 
        
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropForeign(['academic_year_id']);
                $table->dropColumn('academic_year_id');
            });
        }
    }
};

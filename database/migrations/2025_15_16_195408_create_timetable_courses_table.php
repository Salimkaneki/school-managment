<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetableCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('timetable_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timetable_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->foreignId('classroom_id')->constrained()->onDelete('cascade');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('day', ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi']);
            $table->timestamps();
        
            // Ajouter l'index avec un nom plus court
            $table->index(['timetable_id', 'course_id', 'teacher_id', 'classroom_id'], 'timetable_course_idx');
            
            // Assurer que les créneaux horaires ne se chevauchent pas
            $table->unique(['classroom_id', 'day', 'start_time', 'end_time'], 'classroom_schedule_unique');
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
        });
        
    
    }

    public function down()
    {
        Schema::dropIfExists('timetable_courses');
    }
}

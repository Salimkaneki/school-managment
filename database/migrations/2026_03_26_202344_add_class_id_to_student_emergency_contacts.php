<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('student_emergency_contacts', function (Blueprint $table) {
            $table->foreignId('class_id')->after('student_id')->constrained('class_models')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('student_emergency_contacts', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropColumn('class_id');
        });
    }
    
};

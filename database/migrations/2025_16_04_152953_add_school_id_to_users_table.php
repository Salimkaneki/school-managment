<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->unsignedBigInteger('school_id')->nullable()->after('id');
            // $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->dropForeign(['school_id']);
            // $table->dropColumn('school_id');
        });
    }
    
};

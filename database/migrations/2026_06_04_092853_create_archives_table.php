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
            $table->string('table_name');
            $table->unsignedBigInteger('record_id');
            $table->json('archived_data');
            $table->foreignId('academic_year_id')->nullable()->constrained('academic_years')->onDelete('set null');
            $table->foreignId('archived_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('archive_reason')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();

            // Index pour améliorer les performances de recherche
            $table->index(['table_name', 'record_id'], 'idx_archives_table_record');
            $table->index('academic_year_id', 'idx_archives_academic_year');
            $table->index('archived_at', 'idx_archives_archived_at');
            $table->index('archived_by', 'idx_archives_archived_by');
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
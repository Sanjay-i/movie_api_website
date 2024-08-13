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
        Schema::create('tv_show_crew', function (Blueprint $table) {
            $table->foreignId('tv_show_id')->constrained('tv_shows')->onDelete('cascade');
            $table->foreignId('crew_id')->constrained('crews')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_show_crew');
    }
};

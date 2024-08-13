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
        Schema::create('tv_shows', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('overview')->nullable();
            $table->date('release_date')->nullable();
            $table->string('poster_path')->nullable();
            $table->integer('number_of_seasons')->nullable();
            $table->integer('number_of_episodes')->nullable();
            $table->integer('tmdb_id')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_shows');
    }
};

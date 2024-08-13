<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE VIEW media_view AS
        SELECT
            m.id AS movie_id,
            m.title AS movie_title,
            m.overview AS movie_overview,
            m.release_date AS movie_release_date,
            m.poster_path AS movie_poster_path,
            m.vote_average AS movie_vote_average,
            g.name AS genre_name,
            c.name AS cast_name,
            c.character AS cast_character,
            c.profile_path AS cast_profile_path,
            cr.name AS crew_name,
            cr.job AS crew_job,
            cr.department AS crew_department,
            tv.id AS tv_show_id,
            tv.title AS tv_show_title,
            tv.overview AS tv_show_overview,
            tv.release_date AS tv_show_release_date,
            tv.poster_path AS tv_show_poster_path,
            tv.vote_average AS tv_show_vote_average,
            s.season_number AS season_number,
            s.episode_count AS season_episode_count,
            s.poster_path AS season_poster_path,
            e.episode_number AS episode_number,
            e.title AS episode_title,
            e.overview AS episode_overview,
            e.air_date AS episode_air_date
        FROM
            movies m
        LEFT JOIN movie_genres mg ON m.id = mg.movie_id
        LEFT JOIN genres g ON mg.genre_id = g.id
        LEFT JOIN movie_cast mc ON m.id = mc.movie_id
        LEFT JOIN casts c ON mc.cast_id = c.id
        LEFT JOIN movie_crew mcr ON m.id = mcr.movie_id
        LEFT JOIN crews cr ON mcr.crew_id = cr.id
        LEFT JOIN tv_shows tv ON tv.id = m.id
        LEFT JOIN tv_show_genres tsg ON tv.id = tsg.tv_show_id
        LEFT JOIN tv_show_cast tsc ON tv.id = tsc.tv_show_id
        LEFT JOIN tv_show_crew tscw ON tv.id = tscw.tv_show_id
        LEFT JOIN seasons s ON tv.id = s.tv_show_id
        LEFT JOIN episodes e ON s.id = e.season_id;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS media_view");
    }
};

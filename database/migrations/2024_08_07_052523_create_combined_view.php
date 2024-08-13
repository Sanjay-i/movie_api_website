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
            CREATE VIEW combined_view AS
            SELECT
                users.id AS user_id,
                users.name AS user_name,
                orders.id AS order_id,
                orders.amount AS order_amount,
                products.name AS product_name
            FROM users
            JOIN orders ON users.id = orders.user_id
            JOIN products ON orders.product_id = products.id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS combined_view");
    }
};

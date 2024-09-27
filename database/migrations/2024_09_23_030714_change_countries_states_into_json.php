<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the 'states' column from the 'countries' table (if it exists).
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('states');
        });

        // Add a new 'states' column as JSON.
        Schema::table('countries', function (Blueprint $table) {
            $table->json('states')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'states' column (in case of rollback).
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('states');
        });

        // Revert the 'states' column back to text.
        Schema::table('countries', function (Blueprint $table) {
            $table->text('states')->nullable();
        });
    }
};

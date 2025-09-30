<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/..._create_people_table.php
public function up(): void
{
    Schema::create('people', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->bigInteger('tmdb_id')->unique();
        $table->string('profile_path')->nullable();
        $table->json('known_for')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};

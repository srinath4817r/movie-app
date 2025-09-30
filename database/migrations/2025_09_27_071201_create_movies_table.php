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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis');
            $table->date('release_date');
            $table->unsignedBigInteger('tmdb_id')->unique()->nullable();
            $table->string('poster_path')->nullable();
            $table->string('trailer_key')->nullable();
            $table->unsignedTinyInteger('tomatometer_score')->nullable(); // For critic score
            $table->unsignedTinyInteger('audience_score')->nullable();  // For user score
            $table->json('cast')->nullable();                           // To store cast members
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};


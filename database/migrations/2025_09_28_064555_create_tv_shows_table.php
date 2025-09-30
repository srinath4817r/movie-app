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
                $table->string('title');
                $table->text('synopsis');
                $table->date('first_air_date')->nullable();
                $table->unsignedBigInteger('tmdb_id')->unique()->nullable();
                $table->string('poster_path')->nullable();
                $table->string('trailer_key')->nullable();
                $table->unsignedTinyInteger('tomatometer_score')->nullable();
                $table->unsignedTinyInteger('audience_score')->nullable();
                $table->json('cast')->nullable();
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
    

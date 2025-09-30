<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class TvShow extends Model
    {
        use HasFactory;

        protected $table = 'tv_shows';

        protected $fillable = [
            'title',
            'synopsis',
            'first_air_date',
            'tmdb_id',
            'poster_path',
            'trailer_key',
            'tomatometer_score',
            'audience_score',
            'cast',
        ];

        protected $casts = [
            'cast' => 'array',
            'first_air_date' => 'date',
        ];
    }
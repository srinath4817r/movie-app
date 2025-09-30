<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'synopsis',
        'release_date',
        'tmdb_id',
        'poster_path',
        'trailer_key',
        'tomatometer_score',
        'audience_score',
        'cast',
        'runtime', // <-- Add this line
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'cast' => 'array',
        'release_date' => 'date', // <-- It's also good practice to have this
        'runtime' => 'integer',   // <-- And add this line
    ];
}
<?php 

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tmdb_id',
        'profile_path',
        'known_for',
    ];

    protected $casts = [
        'known_for' => 'array',
    ];
}
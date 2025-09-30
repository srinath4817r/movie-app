<?php

namespace App\Http\Controllers;

use App\Models\TvShow;
use Illuminate\Http\Request;

class TvShowController extends Controller
{
    /**
     * Display a listing of the TV Shows.
     */
    public function index()
    {
        // Fetch all TV shows from the database, ordered by the newest first
        $tvShows = TvShow::latest('first_air_date')->get();

        // Pass the TV shows to the view you created
        return view('tv-shows.index', ['tvShows' => $tvShows]);
    }
}
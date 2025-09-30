<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\TvShow;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the movies for the homepage.
     */
    public function home(Request $request)
    {
        // If there is a search request, only return the search results
        if ($request->has('search') && $request->input('search') !== '') {
            $searchTerm = $request->input('search');
            $movies = Movie::where('title', 'LIKE', "%{$searchTerm}%")->get();
            
            return view('welcome', [
                'movies' => $movies,
                'topRatedMovies' => [], // Send empty arrays when searching
                'popularTvShows' => [],
            ]);
        }

        // If not searching, fetch all the different categories
        $popularMovies = Movie::latest()->take(20)->get();
        $topRatedMovies = Movie::orderBy('tomatometer_score', 'desc')->take(20)->get();
        $popularTvShows = TvShow::latest()->take(20)->get();

        return view('welcome', [
            'movies' => $popularMovies,
            'topRatedMovies' => $topRatedMovies,
            'popularTvShows' => $popularTvShows,
        ]);
    }

    /**
     * Display a listing of all movies on the /movies page.
     */
    public function index()
    {
        $all_movies = Movie::paginate(20);
        return view('movies.index', [
            'movies' => $all_movies
        ]);
    }

    /**
     * Display the details of a single movie.
     */
    public function show(Movie $movie)
    {
        return view('movies.show', [
            'movie' => $movie
        ]);
    }
}


<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Movie;
use App\Models\Person; // <-- Add this
use App\Models\TvShow;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class FetchMoviesCommand extends Command
{
    protected $signature = 'movies:fetch';
    protected $description = 'Fetch data from TMDB';

    public function handle()
    {
        $this->info('Starting data fetch from TMDB...');

        $this->fetchTopRatedMovies();
        $this->fetchPopularTvShows();
        $this->fetchPopularPeople(); // <-- Add this
        $this->fetchPopularMovies(); 

        $this->info('Successfully fetched and stored all data!');
        return 0;
    }

    // ... (keep fetchPopularMovies, fetchTopRatedMovies, fetchPopularTvShows methods as they are) ...
    
    private function fetchPopularMovies()
    {
        $this->line('Fetching Popular Movies...');
        $movieDataArray = $this->fetchFromApi('/movie/popular');

        foreach ($movieDataArray as $movieData) {
            $this->processMediaItem($movieData, Movie::class, 'movie');
        }
    }

    private function fetchTopRatedMovies()
    {
        $this->line('Fetching Top Rated Movies...');
        $movieDataArray = $this->fetchFromApi('/movie/top_rated');

        foreach ($movieDataArray as $movieData) {
            $this->processMediaItem($movieData, Movie::class, 'movie');
        }
    }

    private function fetchPopularTvShows()
    {
        $this->line('Fetching Popular TV Shows...');
        $tvDataArray = $this->fetchFromApi('/tv/popular');

        foreach ($tvDataArray as $tvData) {
            $this->processMediaItem($tvData, TvShow::class, 'tv');
        }
    }
    
    // ADD THIS NEW METHOD FOR FETCHING PEOPLE
    private function fetchPopularPeople()
    {
        $this->line('Fetching Popular People...');
        $peopleDataArray = $this->fetchFromApi('/person/popular');

        foreach ($peopleDataArray as $personData) {
            $this->processPersonItem($personData);
        }
    }

    private function fetchFromApi(string $endpoint)
    {
        $apiKey = config('services.tmdb.key');
        if (!$apiKey) {
            $this->error('TMDB API key not found.');
            return [];
        }

        $response = Http::get('https://api.themoviedb.org/3' . $endpoint, ['api_key' => $apiKey]);

        if ($response->failed()) {
            $this->error("Failed to fetch data from {$endpoint}.");
            return [];
        }

        return $response->json()['results'];
    }

    private function processMediaItem(array $itemData, string $modelClass, string $type)
    {
        // ... (keep this method exactly as it is) ...
        $apiKey = config('services.tmdb.key');
        $title = $type === 'movie' ? $itemData['title'] : $itemData['name'];
        $this->info("Processing Media: {$title}");

        $videoResponse = Http::get("https://api.themoviedb.org/3/{$type}/{$itemData['id']}/videos", ['api_key' => $apiKey]);
        $officialTrailer = Arr::first($videoResponse->json()['results'] ?? [], fn($video) => $video['type'] === 'Trailer' && $video['site'] === 'YouTube');

        $creditsResponse = Http::get("https://api.themoviedb.org/3/{$type}/{$itemData['id']}/credits", ['api_key' => $apiKey]);
        $cast = collect($creditsResponse->json()['cast'] ?? [])->take(5)->map(fn($actor) => [
            'name' => $actor['name'],
            'profile_path' => $actor['profile_path'],
        ])->all();

        $dbData = [
            'title' => $title,
            'synopsis' => $itemData['overview'],
            'tmdb_id' => $itemData['id'],
            'poster_path' => $itemData['poster_path'],
            'trailer_key' => $officialTrailer['key'] ?? null,
            'tomatometer_score' => isset($itemData['vote_average']) ? round($itemData['vote_average'] * 10) : null,
            'audience_score' => isset($itemData['vote_average']) ? round($itemData['vote_average'] * 10) : null,
            'cast' => $cast,
        ];
        
        if ($type === 'movie') {
            $detailsResponse = Http::get("https://api.themoviedb.org/3/movie/{$itemData['id']}", ['api_key' => $apiKey]);
            $movieDetails = $detailsResponse->json();
            $dbData['release_date'] = $itemData['release_date'];
            $dbData['runtime'] = $movieDetails['runtime'] ?? null;
        } else {
            $dbData['first_air_date'] = $itemData['first_air_date'];
        }

        $modelClass::updateOrCreate(['tmdb_id' => $itemData['id']], $dbData);
    }

    // ADD THIS NEW METHOD FOR PROCESSING A PERSON
    private function processPersonItem(array $personData)
    {
        $this->info("Processing Person: {$personData['name']}");

        // Simplify the 'known_for' array to just be a list of titles
        $knownForTitles = collect($personData['known_for'])->map(function ($item) {
            return $item['title'] ?? $item['name'] ?? null;
        })->filter()->implode(', ');

        Person::updateOrCreate(
            ['tmdb_id' => $personData['id']],
            [
                'name' => $personData['name'],
                'profile_path' => $personData['profile_path'],
                'known_for' => $knownForTitles,
            ]
        );
    }
}
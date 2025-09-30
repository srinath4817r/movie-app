@extends('layouts.app')

@section('content')
    
    @if (request('search'))
        <h2 class="section-title">Search Results for "{{ request('search') }}"</h2>
    @else
        <h2 class="section-title">Popular Movies</h2>
    @endif

    <div class="movie-row">
        @forelse($movies as $movie)
            @include('partials.movie_card', ['media' => $movie])
        @empty
            <p id="no-results-message">No movies found matching your search.</p>
        @endforelse
    </div>

    @if (!request('search') && $topRatedMovies->isNotEmpty())
        <h2 class="section-title">Top Rated Movies</h2>
        <div class="movie-row">
            @foreach($topRatedMovies as $movie)
                @include('partials.movie_card', ['media' => $movie])
            @endforeach
        </div>
    @endif

    @if (!request('search') && $popularTvShows->isNotEmpty())
        <h2 class="section-title">Popular TV Shows</h2>
        <div class="movie-row">
            @foreach($popularTvShows as $show)
                @include('partials.movie_card', ['media' => $show])
            @endforeach
        </div>
    @endif

@endsection
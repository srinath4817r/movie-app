@extends('layouts.app')

@section('content')
    
    <h2 class="section-title">All Movies</h2>

    {{-- Using flex-wrap creates a grid that wraps to the next line --}}
    <div class="movie-row" style="flex-wrap: wrap; justify-content: center;">
        @forelse($movies as $movie)
            @include('partials.movie_card', ['media' => $movie])
        @empty
            <p>No movies found.</p>
        @endforelse
    </div>

@endsection
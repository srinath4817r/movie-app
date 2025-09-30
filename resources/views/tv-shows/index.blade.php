@extends('layouts.app')

@section('content')
    
    <h2 class="section-title">Popular TV Shows</h2>

    <div class="movie-row" style="flex-wrap: wrap; justify-content: center;">
        @forelse($tvShows as $show)
            @include('partials.movie_card', ['media' => $show])
        @empty
            <p>No TV shows found.</p>
        @endforelse
    </div>

@endsection
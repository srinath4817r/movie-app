@extends('layouts.app')

@section('content')
    <h2 class="section-title">Popular People</h2>

    <div class="people-grid">
        @forelse($people as $person)
            <div class="person-card">
                <img src="{{ $person->profile_path ? 'https://image.tmdb.org/t/p/w500'.$person->profile_path : 'https://via.placeholder.com/150x225?text=No+Image' }}" alt="{{ $person->name }}">
                <div class="person-name">
                    {{ $person->name }}
                </div>
            </div>
        @empty
            <p>No people have been added yet.</p>
        @endforelse
    </div>
@endsection
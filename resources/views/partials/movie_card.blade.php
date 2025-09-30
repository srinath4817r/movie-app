@php
    $runtime = null;
    if ($media instanceof \App\Models\Movie && $media->runtime) {
        $hours = floor($media->runtime / 60);
        $minutes = $media->runtime % 60;
        $runtime = "{$hours}h {$minutes}m";
    }
@endphp

<div class="card" style="background-image: url('https://image.tmdb.org/t/p/w500{{ $media->poster_path }}');">
    <div class="card-content">
        <div>
            <h3>{{ $media->title }}</h3>

            <div class="meta-info">
                @if ($media->release_date)
                    <span>{{ $media->release_date->format('Y') }}</span>
                @elseif ($media->first_air_date)
                    <span>{{ \Carbon\Carbon::parse($media->first_air_date)->format('Y') }}</span>
                @endif
                @if ($runtime)
                    <span>&bull;</span>
                    <span>{{ $runtime }}</span>
                @endif
            </div>

            <div class="scores">
                <div class="score-item">
                    <span class="icon"><img src="https://media.giphy.com/media/v74842lUBNz0u8BvoQ/giphy.gif" alt="Tomatometer"></span>
                    <span>{{ $media->tomatometer_score ?? 'N/A' }}%</span>
                </div>
                <div class="score-item">
                    <span class="icon"><img src="https://media.giphy.com/media/VfTl0D6DoDvrgP3CMk/giphy.gif" alt="Audience Score"></span>
                    <span>{{ $media->audience_score ?? 'N/A' }}%</span>
                </div>
            </div>
            
            <p class="synopsis">{{ $media->synopsis }}</p>

            @if ($media->trailer_key)
                <iframe class="trailer" src="https://www.youtube.com/embed/{{ $media->trailer_key }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            @endif
        </div>

        @if (!empty($media->cast))
            <div class="cast-section">
                <h4>Starring</h4>
                <ul class="cast-list">
                    @foreach ($media->cast as $actor)
                        <li>
                            <img src="{{ $actor['profile_path'] ? 'https://image.tmdb.org/t/p/w200'.$actor['profile_path'] : 'https://via.placeholder.com/40' }}" alt="{{ $actor['name'] }}">
                            <span>{{ $actor['name'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
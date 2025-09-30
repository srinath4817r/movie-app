<header class="robot-container">
    <h1>
        <span>Rotten</span>
        <div id="robot-placeholder"></div>
        <div class="robot" id="robot">
            <div class="eye left-eye"><div class="pupil"></div></div>
            <div class="eye right-eye"><div class="pupil"></div></div>
            <div class="mouth" id="mouth"></div>
            <div class="arm left-arm"></div>
            <div class="arm right-arm"></div>
        </div>
        <span>Tomatoes 🎬</span>
    </h1>
</header>

<nav class="main-nav">
    <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('movies.index') }}">Movies</a></li>
        <li><a href="{{ route('tv-shows.index') }}">TV Shows</a></li>
        <li><a href="{{ route('contact.index') }}">Contact Us</a></li>

        <li><a href="{{ route('people.index') }}">People</a></li>
    </ul>
</nav>

<div class="search-container">
    <form action="{{ route('home') }}" method="GET">
        <input type="text" name="search" placeholder="Search for a movie..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>
</div>


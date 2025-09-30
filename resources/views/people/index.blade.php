<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular People - Rotten Tomatoes Clone</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        body{font-family:Arial,sans-serif;background:#111;color:white;margin:0;padding-top:80px}
        .robot-container{position:fixed;top:0;left:0;width:100%;padding:15px 0;background-color:#1a1a2e;box-shadow:0 4px 10px rgba(0,0,0,.5);display:flex;justify-content:center;align-items:center;z-index:1000}
        .robot-container h1{color:#ff6347;margin:0;display:flex;align-items:center;gap:15px}
        .main-nav{background-color:#0d0d1a;padding:10px 0;display:flex;justify-content:center;box-shadow:0 2px 5px rgba(0,0,0,.3); position: fixed; top: 85px; width: 100%; z-index: 999;}
        .main-nav ul{list-style:none;margin:0;padding:0;display:flex;gap:40px}
        .main-nav a{color:white;text-decoration:none;font-weight:700;font-size:1.1rem;transition:color .3s;padding:5px 10px}
        .main-nav a:hover{color:#ffcc00}
        .content{padding: 80px 20px 20px 20px; max-width: 1200px; margin: 0 auto;}
        .content h2{color:#ffcc00; font-size: 2.5rem;}
        .people-grid{display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 20px;}
        .person-card{background-color: #222; border-radius: 8px; overflow: hidden; text-align: center;}
        .person-card img{width: 100%; height: 225px; object-fit: cover; display: block;}
        .person-card .person-name{padding: 10px; font-weight: bold; font-size: 1rem;}
    </style>
</head>
<body>

    @include('partials.header')

    <main class="content">
        <h2>Popular People</h2>
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
    </main>

</body>
</html>
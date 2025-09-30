<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotten Tomatoes Clone</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bree+Serif&family=Caveat:wght@400;700&family=Lobster&family=Monoton&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display+SC:ital,wght@0,400;0,700;1,700&family=Playfair+Display:ital,wght@0,400;0,700;1,700&family=Roboto:ital,wght@0,400;0,700;1,400;1,700&family=Source+Sans+Pro:ital,wght@0,400;0,700;1,700&family=Work+Sans:ital,wght@0,400;0,700;1,700&display=swap');
        body{font-family:Arial,sans-serif;background:#111;color:white;margin:0;padding-top:120px}.content{padding:20px}.section-title{margin:30px 0 10px 10px;color:#ffcc00}.movie-row{display:flex;gap:15px;overflow-x:auto;padding-bottom:20px;scroll-snap-type:x mandatory;padding: 10px;}.movie-row::-webkit-scrollbar{height:10px}.movie-row::-webkit-scrollbar-thumb{background:#555;border-radius:5px}
        .card{position:relative;width:150px;height:220px;border-radius:10px;overflow:visible;cursor:pointer;flex:0 0 auto;background-size:cover;background-position:center;transition:all .4s ease-in-out .6s;box-sizing:border-box;scroll-snap-align:start}
        .card:hover{width:500px;max-width:90vw;height:auto;min-height:500px;z-index:100}
        .card-content{position:absolute;inset:0;background:rgba(0,0,0,.9);opacity:0;transition:opacity .4s ease-in-out .8s;padding:20px;overflow-y:auto;display:flex;flex-direction:column;justify-content:space-between;border-radius:10px}
        .card-content::-webkit-scrollbar{width:8px}.card-content::-webkit-scrollbar-track{background:#222;border-radius:10px}.card-content::-webkit-scrollbar-thumb{background:#555;border-radius:10px}.card-content::-webkit-scrollbar-thumb:hover{background:#777}
        .card:hover .card-content{opacity:1}.card h3{margin:0 0 10px;font-size:24px;color:#ffcc00}.meta-info{display:flex;gap:10px;align-items:center;color:#ccc;margin-bottom:15px;font-weight:700}.scores{display:flex;gap:20px;align-items:center;margin-bottom:15px}.score-item{display:flex;align-items:center;gap:8px;font-size:1.2rem;font-weight:700}.score-item .icon img{width:36px;height:36px}.cast-section h4{margin:15px 0 5px;color:#ffcc00}.cast-list{padding-left:0;margin:0;list-style:none}.cast-list li{display:flex;align-items:center;gap:10px;margin-bottom:5px}.cast-list img{width:40px;height:40px;border-radius:50%;object-fit:cover;background-color:#333}.trailer{width:100%;height:250px;border:none;border-radius:8px;margin:15px 0;flex-shrink:0}.robot-container{position:fixed;top:0;left:0;width:100%;padding:15px 0;background-color:#1a1a2e;box-shadow:0 4px 10px rgba(0,0,0,.5);display:flex;justify-content:center;align-items:center;z-index:1000}.robot-container h1{color:#ff6347;margin:0;display:flex;align-items:center;gap:15px}#robot-placeholder{width:60px;height:60px;flex-shrink:0;transition:width .5s ease,height .5s ease}.robot{position:relative;width:60px;height:60px;background:linear-gradient(135deg,#89f7fe,#66a6ff);border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 0 20px rgba(102,166,255,.7);animation:bob 3s ease-in-out infinite;flex-shrink:0;cursor:pointer;transition:all .3s ease,top .5s ease-in-out,left .5s ease-in-out;z-index:1001}.robot::before,.robot::after{content:'';position:absolute;width:10px;height:10px;background-color:hotpink;border-radius:50%;opacity:0;transition:opacity .2s ease-in-out;z-index:-1}.robot::before{left:10px;top:30px}.robot::after{right:10px;top:30px}.robot:hover::before,.robot:hover::after{opacity:.7}@keyframes bob{0%{transform:translateY(0)}50%{transform:translateY(-6px)}100%{transform:translateY(0)}}.eye{position:absolute;top:20px;width:12px;height:12px;background-color:white;border-radius:50%;box-shadow:0 0 5px rgba(0,0,0,.5);display:flex;justify-content:center;align-items:center;transition:all .2s ease}.left-eye{left:15px}.right-eye{right:15px}.pupil{width:6px;height:6px;background-color:#333;border-radius:50%;transition:transform .1s ease-out,opacity .2s ease}.mouth{position:absolute;bottom:15px;width:25px;height:12px;background-color:transparent;border-bottom:3px solid #333;border-radius:0 0 25px 25px;transition:all .2s ease}.mouth.o-mouth{width:12px;height:12px;border-radius:50%;background-color:#333;border-bottom:none;transform:translateY(-2px)}.arm{position:absolute;top:55%;width:20px;height:8px;background-color:#66a6ff;border-radius:4px;box-shadow:0 0 8px rgba(102,166,255,.5);transition:transform .3s ease-in-out}.left-arm{left:-15px;transform-origin:right center}.right-arm{right:-15px;transform-origin:left center}.robot.questioning .mouth{border-color:transparent;bottom:18px;height:auto}.robot.questioning .mouth::before{content:'?';position:absolute;left:50%;transform:translateX(-50%);color:#333;font-size:24px;font-weight:700}.robot.joyful .eye{height:6px;width:14px;background:transparent;border-top:3px solid white;border-radius:14px 14px 0 0;box-shadow:none;top:22px}.robot.joyful .pupil{display:none}.robot.joyful .mouth{width:30px;height:15px;border-radius:0 0 30px 30px;border-bottom:4px solid #333;bottom:12px}.robot.sad .mouth{width:25px;height:12px;border-top:3px solid #333;border-bottom:none;border-radius:25px 25px 0 0;bottom:15px}.speech-bubble{position:absolute;bottom:110%;left:50%;transform:translateX(-50%) scale(0);background:linear-gradient(135deg,#89f7fe,#66a6ff);color:#2c3e50;padding:10px 15px;border-radius:15px;font-size:1rem;font-weight:700;white-space:nowrap;opacity:0;transition:transform .3s ease,opacity .3s ease;transform-origin:bottom center;z-index:1002;max-width:250px;overflow:hidden;text-overflow:ellipsis;box-shadow:0 2px 8px rgba(0,0,0,.3)}.speech-bubble.show{transform:translateX(-50%) scale(1);opacity:1}.speech-bubble::after{content:'';position:absolute;top:100%;left:50%;transform:translateX(-50%);border-width:8px;border-style:solid;border-color:#66a6ff transparent transparent transparent}.search-container{padding:10px 20px;background-color:#1a1a2e;text-align:center}.search-container input[type=text]{width:50%;padding:10px;border-radius:20px;border:2px solid #ffcc00;background-color:#333;color:white;font-size:1rem}.search-container button{padding:10px 20px;border-radius:20px;border:none;background-color:#ffcc00;color:#111;font-weight:700;cursor:pointer;margin-left:10px}.main-nav{background-color:#0d0d1a;padding:10px 0;display:flex;justify-content:center;box-shadow:0 2px 5px rgba(0,0,0,.3)}.main-nav ul{list-style:none;margin:0;padding:0;display:flex;gap:40px}.main-nav a{color:white;text-decoration:none;font-weight:700;font-size:1.1rem;transition:color .3s;padding:5px 10px;display:flex;align-items:center;gap:8px}.main-nav a:hover{color:#ffcc00}.nav-gif{width:0;height:28px;opacity:0;transition:width .3s ease,opacity .3s ease}.main-nav a:hover .nav-gif{width:28px;opacity:1}#home-gif{height:36px}.main-nav a:hover #home-gif{width:36px}
        .flying-char{position:fixed;z-index:9999;color:#ffcc00;font-weight:700;font-size:24px;pointer-events:none;transition:all .4s cubic-bezier(.5,-.8,.9,1);text-shadow:0 0 10px #ffcc00}
    </style>
</head>
<body>
    <header class="robot-container">
        <h1><span>Rotten</span><div id="robot-placeholder"></div><div class="robot" id="robot"><div class="speech-bubble" id="speech-bubble"></div><div class="eye left-eye"><div class="pupil"></div></div><div class="eye right-eye"><div class="pupil"></div></div><div class="mouth" id="mouth"></div><div class="arm left-arm"></div><div class="arm right-arm"></div></div><span>Tomatoes 🎬</span></h1>
    </header>
    
    <nav class="main-nav">
        <ul>
            <li><a href="{{ route('home') }}"><img class="nav-gif" id="home-gif" src="https://media.giphy.com/media/zvzqIAtzhkaHt5WNWg/giphy.gif"><span>Home</span></a></li>
            <li><a href="{{ route('movies.index') }}"><img class="nav-gif" src="https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExYWJ5NTZiemV6Y2txbGl5bnIzbnFheXZhdGExOXN1eGVzejRnMGJxMSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/9kEogO1vqtkocjFv59/giphy.gif"><span>Movies</span></a></li>
            <li><a href="{{ route('tv-shows.index') }}"><img class="nav-gif" src="https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExemZpYWkxOTJ6ZWdmemo1YXA0dnpzbnB1aXBqanMxenJkaDh5YTdkNyZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/D6Oxy9ExV6lQ2UJh09/giphy.gif"><span>TV Shows</span></a></li>
            <li><a href="{{ route('contact.index') }}"><img class="nav-gif" src="https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExcG1yY2RlbnA1cjVzbmJtN3QzdWowdXR0OHY3aDFicnFwbmU0M2owbiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/R2lTCMJwYqMpBkjeXI/giphy.gif"><span>Contact Us</span></a></li>
            <li><a href="{{ route('people.index') }}"><img class="nav-gif" src="https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExc2cyN2hueTh1M2twYnQ3MjY2N252dTBwc2JncGg4a3F5bmZweGY3NSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/InOmR5iypEVjUkNMym/giphy.gif"><span>People</span></a></li>
        </ul>
    </nav>

    <div class="search-container">
        <form action="{{ route('home') }}" method="GET"><input type="text" id="searchInput" name="search" placeholder="Search for a movie..." value="{{ request('search') }}"><button type="submit" id="searchButton">Search</button></form>
    </div>

    <main class="content">
        @yield('content')
    </main>
    
    {{-- MODIFIED: The entire script is replaced with the new, rewritten version --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- 1. SETUP ---
            const robot = document.getElementById('robot');
            const mouth = document.getElementById('mouth');
            const pupils = document.querySelectorAll('.pupil');
            const leftArm = document.querySelector('.left-arm');
            const robotPlaceholder = document.getElementById('robot-placeholder');
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('searchButton');
            const speechBubble = document.getElementById('speech-bubble');
            const contactForm = document.querySelector('.contact-form');

            // State variables
            let activeTarget = null; // Can be a card element or an input element
            let robotMode = 'header'; // 'header', 'card', 'search', 'form'

            // --- 2. CORE ROBOT MOVEMENT LOGIC ---

            // Main animation loop, runs every frame
            function updateRobotPosition() {
                if (robotMode === 'card' && activeTarget) {
                    const title = activeTarget.querySelector('h3');
                    if (title) {
                        const titleRect = title.getBoundingClientRect();
                        const cardRect = activeTarget.getBoundingClientRect();
                        robot.style.top = `${titleRect.top}px`;
                        robot.style.left = `${Math.min(titleRect.right + 10, cardRect.right - robot.offsetWidth - 10)}px`;
                    }
                }
                requestAnimationFrame(updateRobotPosition);
            }
            updateRobotPosition();

            function setRobotMode(newMode, target = null) {
                // If leaving a 'fixed' state, animate return to header
                if (robotMode !== 'header' && newMode === 'header') {
                    const placeholderRect = robotPlaceholder.getBoundingClientRect();
                    robot.style.top = `${placeholderRect.top}px`;
                    robot.style.left = `${placeholderRect.left}px`;
                    setTimeout(() => {
                        if (robotMode === 'header') { // Check if state hasn't changed again
                            robot.style.position = 'relative';
                        }
                    }, 500);
                }

                // If entering a 'fixed' state, prepare the robot
                if (robotMode === 'header' && newMode !== 'header') {
                    const robotRect = robot.getBoundingClientRect();
                    robot.style.position = 'fixed';
                    robot.style.top = `${robotRect.top}px`;
                    robot.style.left = `${robotRect.left}px`;
                    robotPlaceholder.style.width = `${robotRect.width}px`;
                }

                robotMode = newMode;
                activeTarget = target;
                
                // Clear any expressions from other modes
                robot.classList.remove('questioning', 'joyful', 'sad');
                speechBubble.classList.remove('show');

                // Apply new positions/expressions based on mode
                if (robotMode === 'search') {
                    const searchRect = searchButton.getBoundingClientRect();
                    robot.style.top = `${searchRect.top - robot.offsetHeight - 15}px`;
                    robot.style.left = `${searchRect.left + searchRect.width / 2 - robot.offsetWidth / 2}px`;
                    robot.classList.add('questioning');
                    speechBubble.textContent = 'What are you looking for?';
                    speechBubble.classList.add('show');
                } else if (robotMode === 'form' && activeTarget) {
                    const inputRect = activeTarget.getBoundingClientRect();
                    robot.style.top = `${inputRect.top - robot.offsetHeight - 10}px`;
                    robot.style.left = `${inputRect.left + inputRect.width / 2 - robot.offsetWidth / 2}px`;
                }
            }


            // --- 3. EVENT LISTENERS ---

            // For Movie Card hovering
            window.addEventListener('mousemove', (e) => {
                if (robotMode === 'search' || robotMode === 'form') return;

                let cardFound = null;
                for (const card of document.querySelectorAll('.card')) {
                    if (card.matches(':hover')) {
                        cardFound = card;
                        break;
                    }
                }

                if (cardFound && robotMode !== 'card') {
                    setRobotMode('card', cardFound);
                } else if (!cardFound && robotMode === 'card') {
                    setRobotMode('header');
                }
            });

            // For Search Bar
            searchInput.addEventListener('focus', () => setRobotMode('search', searchInput));
            searchInput.addEventListener('blur', () => {
                if (robotMode === 'search' && searchInput.value === '') {
                    setTimeout(() => setRobotMode('header'), 200);
                }
            });
            searchInput.addEventListener('input', () => {
                if (robotMode === 'search') speechBubble.textContent = searchInput.value || 'What are you looking for?';
            });

            // For Contact Form (if it exists on the page)
            if (contactForm) {
                const formInputs = contactForm.querySelectorAll('input, textarea');

                const animateChar = (char, startRect, endRect, isThrow) => {
                    const charEl = document.createElement('span');
                    charEl.className = 'flying-char';
                    charEl.textContent = char;
                    document.body.appendChild(charEl);
                    charEl.style.left = `${startRect.left}px`;
                    charEl.style.top = `${startRect.top}px`;
                    charEl.style.transform = 'scale(1.5)';
                    charEl.style.opacity = '1';
                    requestAnimationFrame(() => {
                        charEl.style.left = `${endRect.left}px`;
                        charEl.style.top = `${endRect.top}px`;
                        charEl.style.transform = isThrow ? 'scale(1)' : 'scale(0.2)';
                        charEl.style.opacity = '0';
                    });
                    setTimeout(() => { if(document.body.contains(charEl)) document.body.removeChild(charEl); }, 400);
                };

                formInputs.forEach(input => {
                    input.addEventListener('focus', (e) => setRobotMode('form', e.target));
                    input.addEventListener('blur', () => {
                        setTimeout(() => {
                            // Only return to header if focus hasn't moved to another form input
                            if (!Array.from(formInputs).includes(document.activeElement)) {
                                setRobotMode('header');
                            }
                        }, 200);
                    });
                    input.addEventListener('input', (e) => {
                        if (e.data && robotMode === 'form') {
                            leftArm.style.transform = 'rotate(45deg)';
                            setTimeout(() => { leftArm.style.transform = 'rotate(0deg)'; }, 300);
                            const armRect = leftArm.getBoundingClientRect();
                            const inputRect = activeTarget.getBoundingClientRect();
                            const start = { top: armRect.top, left: armRect.left + armRect.width / 2 };
                            const end = { top: inputRect.top + 10, left: inputRect.left + Math.min(10 + (activeTarget.value.length * 8), inputRect.width - 20) };
                            animateChar(e.data.slice(-1), start, end, true);
                        }
                    });
                    input.addEventListener('keydown', (e) => {
                        if (e.key === 'Backspace' && e.target.value.length > 0 && robotMode === 'form') {
                            const inputRect = activeTarget.getBoundingClientRect();
                            const mouthRect = mouth.getBoundingClientRect();
                            const start = { top: inputRect.top + 10, left: inputRect.left + Math.min(10 + (activeTarget.value.length * 8), inputRect.width - 20) };
                            const end = { top: mouthRect.top, left: mouthRect.left + mouthRect.width / 2 };
                            animateChar(e.target.value.slice(-1), start, end, false);
                            mouth.classList.add('o-mouth');
                            setTimeout(() => mouth.classList.remove('o-mouth'), 300);
                        }
                    });
                });
            }

            // For Search Results Page (runs once on load)
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('search') && urlParams.get('search') !== '') {
                setRobotMode('search', searchInput);
                setTimeout(() => {
                    const noResults = document.getElementById('no-results-message');
                    if (noResults) {
                        robot.className = 'robot sad';
                        speechBubble.textContent = 'Aww, nothing found.';
                    } else {
                        robot.className = 'robot joyful';
                        speechBubble.textContent = 'I found some movies!';
                    }
                }, 1000);
            }
        });
    </script>
</body>
</html>
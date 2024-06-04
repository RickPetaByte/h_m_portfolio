<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>H:M | Portfolio's</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/581ff810bc.js" crossorigin="anonymous"></script>

    <!-- Icon -->
    <link rel="shortcut icon" href="img/LogoCircle2.png">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="min-h-screen full-height flex-center" id="outer-container">
        <div id="main">
            @include('layouts.navigation')
            <div class="container">
                <div class="left-top"></div>
                <div class="right-top">
                    <h2 class="text-white">Title</h2>
                    <h3 class="text-white">SubTitle</h3>
                </div>
                <div class="left-bottom">
                    <p class="text-white aboutPortfolio">About ww wwwww wwwwawdawwwwwwwwwwwwwwwwwwwwwwwwwwwwww ww</p>
                    <h5 class="text-white">Name</h5>
                </div>
                <div class="right-bottom">
                    <h4 class="text-dark">Specialties</h4>
                    <div class="columns">
                    <ul>
                        <li class="text-dark">1. Drone vliegen</li>
                        <li class="text-dark">2. Gamen</li>
                        <li class="text-dark">3. Programeren</li>
                        <li class="text-dark">4. Met vrienden afspreken</li>
                        <li class="text-dark">5. Eten</li>
                        <li class="text-dark">6. Tennissen</li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function adjustFontSize() {
            // Title (h2)
            document.querySelectorAll('h2').forEach(element => {
                const length = element.textContent.length;
                if (length < 6) {
                    element.style.fontSize = '50px';
                } else if (length < 11) {
                    element.style.fontSize = '40px';
                } else {
                    element.style.fontSize = '26px';
                }
            });

            // SubTitle (h3)
            document.querySelectorAll('h3').forEach(element => {
                const length = element.textContent.length;
                if (length < 6) {
                    element.style.fontSize = '25px';
                } else if (length < 11) {
                    element.style.fontSize = '20px';
                } else {
                    element.style.fontSize = '15px';
                }
            });

            // Name (h5)
            document.querySelectorAll('h5').forEach(element => {
                const length = element.textContent.length;
                if (length < 6) {
                    element.style.fontSize = '20px';
                } else {
                    element.style.fontSize = '15px';
                }
            });

            // About (p)
            document.querySelectorAll('.aboutPortfolio').forEach(element => {
                const length = element.textContent.length;
                if (length < 50) {
                    element.style.fontSize = '20px';
                } else if (length < 85) {
                    element.style.fontSize = '17px';
                } else {
                    element.style.fontSize = '13px';
                }
            });

            // Specialties (li)
            document.querySelectorAll('.columns ul li').forEach(element => {
                const length = element.textContent.length;
                if (length < 6) {
                    element.style.fontSize = '25px';
                } else if (length < 11) {
                    element.style.fontSize = '20px';
                } else {
                    element.style.fontSize = '15px';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', adjustFontSize);
    </script>
</body>
</html>
<style>
    :root 
    {
        --img-location: url("img/portfolios/portfolio-1/Empty/Empty1-1.png");
        --img-profile: url("img/rick.png");
    }

    body, html 
    {
        height: 100%;
        margin: 0;
    }

    .container 
    {
        position: relative;
        width: calc(126mm * 1.1);
        height: calc(178.2mm * 1.1);
        max-width: 100vw;
        max-height: 100vh;
        margin-top: 20px;
        overflow: hidden;
        border: 3px solid black;
        border-radius: 5px;
    }

    .left-top, .right-top, .left-bottom, .right-bottom 
    {
        position: absolute;
        width: 50%;
        height: 50%;
    }

    .left-top 
    {
        top: 0;
        left: 0;
        background: var(--img-location) left top;
        background-size: 200% 200%;
    }

    .left-top::before 
    {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 110%;
        background: var(--img-profile) no-repeat center center;
        background-size: cover;
        z-index: -1 !important;
    }

    .right-top 
    {
        top: 0;
        right: 0;
        background: var(--img-location) right top;
        background-size: 200% 200%;
        z-index: 1;
        color: white;
    }

    .right-top h2 
    {
        margin: 50px 0px 0px 30px;
        max-width: 180px;
        word-wrap: break-word;
        text-transform: uppercase;
        font-weight: bold;
    }

    .right-top h3
    {
        margin: 0px 0px 10px 30px;
        max-width: 150px;
        word-wrap: break-word;
        text-transform: uppercase;
    }

    .left-bottom 
    {
        bottom: 0;
        left: 0;
        background: var(--img-location) left bottom;
        background-size: 200% 200%;
        z-index: 1;
    }

    .aboutPortfolio
    {
        margin: 30px 5px 10px 15px;
        max-width: 200px;
        word-wrap: break-word;
    }

    .right-bottom 
    {
        bottom: 0;
        right: 0;
        background: var(--img-location) right bottom;
        background-size: 200% 200%;
        z-index: 1;
        
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        align-items: center; 
        text-align: center; 
    }

    .left-bottom h5 
    {
        position: absolute;
        bottom: 5px; 
        left: 50%; 
        transform: translateX(-50%); 
        font-size: 12px;
        font-weight: bold;
    }

    .right-bottom h4
    {
        margin-top: -130px;
        margin-bottom: 10px;
        font-weight: bold;
        font-size: 25px;
    }

    .right-bottom ul
    {
        margin-bottom: -50px;
    }

    .right-bottom ul li
    {
        max-width: 150px;
        word-wrap: break-word;
        margin: 10px;
    }
    
    @media (max-width: 640px) 
    {
        .container 
        {
            display: none;
        }
    }
</style>
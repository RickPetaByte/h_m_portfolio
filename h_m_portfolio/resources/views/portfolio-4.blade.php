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
                <div class="left-top">
                    <div class="imgPortfolio"></div>
                    <h2 class="text-white">Title</h2>
                    <h3 class="text-white">SubTitle</h3>
                </div>
                <div class="right-top">
                    <h4 class="text-dark">Specialties</h4>
                    <div class="columns">
                        <ul>
                            <li class="text-dark">1. One</li>
                            <li class="text-dark">2. Two</li>
                            <li class="text-dark">3. Three</li>
                        </ul>
                    </div>
                </div>
                <div class="left-bottom">
                    <p class="text-white aboutPortfolio">About ww wwwww wwwwawdawwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww wwsss</p>
                </div>
                <div class="right-bottom">
                    <div class="columns">
                        <ul>
                            <li class="text-dark">4. Four</li>
                            <li class="text-dark">5. Five</li>
                            <li class="text-dark">6. Six</li>
                        </ul>
                    </div>
                    <h5 class="text-dark">Name</h5>
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
                    element.style.fontSize = '40px';
                } else if (length < 11) {
                    element.style.fontSize = '30px';
                } else {
                    element.style.fontSize = '20px';
                }
            });

            // SubTitle (h3)
            document.querySelectorAll('h3').forEach(element => {
                const length = element.textContent.length;
                if (length < 6) {
                    element.style.fontSize = '20px';
                } else if (length < 11) {
                    element.style.fontSize = '17px';
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
        --img-location: url("img/portfolios/portfolio-4/Empty/Empty1-4.png");
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

    .right-top 
    {
        top: 0;
        right: 0;
        background: var(--img-location) right top;
        background-size: 200% 200%;
        z-index: 1;
        color: white;
    }

    .imgPortfolio 
    {
        width: 210px !important;
        height: 210px !important;
        background: var(--img-profile) no-repeat center center;
        background-size: cover;
        z-index: 99;
        margin: 11px 0px 0px 8px; 
        border-radius: 200px;
        border: 4px solid white;
    }

    .left-top h2 
    {
        max-width: 180px;
        word-wrap: break-word;
        text-transform: uppercase;
        font-weight: bold;
        margin-top: 10px;
        margin-left: 15px;
        text-align: center;
    }

    .left-top h3
    {
        max-width: 180px;
        word-wrap: break-word;
        text-transform: uppercase;
        margin-left: 15px;
        text-align: center;
    }

    .right-top h4
    {
        margin: 40px 0px 10px -20px;
        font-weight: bold;
        font-size: 25px;
        text-align: center;
    }

    .right-bottom h5 
    {
        position: absolute;
        bottom: 5px; 
        left: 45%; 
        transform: translateX(-50%); 
        font-size: 12px;
        font-weight: bold;
    }

    .right-top ul
    {
        margin-top: 70px;
    }

    .right-top ul li
    {
        max-width: 200px;
        word-wrap: break-word;
        margin: 30px 0px 0px 0px;
    }

    .right-bottom ul li
    {
        max-width: 200px;
        word-wrap: break-word;
        margin: 30px 0px 0px 0px;
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
        margin: 40px 15px 10px 25px;
        word-wrap: break-word;
        max-width: 160px;
    }

    .right-bottom 
    {
        bottom: 0;
        right: 0;
        background: var(--img-location) right bottom;
        background-size: 200% 200%;
        z-index: 1;
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
    
    @media (max-width: 640px) 
    {
        .container 
        {
            display: none;
        }
    }
</style>
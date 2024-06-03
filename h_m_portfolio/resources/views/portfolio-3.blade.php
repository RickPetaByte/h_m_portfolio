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
                </div>
                <div class="right-top">
                    <h2>Title</h2>
                    <h3>SubTitle</h3>
                </div>
                <div class="bottom">
                    <h4>Specialties</h4>
                    <div class="columns">
                        <ul>
                            <li>One</li>
                            <li>Two</li>
                            <li>Three</li>
                        </ul>
                        <ul>
                            <li>Four</li>
                            <li>Five</li>
                            <li>Six</li>
                        </ul>
                    </div>
                    <h5>Name</h5>
                </div>
                <div class="absolute-container">
                    <p class="aboutPortfolio">About wwww wwww wwwwww ww www wwww ww wwww www w ww wwwww www ww</p>
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
        --img-location: url("img/portfolios/portfolio-3/Empty/Empty1-3.png");
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

    .imgPortfolio 
    {
        width: 190px !important;
        height: 190px !important;
        background: var(--img-profile) no-repeat center center;
        background-size: cover;
        z-index: 99;
        margin: 23px 0px 0px 27px; 
        border-radius: 200px;
        border: 4px solid white;
    }

    .right-top h2 
    {
        margin: 40px 0px 0px -20px;
        max-width: 250px;
        word-wrap: break-word;
        text-transform: uppercase;
        font-weight: bold;
    }

    .right-top h3 
    {
        margin: 0px 0px 10px -20px;
        max-width: 250px;
        word-wrap: break-word;
        text-transform: uppercase;
    }

    .bottom h4 
    {
        margin-top: 20px;
        margin-left: 30px;
        margin-bottom: 30px;
        font-weight: bold;
        font-size: 25px;
    }

    .bottom h5 
    {
        position: absolute;
        bottom: 5px; 
        left: 50%; 
        transform: translateX(-50%); 
        font-size: 12px;
        font-weight: bold;
    }

    .columns 
    {
        display: flex;
        margin-left: 30px;
    }

    .columns ul 
    {
        margin: 0;
        padding: 10px;
        list-style-type: none;
        margin-right: 20px; 
    }

    .columns ul li 
    {
        margin-bottom: 15px; 
    }

    .left-top, .right-top, .bottom 
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

    .bottom 
    {
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50%;
        background: var(--img-location) bottom;
        background-size: 100% 200%;
        z-index: 1;
    }

    .absolute-container 
    {
        position: absolute;
        top: 12rem; 
        left: 15rem; 
        width: 14rem; 
        height: auto; 
        z-index: 5;
    }

    .absolute-container .aboutPortfolio 
    {
        margin: 0; 
    }

    @media (max-width: 640px) 
    {
        .container {
            display: none;
        }
    }
</style>
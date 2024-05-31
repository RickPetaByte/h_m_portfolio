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
                    <h2 class="text-white">Title</h2>
                    <h3 class="text-white">SubTitle</h3>
                </div>
                <div class="right-top">
                    <div class="imgPortfolio"></div>
                </div>
                <div class="left-bottom">
                    <h4 class="text-white">Specialties</h4>
                    <div class="columns">
                        <ul>
                            <li class="text-white">One</li>
                            <li class="text-white">Two</li>
                            <li class="text-white">Three</li>
                        </ul>
                        <ul>
                            <li class="text-white">Four</li>
                            <li class="text-white">Five</li>
                            <li class="text-white">Six</li>
                        </ul>
                    </div>
                    <h5 class="text-white">Name</h5>
                </div>
                <div class="right-bottom"></div>
                <div class="absolute-container">
                    <p class="text-white aboutPortfolio">About wwww wwww wwwwww ww www wwww ww wwww www w ww wwwww www ww</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    :root 
    {
        --img-location: url("img/portfolios/portfolio-2/Empty/Empty1-2.png");
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

    .container::before 
    {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: inherit;
        transform: rotate(-45deg);
        transform-origin: top left;
        z-index: -2;
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

    .left-top h2 
    {
        margin: 40px 0px 0px 30px;
        font-size: 26px;
        max-width: 250px;
        word-wrap: break-word;
        text-transform: uppercase;
        font-weight: bold;
    }

    .left-top h3 
    {
        margin: 0px 0px 10px 30px;
        font-size: 15px;
        max-width: 250px;
        word-wrap: break-word;
        text-transform: uppercase;
    }

    .right-top 
    {
        top: 0;
        right: 0;
        background: var(--img-location) right top;
        background-size: 200% 200%;
        z-index: 100;
        color: white;
    }

    .imgPortfolio 
    {
        width: 215px !important;
        height: 215px !important;
        background: var(--img-profile) no-repeat center center;
        background-size: cover;
        z-index: 99;
        margin: 138px 0px 0px 14px; 
        border-radius: 200px;
        border: 4px solid white;
    }

    .left-bottom 
    {
        bottom: 0;
        left: 0;
        background: var(--img-location) left bottom;
        background-size: 200% 200%;
        z-index: 2;
    }

    .left-bottom h4 
    {
        margin-top: 80px;
        margin-left: 30px;
        margin-bottom: 10px;
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
        padding: 0;
        list-style-type: none;
        margin-right: 20px; 
    }

    .columns ul li 
    {
        font-size: 15px;
        max-width: 400px;
        word-wrap: break-word;
        margin-bottom: 5px; 
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
        margin-left: 10px;
        font-size: 15px;
        font-weight: bold;
    }

    .absolute-container 
    {
        position: absolute;
        top: 16rem; 
        left: 3rem; 
        width: 13rem; 
        height: auto; 
        z-index: 2;
    }

    .absolute-container .aboutPortfolio 
    {
        margin: 0; 
    }

    .aboutPortfolio 
    {
        font-size: 13px;
    }

    @media (max-width: 640px) 
    {
        .container 
        {
            display: none;
        }
    }
</style>
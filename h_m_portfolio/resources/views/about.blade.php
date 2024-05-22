<!DOCTYPE html>
<html class="theme-light" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('/css/about.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/dark-and-light.css') }}" rel="stylesheet">
    <title>About us</title>
</head>
    <body class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand text-white" href="#">LOGO</a>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                        </li>
                    </ul>
                    <div class="d-flex list-inline">
                        <html class="theme-light">
                            <div class="container-light-dark">
                                <div class="toggler">
                                    <label id="switch" class="switch">
                                        <input type="checkbox" onchange="toggleTheme()" id="slider">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            {{-- <div class="fl-path"></div>
                            <div class="fl-path-2"></div>
                            <div class="fl-path-1"></div>
                            <div class="fl-path-3"></div>
                            <div class="fl-path-4">
                                <span class="cr"></span>
                                <span class="eys"></span>
                            </div> --}}
                            {{-- <div class="star">
                                <span class="s-star"></span>
                                <span class="s-star"></span>
                                <span class="s-star"></span>
                                <span class="s-star"></span>
                            </div> --}}
                            {{-- <div class="cld">
                                <span class="cl"></span>
                                <span class="c2"></span>
                            </div> --}}
                            {{-- <div class="gt-hb">
                                <span class="ey"></span>
                                <span class="mt"></span>
                                <span class="bd"></span>
                            </div>
                            <div class="hs">
                                <span class="rf"></span>
                            </div>
                            <div class="hs-1">
                                <span class="win"></span>
                            </div>
                            </div> --}}
                        </html>
                        <li class="nav-item me-3">
                            <a class="nav-link text-white" href="#">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Register</a>
                        </li>
                    </div>
              </div>
            </div>
        </nav>
        <div class="container text-center mt-3">
            <h1>About us</h1>    
        </div>
        <div class="container vh-100 d-flex justify-content-center align-items-center">
            <div class="row">
                <div class="col">
                    <div>
                        <h1 class="">Rick</h1>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <h1 class="">Jur</h1>   
                    </div> 
                </div>
            </div>
        </div>   




        <script src="{{ asset('/js/dark-and-light.js') }}"></script>
    </body>
</html>
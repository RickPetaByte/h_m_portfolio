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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/581ff810bc.js" crossorigin="anonymous"></script>

        <!-- Font Family -->
        <!-- Font 1 -->
        <link href="https://fonts.googleapis.com/css2?family=Playwrite+NG+Modern:wght@100..400&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <!-- "Roboto", sans-serif; -->

        <!-- Font 2 -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <!-- "Montserrat", sans-serif; -->

        <!-- Font 3 -->
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
        <!-- "Oswald", sans-serif; -->

        <!-- Font 4 -->
        <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
        <!-- "Russo One", sans-serif; -->
        
        <!-- Font 5 -->
        <link href="https://fonts.googleapis.com/css2?family=Playwrite+ES+Deco:wght@100..400&display=swap" rel="stylesheet">
        <!-- "Playwrite ES Deco", cursive; -->

        <!-- Icon -->
        <link rel="shortcut icon" href="img/LogoCircle2.png">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @if (Auth::check()) 
            @php
                $userName = Auth::user()->name;
                $files = glob(public_path("$userName*"));
            @endphp
            
            @if(count($files) === 0)
                <div class="min-h-screen">
                    @include('layouts.navigation')

                    @include('layouts.create-portfolio-content')
                </div>
                @include('layouts.footer')
            @else
                <script>
                    window.location.href = "{{ asset(basename($files[0])) }}";
                </script>
            @endif
        @endif
    </body>
</html>
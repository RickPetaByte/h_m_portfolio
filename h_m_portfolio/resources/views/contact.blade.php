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
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Als je het form verzonden hebt op de contact page. -->
            @if (session()->has('success'))
                <div class="alert alert-success text-center mt-3 mb-2 alertSuccess" role="alert">
                    <h4 class="fw-bold">Succes!</h4><p>{{ session('success') }}</p>
                </div>
            @endif

            @include('layouts.contact-content')
        </div>
        @include('layouts.footer')
    </body>
</html>
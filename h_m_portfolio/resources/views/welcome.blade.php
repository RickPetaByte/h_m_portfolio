<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
        <link rel="shortcut icon" href="img/LogoCircle.png">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen" id="container">
            <div id="main">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Main Content -->
                <main>
                    <div class="container mx-auto px-4">
                        <div class="flex justify-center">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-10">
                                <p class="colorFirst welcomeText">Create your portfolio at H:M Portfolios</p>
                            </h1>
                        </div>
                    </div>
                </main>

                <!-- Logout Message -->
                @if(session('status'))
                    <div class="bg-green-200 text-green-800 py-2 px-4 border-green-400 rounded-lg my-4 mx-8">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        @include('layouts.footer')
    </body>
</html>
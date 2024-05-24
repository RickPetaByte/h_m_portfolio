<html class="theme-light" lang="en">
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
    <body class="">
        <div class="container text-center mt-3">
            <h1>About us</h1>    
        </div>
        <div class="container-fluid align-items-center mt-5">
            <div class="row d-flex justify-content-around">
                <div class="col-3">
                    <div class="hover-zoom">
                        <img class="rounded-5 img-thumbnail mt-2 w-100" src="/img/rick.PNG">
                        <ul class="d-flex justify-content-center mt-5 p-0">
                            <li><h1>Rick</h1></li>
                        </ul>
                        <hr class="about__hr">
                    </div>
                </div>
                
                <div class="col-3">
                    <div class="hover-zoom"> 
                        <img class="rounded-5 img-thumbnail mt-2 w-100" src="/img/jur.jpg">
                        <ul class="d-flex justify-content-center mt-3 p-0">
                            <li><h1>Jur</h1></li>
                        </ul>
                        <hr class="about__hr">
                    </div> 
                </div>
            </div>
        </div>  

        <div class="container-fluid">
            <div class="row d-flex justify-content-around me-2">
                <div class="col-3 text-justify">
                    <p class="text-center lh-base fs-4">
                        Rick is een coole en veelzijdige persoon met een positieve en energieke uitstraling. 
                        Zijn laid-back houding en creatieve geest inspireren en motiveren anderen. 
                        Hij houdt van nieuwe ervaringen en avonturen, en is altijd klaar voor een uitdaging met een glimlach. 
                        Rick's charme en humor verbeteren de sfeer in elk gezelschap.
                    </p>
                </div>
                <div class="col-3">
                    <p class="text-center lh-base fs-4">
                        Jur is charismatisch en toegewijd met een passie voor politiek en maatschappij. 
                        Met scherp analytisch vermogen en sterke visie durft hij complexe kwesties aan te pakken. 
                        Zijn leiderschap en communicatievaardigheden maken hem gerespecteerd en altijd klaar voor constructieve dialoog en verandering.
                    </p>
                </div>
            </div>
        </div>    
        <div class="container">
            <div class="mt-5 text-center mb-4">
                <h1>Wat is deze website?</h1>
                <h3 class="text-center lh-base mt-5">
                    Onze website maakt het gemakkelijk om professionele portfolio's te maken. 
                    Met aanpasbare sjablonen en gebruiksvriendelijke tools kunt u moeiteloos uw werk presenteren en delen.
                </h3>
            </div>
        </div>    
        <script src="/js/dark-and-light.js"></script>
    
    </body>
</html>
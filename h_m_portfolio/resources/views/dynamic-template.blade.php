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

    <style>
        .editable {
            cursor: pointer;
            border: 1px dashed transparent;
        }
        .editable:hover {
            border: 1px dashed #ccc;
        }
        .editing {
            border: 1px solid #000;
        }
        .save-btn {
            display: none;
            margin-top: 10px;
        }
        .save-btn.active {
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="min-h-screen full-height flex-center" id="outer-container">
    @include('layouts.navigation-2')
    <div id="main">

        <button id="sidebar-toggle">Open Sidebar</button>
        <div class="sidebar">
            <!-- Sidebar inhoud -->
            @if ($selected_image_alt === 'dynamic-template')
                @include('layouts.portfolio-1-color-selection')
            @elseif ($selected_image_alt === 'dynamic-template-2')
                @include('layouts.portfolio-2-color-selection')
            @elseif ($selected_image_alt === 'dynamic-template-3')
                @include('layouts.portfolio-3-color-selection')
            @elseif ($selected_image_alt === 'dynamic-template-4')
                @include('layouts.portfolio-4-color-selection')
            @endif
        </div>
        <style>
            .sidebar {
                width: 250px; /* Breedte van de sidebar */
                height: 100vh; /* Volledige viewport hoogte */
                position: fixed; /* Vastzetten aan het scherm */
                top: 0;
                left: -250px; /* Verberg de sidebar buiten het scherm */
                background-color: #f0f0f0; /* Achtergrondkleur van de sidebar */
                transition: left 0.3s ease; /* Animatie voor het openen/sluiten */
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Optionele schaduw */
            }

            .sidebar.open {
                left: 0; /* Toon de sidebar door deze naar links te verschuiven */
            }

            #sidebar-toggle {
                position: fixed; /* Vastzetten aan het scherm */
                top: 20px;
                left: 20px;
                z-index: 1000; /* Zorg ervoor dat de knop bovenop de sidebar staat */
                background-color: #007bff; /* Achtergrondkleur van de knop */
                color: #fff; /* Tekstkleur van de knop */
                padding: 10px 20px; /* Padding van de knop */
                border: none; /* Geen rand om de knop */
                cursor: pointer; /* Verander de cursor naar een pointer bij hover */
                border-radius: 5px; /* Optionele afronding van de hoeken */
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var sidebarToggle = document.getElementById('sidebar-toggle');
                var sidebar = document.querySelector('.sidebar');

                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('open');
                    if (sidebar.classList.contains('open')) {
                        sidebarToggle.textContent = 'Close Sidebar';
                    } else {
                        sidebarToggle.textContent = 'Open Sidebar';
                    }
                });
            });
        </script>



        <div class="container">
            <div class="left-top"></div>
            <div class="right-top">
                <h2 class="text-white" id="editableTitle">{{ $title }}</h2>
                <h3 class="text-white" id="editableSubtitle">{{ $subtitle }}</h3>
            </div>
            <div class="left-bottom">
                <p class="text-white aboutPortfolio" id="editableText">{{ $text }}</p>
                <h5 class="text-white" id="fixedName">{{ $name }}</h5>
            </div>
            <div class="right-bottom">
                <h4 class="text-dark">Specialties</h4>
                <div class="columns">
                    <ul>
                        <li class="text-dark editable" id="editableOne">1. {{ $one }}</li>
                        <li class="text-dark editable" id="editableTwo">2. {{ $two }}</li>
                        <li class="text-dark editable" id="editableThree">3. {{ $three }}</li>
                        <li class="text-dark editable" id="editableFour">4. {{ $four }}</li>
                        <li class="text-dark editable" id="editableFive">5. {{ $five }}</li>
                        <li class="text-dark editable" id="editableSix">6. {{ $six }}</li>
                    </ul>
                </div>
            </div>
            <button id="saveBtn" class="btn btn-primary save-btn text-white">Save Edits</button>
        </div>
    </div>
    <div>
        <form id="editForm" action="{{ route('update-html', ['fileName' => $fileName]) }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="htmlTitle" id="htmlTitle" maxlength="18">
            <input type="hidden" name="htmlSubTitle" id="htmlSubTitle" maxlength="18">
            <input type="hidden" name="htmlContent" id="htmlContent" maxlength="130">
            <input type="hidden" name="htmlOne" id="htmlOne" maxlength="20">
            <input type="hidden" name="htmlTwo" id="htmlTwo" maxlength="20">
            <input type="hidden" name="htmlThree" id="htmlThree" maxlength="20">
            <input type="hidden" name="htmlFour" id="htmlFour" maxlength="20">
            <input type="hidden" name="htmlFive" id="htmlFive" maxlength="20">
            <input type="hidden" name="htmlSix" id="htmlSix" maxlength="20">
            <input type="hidden" name="htmlTemplate" id="htmlTemplate" value="{{ $selected_image_alt }}">
            <input type="hidden" name="htmlPicture" id="htmlPicture" value="{{ $picture }}">
            <input type="hidden" name="htmlLayoutUrl" id="htmlLayoutUrl" value="{{ $selected_color_image_alt }}">
        </form>
    </div>
</div>

<script class="sendThisScriptToHomePage">
    function adjustFontSize() {
        // Title (h2)
        document.querySelectorAll('h2').forEach(element => {
            const length = element.textContent.length;
            if (length < 6) {
                element.style.fontSize = '40px';
            } else if (length < 11) {
                element.style.fontSize = '30px';
            } else {
                element.style.fontSize = '24px';
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
        --img-location: url("{{ $selected_color_image_alt }}");
        --img-profile: url("storage/{{ $picture }}");
    }

    #deleteButton 
    {
        position: relative;
        right: 50%;
        top: 32px;
        transform: translateY(-50%);
        padding: 6px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .text-white
    {
        color: white !important;
    }

    .editable 
    {
        cursor: pointer;
        border: 1px dashed transparent;
    }

    .editable:hover 
    {
        border: 1px dashed #ccc;
    }
    
    .editing 
    {
        border: 1px solid #000;
    }

    .save-btn 
    {
        display: none;
        margin-top: 10px;
    }

    .save-btn.active 
    {
        display: inline-block;
    }

    body, html 
    {
        height: 100%;
        margin: 0;
    }

    .container 
    {
        position: relative;
        width: calc(126mm * 1.2);
        height: calc(178.2mm * 1.2);
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
        /* .container 
        {
            display: none;
        } */
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const editableTitle = document.getElementById('editableTitle');
    const editableSubtitle = document.getElementById('editableSubtitle');
    const editableText = document.getElementById('editableText');
    const editableOne = document.getElementById('editableOne');
    const editableTwo = document.getElementById('editableTwo');
    const editableThree = document.getElementById('editableThree');
    const editableFour = document.getElementById('editableFour');
    const editableFive = document.getElementById('editableFive');
    const editableSix = document.getElementById('editableSix');

    const saveBtn = document.getElementById('saveBtn');
    const editForm = document.getElementById('editForm');

    const htmlTitleInput = document.getElementById('htmlTitle');
    const htmlSubTitleInput = document.getElementById('htmlSubTitle');
    const htmlContentInput = document.getElementById('htmlContent');
    const htmlOneInput = document.getElementById('htmlOne');
    const htmlTwoInput = document.getElementById('htmlTwo');
    const htmlThreeInput = document.getElementById('htmlThree');
    const htmlFourInput = document.getElementById('htmlFour');
    const htmlFiveInput = document.getElementById('htmlFive');
    const htmlSixInput = document.getElementById('htmlSix');

    function enableEditing(element) {
        element.contentEditable = true;
        element.classList.add('editing');
        saveBtn.classList.add('active');
        element.focus();
    }

    function disableEditing(element) {
        element.contentEditable = false;
        element.classList.remove('editing');
    }

    editableTitle.addEventListener('dblclick', () => enableEditing(editableTitle));
    editableSubtitle.addEventListener('dblclick', () => enableEditing(editableSubtitle));
    editableText.addEventListener('dblclick', () => enableEditing(editableText));
    editableOne.addEventListener('dblclick', () => enableEditing(editableOne));
    editableTwo.addEventListener('dblclick', () => enableEditing(editableTwo));
    editableThree.addEventListener('dblclick', () => enableEditing(editableThree));
    editableFour.addEventListener('dblclick', () => enableEditing(editableFour));
    editableFive.addEventListener('dblclick', () => enableEditing(editableFive));
    editableSix.addEventListener('dblclick', () => enableEditing(editableSix));

    saveBtn.addEventListener('click', () => {
        event.preventDefault();
        disableEditing(editableTitle);
        disableEditing(editableSubtitle);
        disableEditing(editableText);
        disableEditing(editableOne);
        disableEditing(editableTwo);
        disableEditing(editableThree);
        disableEditing(editableFour);
        disableEditing(editableFive);
        disableEditing(editableSix);

        saveBtn.classList.remove('active');

        htmlTitleInput.value = editableTitle.innerText.trim();
        htmlSubTitleInput.value = editableSubtitle.innerText.trim();
        htmlContentInput.value = editableText.innerText.trim();
        htmlOneInput.value = editableOne.innerText.trim().slice(3).trim();
        htmlTwoInput.value = editableTwo.innerText.trim().slice(3).trim();
        htmlThreeInput.value = editableThree.innerText.trim().slice(3).trim();
        htmlFourInput.value = editableFour.innerText.trim().slice(3).trim();
        htmlFiveInput.value = editableFive.innerText.trim().slice(3).trim();
        htmlSixInput.value = editableSix.innerText.trim().slice(3).trim();

        editForm.submit();
    });
});
</script>
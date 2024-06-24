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
        <button id="sidebar-toggle"><i id="sidebar-icon" class="fa-solid fa-bars text-white"></i></button>
        <div class="sidebar">
            @if ($selected_image_alt === 'dynamic-template-1')
                @include('layouts.portfolio-1-color-selection')
            @elseif ($selected_image_alt === 'dynamic-template-2')
                @include('layouts.portfolio-2-color-selection')
            @elseif ($selected_image_alt === 'dynamic-template-3')
                @include('layouts.portfolio-3-color-selection')
            @elseif ($selected_image_alt === 'dynamic-template-4')
                @include('layouts.portfolio-4-color-selection')
            @endif

            <!-- <div class="privacy-section">
                <label for="privacy" class="text-center imageEditLabel">Select new image:</label>
                <div class="image-container">
                    <img id="display-image" src="img/Standaard.png" alt="Standard Image">
                </div>
            </div>
            <input type="file" id="image-input" style="display: none;" accept="image/*"> -->

            <div class="privacy-section">
                <label for="privacy" class="text-center privateLabel">Display for everyone:</label>
                <div>
                    <input type="radio" id="yes" name="privacy" value="1" class="btnYes">
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="privacy" value="0" class="btnYes">
                    <label for="no">No</label>
                </div>
            </div>
        </div>
        <style>
            .sidebar {
                width: 250px;
                height: 100vh;
                position: fixed;
                top: 0;
                left: -250px;
                background-color: #f0f0f0;
                transition: left 0.3s ease;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }

            .btnYes {
                margin-left: 50px;
            }

            .privateLabel {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
                margin-top: 5px;
            }

            .imageEditLabel
            {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
                margin-top: -5px;
            }

            .image-container {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 10px;
                margin-bottom: 20px;
            }
            .image-container img {
                width: 120px;
                height: 120px;
                border: 2px solid black;
                border-radius: 5px;
            }

            .layoutsSidebar {
                margin-top: 75px;
            }

            .marginBottomSidebar {
                margin-bottom: -10px;
            }

            .sidebar.open {
                left: 0;
            }

            #sidebar-toggle {
                position: fixed;
                top: 85px;
                left: 20px;
                z-index: 1000;
                background-color: #007bff;
                color: #fff;
                padding: 10px 20px;
                border: none;
                cursor: pointer;
                border-radius: 5px;
                transition: top 0.3s ease;
            }

            #sidebar-toggle.open {
                top: 15px;
            }

            .img-container {
                display: flex;
                flex-wrap: wrap;
            }

            .img-container .col-md-6 {
                width: 50%;
                box-sizing: border-box;
                padding: 5px;
            }

            .img-container .col-md-6:nth-child(2n+1) {
                clear: left;
            }

            .img-selected {
                outline: 2px solid blue;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var sidebarToggle = document.getElementById('sidebar-toggle');
                var sidebarIcon = document.getElementById('sidebar-icon');
                var sidebar = document.querySelector('.sidebar');

                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('open');
                    sidebarToggle.classList.toggle('open');
                    if (sidebar.classList.contains('open')) {
                        sidebarIcon.classList.replace('fa-bars', 'fa-xmark');
                    } else {
                        sidebarIcon.classList.replace('fa-xmark', 'fa-bars');
                    }
                });

                var images = document.querySelectorAll('.img-container img');
                var selectedLayout = document.getElementById('editableLayoutUrl');

                images.forEach(function(img) {
                    img.addEventListener('click', function() {
                        images.forEach(function(image) {
                            image.classList.remove('img-selected');
                        });

                        img.classList.add('img-selected');
                        saveBtn.classList.add('active');

                        var altText = img.getAttribute('alt');
                        selectedLayout.textContent = altText;
                    });
                });

                var radioButtons = document.querySelectorAll('input[name="privacy"]');
                var privacyValue = document.getElementById('privacyValue');
                var privateValue = "{{ $private }}"; 

                // Selecteer de juiste radiobutton op basis van de waarde van privateValue
                radioButtons.forEach(function(radio) {
                    if (radio.value == privateValue) {
                        radio.checked = true;
                    }

                    radio.addEventListener('change', function() {
                        privacyValue.textContent = this.value;
                        saveBtn.classList.add('active');
                    });
                });
            });

            // Image selector
            document.getElementById('display-image').addEventListener('click', function() {
                document.getElementById('image-input').click();
            });

            document.getElementById('image-input').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('display-image').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
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
                <h4 class="text-dark" id="editableSpecialties">{{ $specialties }}</h4>
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
            <h4 id="editableLayoutUrl" style="display: none;">{{ $selected_color_image_alt }}</h4>
            <h1 id="privacyValue" style="display: none;">{{ $private }}</h1>
            <button id="saveBtn" class="btn btn-primary save-btn text-white"><i class="fa-solid fa-floppy-disk text-white mr-1"></i>Save Edits</button>
        </div>
    </div>
    <div>
        <form id="editForm" action="{{ route('update-html', ['fileName' => $fileName]) }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="htmlTitle" id="htmlTitle" maxlength="18">
            <input type="hidden" name="htmlSubTitle" id="htmlSubTitle" maxlength="18">
            <input type="hidden" name="htmlContent" id="htmlContent" maxlength="130">
            <input type="hidden" name="htmlSpecialties" id="htmlSpecialties" maxlength="18">
            <input type="hidden" name="htmlOne" id="htmlOne" maxlength="20">
            <input type="hidden" name="htmlTwo" id="htmlTwo" maxlength="20">
            <input type="hidden" name="htmlThree" id="htmlThree" maxlength="20">
            <input type="hidden" name="htmlFour" id="htmlFour" maxlength="20">
            <input type="hidden" name="htmlFive" id="htmlFive" maxlength="20">
            <input type="hidden" name="htmlSix" id="htmlSix" maxlength="20">
            <input type="hidden" name="htmlTemplate" id="htmlTemplate" value="{{ $selected_image_alt }}">
            <input type="hidden" name="htmlPicture" id="htmlPicture" value="{{ $picture }}">
            <input type="hidden" name="htmlLayoutUrl" id="htmlLayoutUrl">
            <input type="hidden" name="htmlPrivacyValue" id="htmlPrivacyValue">
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

        const editableSpecialties = document.getElementById('editableSpecialties');

        const editableOne = document.getElementById('editableOne');
        const editableTwo = document.getElementById('editableTwo');
        const editableThree = document.getElementById('editableThree');
        const editableFour = document.getElementById('editableFour');
        const editableFive = document.getElementById('editableFive');
        const editableSix = document.getElementById('editableSix');
        const editableLayoutUrl = document.getElementById('editableLayoutUrl');
        const privacyValue = document.getElementById('privacyValue');

        const saveBtn = document.getElementById('saveBtn');
        const editForm = document.getElementById('editForm');

        const htmlTitleInput = document.getElementById('htmlTitle');
        const htmlSubTitleInput = document.getElementById('htmlSubTitle');
        const htmlContentInput = document.getElementById('htmlContent');

        const htmlSpecialtiesInput = document.getElementById('htmlSpecialties');

        const htmlOneInput = document.getElementById('htmlOne');
        const htmlTwoInput = document.getElementById('htmlTwo');
        const htmlThreeInput = document.getElementById('htmlThree');
        const htmlFourInput = document.getElementById('htmlFour');
        const htmlFiveInput = document.getElementById('htmlFive');
        const htmlSixInput = document.getElementById('htmlSix');
        const htmlLayoutUrlInput = document.getElementById('htmlLayoutUrl');
        const htmlPrivacyValue = document.getElementById('htmlPrivacyValue');

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

        editableSpecialties.addEventListener('dblclick', () => enableEditing(editableSpecialties));

        editableOne.addEventListener('dblclick', () => enableEditing(editableOne));
        editableTwo.addEventListener('dblclick', () => enableEditing(editableTwo));
        editableThree.addEventListener('dblclick', () => enableEditing(editableThree));
        editableFour.addEventListener('dblclick', () => enableEditing(editableFour));
        editableFive.addEventListener('dblclick', () => enableEditing(editableFive));
        editableSix.addEventListener('dblclick', () => enableEditing(editableSix));
        editableLayoutUrl.addEventListener('dblclick', () => enableEditing(editableLayoutUrl));
        privacyValue.addEventListener('dblclick', () => enableEditing(privacyValue));

        saveBtn.addEventListener('click', () => {
            event.preventDefault();
            disableEditing(editableTitle);
            disableEditing(editableSubtitle);
            disableEditing(editableText);

            disableEditing(editableSpecialties);

            disableEditing(editableOne);
            disableEditing(editableTwo);
            disableEditing(editableThree);
            disableEditing(editableFour);
            disableEditing(editableFive);
            disableEditing(editableSix);
            disableEditing(editableLayoutUrl);
            disableEditing(privacyValue);

            saveBtn.classList.remove('active');

            htmlTitleInput.value = editableTitle.innerText.trim();
            htmlSubTitleInput.value = editableSubtitle.innerText.trim();
            htmlContentInput.value = editableText.innerText.trim();

            htmlSpecialtiesInput.value = editableSpecialties.innerText.trim();

            htmlOneInput.value = editableOne.innerText.trim();
            htmlTwoInput.value = editableTwo.innerText.trim();
            htmlThreeInput.value = editableThree.innerText.trim();
            htmlFourInput.value = editableFour.innerText.trim();
            htmlFiveInput.value = editableFive.innerText.trim();
            htmlSixInput.value = editableSix.innerText.trim();
            htmlLayoutUrlInput.value = editableLayoutUrl.innerText.trim();
            htmlPrivacyValue.value = privacyValue.innerText.trim();

            editForm.submit();
        });
    });
</script>
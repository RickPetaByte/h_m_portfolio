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
        <form action="{{ route('delete-portfolio') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete the portfolio?');">
            @csrf
            <input type="hidden" name="file_name" value="{{ $fileName }}">
            <button type="submit" class="btn btn-danger text-white fw-bold" id="deleteButton">
                <i class="fa fa-trash text-white mr-2"></i>Delete Portfolio
            </button>
        </form>
        <div class="container">
            <div class="left-top">
                <h2 class="text-white" id="editableTitle">{{ $title }}</h2>
                <h3 class="text-white" id="editableSubtitle">{{ $subtitle }}</h3>
            </div>
            <div class="right-top">
                <div class="imgPortfolio"></div>
            </div>
            <div class="left-bottom">
                <h4 class="text-white">Specialties</h4>
                <div class="columns" style="width: 375px;">
                    <ul>
                        <li class="text-white editable" id="editableOne">1. {{ $one }}</li>
                        <li class="text-white editable" id="editableTwo">2. {{ $two }}</li>
                        <li class="text-white editable" id="editableThree">3. {{ $three }}</li>
                    </ul>
                    <ul>
                        <li class="text-white editable" id="editableFour">4. {{ $four }}</li>
                        <li class="text-white editable" id="editableFive">5. {{ $five }}</li>
                        <li class="text-white editable" id="editableSix">6. {{ $six }}</li>
                    </ul>
                </div>
                <h5 class="text-white" id="fixedName">{{ $name }}</h5>
            </div>
            <div class="right-bottom"></div>
            <div class="absolute-container">
                <p class="text-white aboutPortfolio" id="editableText">{{ $text }}</p>
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
                element.style.fontSize = '50px';
            } else if (length < 11) {
                element.style.fontSize = '40px';
            } else {
                element.style.fontSize = '26px';
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

    .left-top h2 
    {
        margin: 40px 0px 0px 30px;
        max-width: 250px;
        word-wrap: break-word;
        text-transform: uppercase;
        font-weight: bold;
    }

    .left-top h3 
    {
        margin: 0px 0px 10px 30px;
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
        font-size: 25px;
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
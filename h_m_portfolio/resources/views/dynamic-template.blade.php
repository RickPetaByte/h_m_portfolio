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
    @include('layouts.navigation-2')
    <div id="main">
        <form action="{{ route('delete-portfolio') }}" method="POST">
            @csrf
            <input type="hidden" name="file_name" value="{{ $fileName }}">
            <button type="submit" class="btn btn-danger text-white fw-bold" id="deleteButton">
                <i class="fa fa-trash text-white mr-2"></i>Delete Portfolio
            </button>
        </form>
        <div class="container">
            <div class="left-top"></div>
            <div class="right-top">
                <h2 class="text-white editable" id="editableTitle">{{ $title }}</h2>
                <h3 class="text-white editable" id="editableSubtitle">{{ $subtitle }}</h3>
            </div>
            <div class="left-bottom">
                <p class="text-white aboutPortfolio editable" id="editableText">{{ $text }}</p>
                <h5 class="text-white">{{ $name }}</h5>
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
        </div>
        <button id="saveBtn" class="btn btn-primary save-btn">Save Edits</button>
        <form id="editForm" action="{{ route('update-html', ['fileName' => $fileName]) }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="htmlTitle" id="htmlTitle">
            <input type="hidden" name="htmlSubtitle" id="htmlSubtitle">
            <input type="hidden" name="htmlText" id="htmlText">
            <input type="hidden" name="htmlOne" id="htmlOne">
            <input type="hidden" name="htmlTwo" id="htmlTwo">
            <input type="hidden" name="htmlThree" id="htmlThree">
            <input type="hidden" name="htmlFour" id="htmlFour">
            <input type="hidden" name="htmlFive" id="htmlFive">
            <input type="hidden" name="htmlSix" id="htmlSix">
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editable = {
            editableTitle: document.querySelectorAll('.editableTitle'),
            editableSubtitle: document.querySelectorAll('.editableSubtitle'),
            editableText: document.querySelectorAll('.editableText'),
            editableOne: document.querySelectorAll('.editableOne'),
            editableTwo: document.querySelectorAll('.editableTwo'),
            editableThree: document.querySelectorAll('.editableThree'),
            editableFour: document.querySelectorAll('.editableFour'),
            editableFive: document.querySelectorAll('.editableFive'),
            editableSix: document.querySelectorAll('.editableSix'),
            saveBtn: document.getElementById('saveBtn'),
            htmlTitleInput: document.getElementById('htmlTitle'),
            htmlSubtitleInput: document.getElementById('htmlSubtitle'),
            htmlTextInput: document.getElementById('htmlText'),
            htmlOne: document.getElementById('htmlOne'),
            htmlTwo: document.getElementById('htmlTwo'),
            htmlThree: document.getElementById('htmlThree'),
            htmlFour: document.getElementById('htmlFour'),
            htmlFive: document.getElementById('htmlFive'),
            htmlSix: document.getElementById('htmlSix')
        };

        const editableArray = Array.editable;
        // const saveButton = document.createElement('button');
        // saveButton.textContent = 'Opslaan';
        // saveButton.className = 'save-btn';
        // saveButton.style.display = 'none';

        // document.body.appendChild(saveButton);

        function enableEditing(element) {
            // element.contentEditable = true;
            element.classList.add('editing');
            saveBtn.classList.add('active');
            element.focus();
        }
        
        function disableEditing(element) {
            // element.contentEditable = false;
            element.classList.remove('editing');
        }

        editableTitle.addEventListener('dblclick', () => {
            enableEditing(editableTitle);
        });

        editableSubtitle.addEventListener('dblclick', () => {
            enableEditing(editableSubtitle);
        });

        editableText.addEventListener('dblclick', () => {
            enableEditing(editableText);
        });

        editableOne.addEventListener('dblclick', () => {
            enableEditing(editableOne);
        });

        editableTwo.addEventListener('dblclick', () => {
            enableEditing(editableTwo);
        });

        editableThree.addEventListener('dblclick', () => {
            enableEditing(editableThree);
        });

        editableFour.addEventListener('dblclick', () => {
            enableEditing(editableFour);
        });

        editableFive.addEventListener('dblclick', () => {
            enableEditing(editableFive);
        });

        editableSix.addEventListener('dblclick', () => {
            enableEditing(editableSix);
        });

        editableArray.forEach(element => {
            element.addEventListener('dblclick', function() {
                // element.contentEditable = true;
                element.classList.add('editing');
                saveButton.style.display = 'block';
            });
        });

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

            // Update the form values
            htmlTitleInput.value = editableTitle.innerText.trim();
            htmlSubtitleInput.value = editableSubtitle.innerText.trim();
            htmlTextInput.value = editableText.innerText.trim();
            htmlOne.value = editableOne.innerText.trim();
            htmlTwo.value = editableTwo.innerText.trim();
            htmlThree.value = editableThree.innerText.trim();
            htmlFour.value = editableFour.innerText.trim();
            htmlFive.value = editableFive.innerText.trim();
            htmlSix.value = editableSix.innerText.trim();      

            console.log('Title:', htmlTitleInput.value);
            console.log('Subtitle:', htmlSubtitleInput.value);
            console.log('Text:', editableText.value);
            console.log('One:', editableOne.value);
            console.log('Two:', editableTwo.value);
            console.log('Three:', editableThree.value);
            console.log('Four:', editableFour.value);
            console.log('Five:', editableFive.value);
            console.log('Six:', editableSix);

            // Submit the form
            editForm.submit();
        });

        // saveButton.addEventListener('click', function() {
        //     const updatedData = {};

        //     editables.forEach(element => {
        //         element.contentEditable = false;
        //         element.classList.remove('editing');
        //         updatedData[element.id] = element.textContent.trim();
        //     });

        //     saveButton.style.display = 'none';
        //     saveData(updatedData);
        // });

        function saveData(data) {
            document.getElementById('htmlTitle').value = data.editableTitle || '';
            document.getElementById('htmlSubtitle').value = data.editableSubtitle || '';
            document.getElementById('htmlText').value = data.editableText || '';
            document.getElementById('htmlOne').value = data.editableOne || '';
            document.getElementById('htmlTwo').value = data.editableTwo || '';
            document.getElementById('htmlThree').value = data.editableThree || '';
            document.getElementById('htmlFour').value = data.editableFour || '';
            document.getElementById('htmlFive').value = data.editableFive || '';
            document.getElementById('htmlSix').value = data.editableSix || '';

            document.getElementById('editForm').submit();
        }

        var csrfToken = $('[name="csrf_token"]').attr('content');
            
        setInterval(refreshToken, 300); // 1 hour 
        
        function refreshToken(){
            $.get('refresh-csrf').done(function(data){
                csrfToken = data; // the new token
            });
        }

        setInterval(refreshToken, 300); // 1 hour 

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
    });
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
        right: -80%; 
        top: 86px;
        transform: translateY(-50%);
        padding: 10px 20px;
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
        .container 
        {
            display: none;
        }
    }
</style>
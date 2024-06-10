<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="{{ asset('C:/Github/laravel_portfolio/laravel_portfolio/public/css/bootstrap-5.3.3/bootstrap-5.3.3/dist/css/bootstrap.min.css') }}"> -->
    <title>Portfolio</title>
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
        <div class="container">
            <h1 class="editable" id="editableTitle">{{ $title }}</h1>
            <!-- <p class="editable" id="editableText">{{ $text }}</p> -->
            <button id="saveBtn" class="save-btn">Save Edits</button>
            <!-- <a href="{{ route('download-pdf', ['fileName' => $fileName]) }}" id="downloadPdfBtn" class="btn btn-primary">Download als PDF</a> -->
        </div>

        <form id="editForm" action="{{ route('update-html', ['fileName' => $fileName]) }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="htmlTitle" id="htmlTitle">
            <input type="hidden" name="htmlContent" id="htmlContent">
        </form>

            <script>
            document.addEventListener('DOMContentLoaded', () => {
                const editableTitle = document.getElementById('editableTitle');
                const editableText = document.getElementById('editableText');
                const saveBtn = document.getElementById('saveBtn');
                const editForm = document.getElementById('editForm');
                const htmlTitleInput = document.getElementById('htmlTitle');
                const htmlContentInput = document.getElementById('htmlContent');

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

                editableTitle.addEventListener('dblclick', () => {
                    enableEditing(editableTitle);
                });

                editableText.addEventListener('dblclick', () => {
                    enableEditing(editableText);
                });

                saveBtn.addEventListener('click', () => {
                    disableEditing(editableTitle);
                    disableEditing(editableText);
                    saveBtn.classList.remove('active');

                    // Update the form and submit it
                    htmlTitleInput.value = editableTitle.innerText;
                    htmlContentInput.value = editableText.innerText;
                    editForm.submit();
                });

                document.getElementById('downloadPdfBtn').addEventListener('click', function (event) {
                    event.preventDefault();

                    // Vervang 'mijnbestand.html' door de werkelijke bestandsnaam van de gegenereerde HTML
                    var fileName = '{{ $fileName }}';

                    // Maak een AJAX-verzoek naar de route om het PDF-bestand te genereren en te downloaden
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '/download-pdf/' + fileName, true);
                    xhr.responseType = 'blob';

                    xhr.onload = function () {
                        if (this.status === 200) {
                            var blob = new Blob([this.response], { type: 'application/pdf' });
                            var link = document.createElement('a');
                            link.href = window.URL.createObjectURL(blob);
                            link.download = fileName.replace('.html', '.pdf');
                            link.click();
                        }
                    };

                    xhr.send();
                });
            });
        </script>
    </body>
</html>
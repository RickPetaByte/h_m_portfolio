<div class="containerCreate">
    <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Title and SubTitle -->
        <div class="input-container colorSecond mt-5 divCreatePage">
            <label for="title">Title:</label>
            <!-- Max 18 characters -->
            <x-text-input name="title" type="text" class="form-control mb-3 backgroundTransparant" maxlength="18" required />
            <label for="subtitle">Sub-Title:</label>
            <!-- Max 18 characters -->
            <x-text-input name="subtitle" type="text" class="form-control backgroundTransparant" maxlength="18" required />
        </div>

        <!-- Image and Image Selection -->
        <div class="input-container colorSecond divCreatePage">
            <label class="custom-file-upload btn btn-primary text-white btnUploadPicture">
                <i class="fa-solid fa-upload mr-2 text-white"></i>Upload picture
                <input id="picture" name="picture" type="file" accept="image/*" onchange="previewImage(event)" />
            </label>
            <x-input-error class="mt-2" :messages="$errors->get('picture')" />
            <img id="picture-preview" src="img/Standaard.png" class="mt-4 img-thumbnail d-block mx-auto" />
        </div>

        <!-- Six Inputs -->
        <div class="input-container colorSecond divCreatePage">
            <label>Things about yourself:</label>
            <div class="row">
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="one" type="text" class="form-control backgroundTransparant" />
                </div>
                <!-- Max 20 characters -->
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="two" type="text" class="form-control backgroundTransparant" />
                </div>
                <!-- Max 20 characters -->
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="three" type="text" class="form-control backgroundTransparant" />
                </div>
                <!-- Max 20 characters -->
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="four" type="text" class="form-control backgroundTransparant" />
                </div>
                <!-- Max 20 characters -->
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="five" type="text" class="form-control backgroundTransparant" />
                </div>
                <!-- Max 20 characters -->
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="six" type="text" class="form-control backgroundTransparant" />
                </div>
                <!-- Max 20 characters -->
            </div>
        </div>

        <!-- About -->
        <div class="input-container colorSecond divCreatePage">
            <label for="about">About:</label>
            <textarea name="about" class="form-control mt-3 aboutCreatePortfolio mt-1 block w-100 shadow-none" rows="5" style="resize: none;" maxlength="130"></textarea>
        </div>

        @if (Auth::check())
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        @endif

        <!-- Privacy -->
        <div class="input-container colorSecond divCreatePage">
            <label>Private:</label>
            <div class="form-check mt-2">
                <input type="radio" id="yes" name="private" value="1" class="form-check-input colorCheckBox shadow-none" checked>
                <label for="yes" class="form-check-label ml-3">Yes</label>
            </div>
            <div class="form-check">
                <input type="radio" id="no" name="private" value="0" class="form-check-input colorCheckBox shadow-none">
                <label for="no" class="form-check-label ml-3">No</label>
            </div>
            <p class="mt-3 textInfoPrivacy">If you select 'Yes' other people can't see your portfolio. If you select 'No' other people can see your portfolio.</p>
        </div>

        <!-- Portfolio layout selection -->
        <div class="input-container colorSecond divImgCreate divImgChoose">
            <label>Select portfolio style:</label>
            <div class="input-container img-container img-container-four">
                <div class="col-md-6">
                    <img src="img/portfolios/blackwhite/portfolio-3BW.png" class="img-fluid img-bordered imageCreate" alt="portfolio-1">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/blackwhite/portfolio-4BW.png" class="img-fluid img-bordered imageCreate" alt="portfolio-2">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/blackwhite/portfolio-5BW.png" class="img-fluid img-bordered imageCreate" alt="portfolio-3">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/blackwhite/portfolio-6BW.png" class="img-fluid img-bordered imageCreate" alt="portfolio-4">
                </div>
            </div>
        </div>

        <!-- Portfolio color selection for portfolio 1 -->
        <div class="input-container colorSecond divImgCreate" id="portfolio-1-color-selection" style="display: none;">
            <label>Select portfolio color:</label>
            <div class="input-container img-container img-container-six">
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-1/Color/Color1-1.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-1/Empty/Empty1-1.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-1/Color/Color2-1.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-1/Empty/Empty2-1.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-1/Color/Color3-1.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-1/Empty/Empty3-1.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-1/Color/Color4-1.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-1/Empty/Empty4-1.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-1/Color/Color5-1.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-1/Empty/Empty5-1.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-1/Color/Color6-1.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-1/Empty/Empty6-1.png">
                </div>
            </div>
        </div>

        <!-- Portfolio color selection for portfolio 2 -->
        <div class="input-container colorSecond divImgCreate" id="portfolio-2-color-selection" style="display: none;">
            <label>Select portfolio color:</label>
            <div class="input-container img-container img-container-six">
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-2/Color/Color1-2.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-2/Empty/Empty1-2.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-2/Color/Color2-2.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-2/Empty/Empty2-2.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-2/Color/Color3-2.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-2/Empty/Empty3-2.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-2/Color/Color4-2.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-2/Empty/Empty4-2.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-2/Color/Color5-2.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-2/Empty/Empty5-2.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-2/Color/Color6-2.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-2/Empty/Empty6-2.png">
                </div>
            </div>
        </div>

        <!-- Portfolio color selection for portfolio 3 -->
        <div class="input-container colorSecond divImgCreate" id="portfolio-3-color-selection" style="display: none;">
            <label>Select portfolio color:</label>
            <div class="input-container img-container img-container-six">
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-3/Color/Color1-3.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-3/Empty/Empty1-3.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-3/Color/Color2-3.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-3/Empty/Empty2-3.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-3/Color/Color3-3.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-3/Empty/Empty3-3.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-3/Color/Color4-3.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-3/Empty/Empty4-3.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-3/Color/Color5-3.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-3/Empty/Empty5-3.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-3/Color/Color6-3.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-3/Empty/Empty6-3.png">
                </div>
            </div>
        </div>

        <!-- Portfolio color selection for portfolio 4 -->
        <div class="input-container colorSecond divImgCreate" id="portfolio-4-color-selection" style="display: none;">
            <label>Select portfolio color:</label>
            <div class="input-container img-container img-container-six">
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-4/Color/Color1-4.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-4/Empty/Empty1-4.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-4/Color/Color2-4.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-4/Empty/Empty2-4.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-4/Color/Color3-4.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-4/Empty/Empty3-4.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-4/Color/Color4-4.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-4/Empty/Empty4-4.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-4/Color/Color5-4.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-4/Empty/Empty5-4.png">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-4/Color/Color6-4.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-4/Empty/Empty6-4.png">
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btnCreatePortfolio text-white"><i class="fa-solid fa-pen-to-square text-white mr-2"></i>Create portfolio</button>
        </div>
    </form>
</div>


<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('picture-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }


// -------------------- Portfolio selector Create page --------------------

document.addEventListener('DOMContentLoaded', function () {
    const layoutImages = document.querySelectorAll('.img-container-four .imageCreate');
    const colorSections = {
        'portfolio-1': document.getElementById('portfolio-1-color-selection'),
        'portfolio-2': document.getElementById('portfolio-2-color-selection'),
        'portfolio-3': document.getElementById('portfolio-3-color-selection'),
        'portfolio-4': document.getElementById('portfolio-4-color-selection')
    };

    let selectedLayout = null; // Houd de geselecteerde lay-out bij

    layoutImages.forEach(function (image) {
        image.addEventListener('click', function () {
            // Deselecteer eerst alle lay-outafbeeldingen
            layoutImages.forEach(function (img) {
                img.classList.remove('clicked');
            });

            // Selecteer de geklikte lay-outafbeelding en houd deze bij
            image.classList.add('clicked');
            selectedLayout = image.alt;

            // Verberg alle kleursecties
            Object.values(colorSections).forEach(function (section) {
                section.style.display = 'none';
            });

            // Toon de kleursectie voor de geselecteerde lay-out
            if (colorSections[selectedLayout]) {
                colorSections[selectedLayout].style.display = 'block';
            }
        });
    });

    // Voeg event listeners toe aan de kleurafbeeldingen om te voorkomen dat er meer dan één wordt geselecteerd
    Object.values(colorSections).forEach(function (section) {
        const colorImages = section.querySelectorAll('.img-container img');

        colorImages.forEach(function (colorImage) {
            colorImage.addEventListener('click', function () {
                // Deselecteer eerst alle kleurafbeeldingen in deze sectie
                colorImages.forEach(function (img) {
                    img.classList.remove('clicked');
                });

                // Selecteer de geklikte kleurafbeelding
                colorImage.classList.add('clicked');
            });
        });
    });

    // Voeg event listener toe aan de knop om de selecties te valideren
    const createButton = document.querySelector('.btnCreatePortfolio');
    createButton.addEventListener('click', function () {
        const selectedImages = document.querySelectorAll('.img-container-four .imageCreate.clicked');
        const selectedImageAlt = selectedImages.length > 0 ? selectedImages[0].alt : null;
        const selectedColorImages = document.querySelectorAll('.img-container-six .imageCreate.clicked');
        const selectedColorImageAlt = selectedColorImages.length > 0 ? selectedColorImages[0].alt : null;
    });
});

const createButton = document.querySelector('.btnCreatePortfolio');
createButton.addEventListener('click', function(event) {
    const selectedImages = document.querySelectorAll('.img-container-four .imageCreate.clicked');
    const selectedImageAlt = selectedImages.length > 0 ? selectedImages[0].alt : null;
    const selectedColorImages = document.querySelectorAll('.img-container-six .imageCreate.clicked');
    const selectedColorImageAlt = selectedColorImages.length > 0 ? selectedColorImages[0].alt : null;

    if (!selectedImageAlt || !selectedColorImageAlt) {
        alert('Select both a portfolio layout and a color');
        event.preventDefault();
        return;
    }

    const form = createButton.closest('form');
    const altField = document.createElement('input');
    altField.type = 'hidden';
    altField.name = 'selected_image_alt';
    altField.value = selectedImageAlt;
    form.appendChild(altField);

    const colorAltField = document.createElement('input');
    colorAltField.type = 'hidden';
    colorAltField.name = 'selected_color_image_alt';
    colorAltField.value = selectedColorImageAlt;
    form.appendChild(colorAltField);

    form.submit();
});

// -------------------- Portfolio selector Create page --------------------
</script>
<div class="containerCreate">
    <form id="portfolio-form" action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Title and SubTitle -->
        <div class="input-container colorSecond mt-5 divCreatePage">
            <label for="title">Title:</label>
            <x-text-input name="title" type="text" class="form-control mb-3 backgroundTransparant" maxlength="18" required />
            <label for="subtitle">Sub-Title:</label>
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
                    <x-text-input name="one" type="text" class="form-control backgroundTransparant" maxlength="20" />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="two" type="text" class="form-control backgroundTransparant" maxlength="20" />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="three" type="text" class="form-control backgroundTransparant" maxlength="20" />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="four" type="text" class="form-control backgroundTransparant" maxlength="20" />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="five" type="text" class="form-control backgroundTransparant" maxlength="20" />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="six" type="text" class="form-control backgroundTransparant" maxlength="20" />
                </div>
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
                    <img src="img/portfolios/blackwhite/portfolio-3BW.png" class="img-fluid img-bordered imageCreate" alt="portfolio-1.blade.php">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/blackwhite/portfolio-4BW.png" class="img-fluid img-bordered imageCreate" alt="portfolio-2.blade.php">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/blackwhite/portfolio-5BW.png" class="img-fluid img-bordered imageCreate" alt="portfolio-3.blade.php">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/blackwhite/portfolio-6BW.png" class="img-fluid img-bordered imageCreate" alt="portfolio-4.blade.php">
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

        <input type="hidden" id="selected_image_alt" name="selected_image_alt" />
        <input type="hidden" id="selected_color_image_alt" name="selected_color_image_alt" />

        <!-- Create Portfolio Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary btnCreatePortfolio text-white">
                <i class="fa-solid fa-pen-to-square text-white mr-2"></i>Create portfolio
            </button>
        </div>
        <div class="alert alert-danger mt-3 text-center" id="error-message" style="display: none;"></div>
        <div class="alert alert-success mt-3 text-center" id="success-message" style="display: none;"></div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const layoutImages = document.querySelectorAll('.img-container-four .imageCreate');
    const colorSections = {
        'portfolio-1.blade.php': document.getElementById('portfolio-1-color-selection'),
        'portfolio-2.blade.php': document.getElementById('portfolio-2-color-selection'),
        'portfolio-3.blade.php': document.getElementById('portfolio-3-color-selection'),
        'portfolio-4.blade.php': document.getElementById('portfolio-4-color-selection')
    };

    let selectedLayout = null; // Houd de geselecteerde lay-out bij

    layoutImages.forEach(function (image) {
        image.addEventListener('click', function () {
            layoutImages.forEach(function (img) {
                img.classList.remove('clicked');
            });

            image.classList.add('clicked');
            selectedLayout = image.alt;

            Object.values(colorSections).forEach(function (section) {
                section.style.display = 'none';
            });

            if (colorSections[selectedLayout]) {
                colorSections[selectedLayout].style.display = 'block';
            }
        });
    });

    Object.values(colorSections).forEach(function (section) {
        const colorImages = section.querySelectorAll('.img-container img');

        colorImages.forEach(function (colorImage) {
            colorImage.addEventListener('click', function () {
                colorImages.forEach(function (img) {
                    img.classList.remove('clicked');
                });

                colorImage.classList.add('clicked');
            });
        });
    });

    const createButton = document.querySelector('.btnCreatePortfolio');
    createButton.addEventListener('click', function(event) {
        event.preventDefault(); // Voorkom standaard formulierevenement
        const form = document.getElementById('portfolio-form');
        const title = form.querySelector('input[name="title"]').value;
        const subtitle = form.querySelector('input[name="subtitle"]').value;
        const about = form.querySelector('textarea[name="about"]').value;
        const picture = form.querySelector('input[name="picture"]').files.length;
        const selectedImageAlt = selectedLayout;
        const selectedColorImageAlt = document.querySelector('.img-container-six .imageCreate.clicked')?.alt;

        if (!title || !subtitle || !about || !picture || !selectedImageAlt || !selectedColorImageAlt) {
            const errorMessage = document.getElementById('error-message');
            errorMessage.textContent = 'Please fill out all required fields and select both a layout and a color.';
            errorMessage.style.display = 'block';
        } else {
            document.getElementById('selected_image_alt').value = selectedImageAlt;
            document.getElementById('selected_color_image_alt').value = selectedColorImageAlt;

            // Gebruik fetch API om formuliergegevens naar de server te sturen zonder herladen van de pagina
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const successMessage = document.getElementById('success-message');
                    successMessage.textContent = 'Created!';
                    successMessage.style.display = 'block';

                    // Redirect naar de juiste portfolio pagina
                    window.location.href = '/' + data.layout.replace('.blade.php', '');
                } else {
                    const errorMessage = document.getElementById('error-message');
                    errorMessage.textContent = data.message || 'There was an error creating your portfolio.';
                    errorMessage.style.display = 'block';
                }
            })
            .catch(error => {
                const errorMessage = document.getElementById('error-message');
                errorMessage.textContent = 'There was an error creating your portfolio.';
                errorMessage.style.display = 'block';
                console.error('Error:', error);
            });
        }
    });
});

function previewImage(event) {
    const picturePreview = document.getElementById('picture-preview');
    picturePreview.src = URL.createObjectURL(event.target.files[0]);
    picturePreview.onload = function() {
        URL.revokeObjectURL(picturePreview.src); // release memory
    }
}
</script>
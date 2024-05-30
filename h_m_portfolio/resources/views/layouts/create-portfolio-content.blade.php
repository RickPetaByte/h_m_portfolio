<div class="containerCreate">
    <form action="#">
        <!-- Title and SubTitle -->
        <div class="input-container colorSecond mt-5 divCreatePage">
            <label for="title">Title:</label>
            <x-text-input name="title" type="text" class="form-control mb-3 backgroundTransparant" />
            <label for="subtitle">Sub-Title:</label>
            <x-text-input name="subtitle" type="text" class="form-control backgroundTransparant" />
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
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="two" type="text" class="form-control backgroundTransparant" />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="three" type="text" class="form-control backgroundTransparant" />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="four" type="text" class="form-control backgroundTransparant" />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="five" type="text" class="form-control backgroundTransparant" />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input name="six" type="text" class="form-control backgroundTransparant" />
                </div>
            </div>
        </div>

        <!-- About -->
        <div class="input-container colorSecond divCreatePage">
            <label for="about">About:</label>
            <textarea name="about" class="form-control mt-3 aboutCreatePortfolio mt-1 block w-100 shadow-none" rows="5" style="resize: none;"></textarea>
        </div>

        <!-- Privacy -->
        <div class="input-container colorSecond divCreatePage">
            <label>Private:</label>
            <div class="form-check mt-2">
                <input type="radio" id="yes" name="private" value="yes" class="form-check-input colorCheckBox shadow-none" checked>
                <label for="yes" class="form-check-label ml-3">Yes</label>
            </div>
            <div class="form-check">
                <input type="radio" id="no" name="private" value="no" class="form-check-input colorCheckBox shadow-none">
                <label for="no" class="form-check-label ml-3">No</label>
            </div>
            <p class="mt-3 textInfoPrivacy">If you select 'Yes' other people can't see your portfolio. If you select 'No' other people can see your portfolio.</p>
        </div>

        <!-- Portfolio layout -->
        <div class="input-container colorSecond divCreatePage">
            <label>Select portfolio style:</label>
            <div class="input-container img-container">
                <div class="col-md-6">
                    <img src="img/portfolio-3BW.png" class="img-fluid img-bordered" alt="Image 1">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolio-4BW.png" class="img-fluid img-bordered" alt="Image 2">
                </div>
            </div>
            <div class="input-container img-container">
                <div class="col-md-6">
                    <img src="img/portfolio-5BW.png" class="img-fluid img-bordered" alt="Image 3">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolio-6BW.png" class="img-fluid img-bordered" alt="Image 4">
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

    document.addEventListener('DOMContentLoaded', function () {
        const images = document.querySelectorAll('.img-container img');

        images.forEach(function (image) {
            image.addEventListener('click', function () {
                // Remove 'clicked' class from all images
                images.forEach(function (img) {
                    img.classList.remove('clicked');
                });

                // Add 'clicked' class to the clicked image
                image.classList.add('clicked');
            });
        });

        const createButton = document.querySelector('.btnCreatePortfolio');
        createButton.addEventListener('click', function () {
            const selectedImages = document.querySelectorAll('.img-container img.clicked');
            const selectedImageAlt = [];
            selectedImages.forEach(function (img) {
                selectedImageAlt.push(img.alt);
            });
            alert("Selected images: " + selectedImageAlt.join(", "));
        });
    });
</script>
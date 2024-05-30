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
                    <img src="img/portfolios/portfolio-1/Color/Color1-1.png" class="img-fluid img-bordered imageCreate" alt="Empty1-1">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-1/Color/Color2-1.png" class="img-fluid img-bordered imageCreate" alt="Empty2-1">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-1/Color/Color3-1.png" class="img-fluid img-bordered imageCreate" alt="Empty3-1">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-1/Color/Color4-1.png" class="img-fluid img-bordered imageCreate" alt="Empty4-1">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-1/Color/Color5-1.png" class="img-fluid img-bordered imageCreate" alt="Empty5-1">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-1/Color/Color6-1.png" class="img-fluid img-bordered imageCreate" alt="Empty6-1">
                </div>
            </div>
        </div>

        <!-- Portfolio color selection for portfolio 2 -->
        <div class="input-container colorSecond divImgCreate" id="portfolio-2-color-selection" style="display: none;">
            <label>Select portfolio color:</label>
            <div class="input-container img-container img-container-six">
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-2/Color/Color1-2.png" class="img-fluid img-bordered imageCreate" alt="Empty1-2">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-2/Color/Color2-2.png" class="img-fluid img-bordered imageCreate" alt="Empty2-2">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-2/Color/Color3-2.png" class="img-fluid img-bordered imageCreate" alt="Empty3-2">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-2/Color/Color4-2.png" class="img-fluid img-bordered imageCreate" alt="Empty4-2">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-2/Color/Color5-2.png" class="img-fluid img-bordered imageCreate" alt="Empty5-2">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-2/Color/Color6-2.png" class="img-fluid img-bordered imageCreate" alt="Empty6-2">
                </div>
            </div>
        </div>

        <!-- Portfolio color selection for portfolio 3 -->
        <div class="input-container colorSecond divImgCreate" id="portfolio-3-color-selection" style="display: none;">
            <label>Select portfolio color:</label>
            <div class="input-container img-container img-container-six">
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-3/Color/Color1-3.png" class="img-fluid img-bordered imageCreate" alt="Empty1-3">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-3/Color/Color2-3.png" class="img-fluid img-bordered imageCreate" alt="Empty2-3">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-3/Color/Color3-3.png" class="img-fluid img-bordered imageCreate" alt="Empty3-3">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-3/Color/Color4-3.png" class="img-fluid img-bordered imageCreate" alt="Empty4-3">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-3/Color/Color5-3.png" class="img-fluid img-bordered imageCreate" alt="Empty5-3">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-3/Color/Color6-3.png" class="img-fluid img-bordered imageCreate" alt="Empty6-3">
                </div>
            </div>
        </div>

        <!-- Portfolio color selection for portfolio 4 -->
        <div class="input-container colorSecond divImgCreate" id="portfolio-4-color-selection" style="display: none;">
            <label>Select portfolio color:</label>
            <div class="input-container img-container img-container-six">
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-4/Color/Color1-4.png" class="img-fluid img-bordered imageCreate" alt="Empty1-4">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-4/Color/Color2-4.png" class="img-fluid img-bordered imageCreate" alt="Empty2-4">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-4/Color/Color3-4.png" class="img-fluid img-bordered imageCreate" alt="Empty3-4">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-4/Color/Color4-4.png" class="img-fluid img-bordered imageCreate" alt="Empty4-4">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-4/Color/Color5-4.png" class="img-fluid img-bordered imageCreate" alt="Empty5-4">
                </div>
                <div class="col-md-6">
                    <img src="img/portfolios/portfolio-4/Color/Color6-4.png" class="img-fluid img-bordered imageCreate" alt="Empty6-4">
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
</script>
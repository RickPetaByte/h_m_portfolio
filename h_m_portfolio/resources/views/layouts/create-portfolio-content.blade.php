<div class="containerCreate">
    <form action="{{ route('store-text') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-container colorSecond mt-5 divCreatePageCreate">
            <label for="title">Title:</label>
            <x-text-input type="text" name="title" class="form-control mb-3 backgroundTransparant" id="title" maxlength="18" required />
            <label for="subtitle">Sub Title:</label>
            <x-text-input type="text" name="subtitle" class="form-control backgroundTransparant" id="subtitle" maxlength="18" required />
        </div>

        <div class="input-container colorSecond divCreatePageCreate">
            <label class="custom-file-upload btn btn-primary text-white btnUploadPicture">
                <i class="fa-solid fa-upload mr-2 text-white"></i>Upload picture
                <input id="picture" name="picture" type="file" accept="image/*" onchange="previewImage(event)" />
            </label>
            <img id="picture-preview" src="img/Standaard.png" class="mt-4 img-thumbnail d-block mx-auto" />
        </div>

        <div class="input-container colorSecond divCreatePageCreate">
            <label>Things about yourself:</label>
            <div class="row">
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input id="one" name="one" type="text" class="form-control backgroundTransparant" maxlength="20" required />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input id="two" name="two" type="text" class="form-control backgroundTransparant" maxlength="20" required />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input id="three" name="three" type="text" class="form-control backgroundTransparant" maxlength="20" required />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input id="four" name="four" type="text" class="form-control backgroundTransparant" maxlength="20" />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input id="five" name="five" type="text" class="form-control backgroundTransparant" maxlength="20" />
                </div>
                <div class="col-md-4 mb-4 mt-2">
                    <x-text-input id="six" name="six" type="text" class="form-control backgroundTransparant" maxlength="20" />
                </div>
            </div>
        </div>

        <div class="input-container colorSecond divCreatePageCreate">
            <label for="text">About:</label>
            <textarea maxlength="130" name="text" id="text" rows="4" cols="50" class="form-control mt-3 aboutCreatePortfolio mt-1 block w-100 shadow-none" style="resize: none;" required></textarea>
        </div>

        <div class="input-container colorSecond divCreatePageCreate">
            <label>Private:</label>
            <div class="form-check mt-2">
                <input type="radio" id="yes" name="private" value="1" class="form-check-input colorCheckBox shadow-none" checked>
                <label for="yes" class="form-check-label ml-3">Yes</label>
            </div>
            <div class="form-check">
                <input type="radio" id="no" name="private" value="0" class="form-check-input colorCheckBox shadow-none">
                <label for="no" class="form-check-label ml-3">No</label>
            </div>
            <p class="infoText">If selected "Yes" only you can see your portfolio if "No" is selected everyone can see your portfolio!</p>
        </div>

        <div class="input-container colorSecond divImgCreate divImgChoose">
            <label>Select portfolio style:</label>
            <div class="input-container img-container img-container-four">
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/blackwhite/portfolio-3BW.png" class="img-fluid img-bordered imageCreate" alt="dynamic-template-1">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/blackwhite/portfolio-4BW.png" class="img-fluid img-bordered imageCreate" alt="dynamic-template-2">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/blackwhite/portfolio-5BW.png" class="img-fluid img-bordered imageCreate" alt="dynamic-template-3">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/blackwhite/portfolio-6BW.png" class="img-fluid img-bordered imageCreate" alt="dynamic-template-4">
                </div>
            </div>
        </div>
        
        <input type="hidden" name="selected_image_alt" id="selected_layout" value="">

        <div class="input-container colorSecond divImgCreate" id="portfolio-1-color-selection" style="display: none;">
            <label>Select portfolio color:</label>
            <div class="input-container img-container img-container-six">
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-1/Color/Color1-1.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-1/Empty/Empty1-1.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-1/Color/Color2-1.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-1/Empty/Empty2-1.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-1/Color/Color3-1.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-1/Empty/Empty3-1.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-1/Color/Color4-1.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-1/Empty/Empty4-1.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-1/Color/Color5-1.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-1/Empty/Empty5-1.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-1/Color/Color6-1.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-1/Empty/Empty6-1.png">
                </div>
            </div>
        </div>

        <div class="input-container colorSecond divImgCreate" id="portfolio-2-color-selection" style="display: none;">
            <label>Select portfolio color:</label>
            <div class="input-container img-container img-container-six">
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-2/Color/Color1-2.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-2/Empty/Empty1-2.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-2/Color/Color2-2.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-2/Empty/Empty2-2.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-2/Color/Color3-2.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-2/Empty/Empty3-2.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-2/Color/Color4-2.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-2/Empty/Empty4-2.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-2/Color/Color5-2.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-2/Empty/Empty5-2.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-2/Color/Color6-2.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-2/Empty/Empty6-2.png">
                </div>
            </div>
        </div>

        <div class="input-container colorSecond divImgCreate" id="portfolio-3-color-selection" style="display: none;">
            <label>Select portfolio color:</label>
            <div class="input-container img-container img-container-six">
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-3/Color/Color1-3.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-3/Empty/Empty1-3.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-3/Color/Color2-3.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-3/Empty/Empty2-3.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-3/Color/Color3-3.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-3/Empty/Empty3-3.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-3/Color/Color4-3.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-3/Empty/Empty4-3.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-3/Color/Color5-3.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-3/Empty/Empty5-3.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-3/Color/Color6-3.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-3/Empty/Empty6-3.png">
                </div>
            </div>
        </div>

        <div class="input-container colorSecond divImgCreate" id="portfolio-4-color-selection" style="display: none;">
            <label>Select portfolio color:</label>
            <div class="input-container img-container img-container-six">
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-4/Color/Color1-4.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-4/Empty/Empty1-4.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-4/Color/Color2-4.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-4/Empty/Empty2-4.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-4/Color/Color3-4.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-4/Empty/Empty3-4.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-4/Color/Color4-4.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-4/Empty/Empty4-4.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-4/Color/Color5-4.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-4/Empty/Empty5-4.png">
                </div>
                <div class="col-md-6 marginBottomCreatePortfolioPage">
                    <img src="img/portfolios/portfolio-4/Color/Color6-4.png" class="img-fluid img-bordered imageCreate" alt="img/portfolios/portfolio-4/Empty/Empty6-4.png">
                </div>
            </div>
        </div> 

        <input type="hidden" name="selected_color_image_alt" id="selected_image" value="">

        <div class="text-center mb-5">
            <button type="submit" class="btn btn-primary btnCreatePortfolio text-white">
                <i class="fa-solid fa-pen-to-square text-white mr-2"></i>Create portfolio
            </button>
        </div>
        @php
            $userName = Auth::user()->name;
            $files = glob(public_path("$userName*"));
        @endphp
        
        @if(count($files) === 0)

        @else
            <div class="flex items-center justify-center flex-grow">
                <a href="{{ asset(basename($files[0])) }}" class="btn btn-primary btnCreate colorFirst inline-flex items-center px-4 text-white font-medium">
                    <i class="fa-solid fa-eye text-white iconCreate"></i>Show portfolio
                </a>
            </div>
        @endif
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const updateCharCount = (input) => {
            const maxLength = input.getAttribute("maxlength");
            const charCount = input.value.length;
            const remainingChars = maxLength - charCount;
            const charCountSpan = input.nextElementSibling;
            charCountSpan.textContent = `Remaining characters: ${remainingChars}`;
        };

        const initCharCountDisplay = () => {
            const inputs = document.querySelectorAll('input[maxlength], textarea[maxlength]');
            inputs.forEach(input => {
                const charCountSpan = document.createElement('span');
                charCountSpan.className = 'char-count';
                input.insertAdjacentElement('afterend', charCountSpan);
                updateCharCount(input);

                input.addEventListener('input', () => updateCharCount(input));
            });
        };

        initCharCountDisplay();
    });

    function previewImage(event) {
        const picturePreview = document.getElementById('picture-preview');
        picturePreview.src = URL.createObjectURL(event.target.files[0]);
        picturePreview.onload = function() {
            URL.revokeObjectURL(picturePreview.src); 
        }
    }
</script>

<style>
    .char-count {
        display: block;
        font-size: 0.875em;
        color: #555;
        margin-top: 0.25em;
        text-align: right;
    }

    .infoText
    {
        margin: 8px 0px -5px 0px !important;
        color: #9c9c9c !important;
        font-size: 13px;
    }
</style>
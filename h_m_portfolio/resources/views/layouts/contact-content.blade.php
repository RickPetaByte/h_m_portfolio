<div class="container text-center mt-5">
    <h1 class="display-4 font-weight-bold text-uppercase mb-3">Contact</h1>
</div>

<div class="container">
    <div class="row gx-5 d-flex">
        <div class="col-xxl-1"></div>
        <div class="col-xxl-5">
            <h1 class="text-center fs-bold mt-3 fs-4 fw-semibold">Contact Us</h1>
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="mt-3 colorSecond divCreatePage">
                    <label for="title" :value="__('Name')">Name:</label>
                    <x-text-input id="name" name="name" type="text" class="form-control mb-3 backgroundTransparant" :value="old('name')" />
                    @error('name')
                        <p class="marginErrorsMessages">Name has to be at least 3 characters!</p>
                    @enderror
    
                    <label for="subtitle" :value="__('Email')">Email:</label>
                    <x-text-input id="email" name="email" type="email" class="form-control mb-3 backgroundTransparant" :value="old('email')" />
                    @error('email')
                        <p class="marginErrorsMessages">Enter a valid email!</p>
                    @enderror
    
                    <div class="mt-3"></div>
                    <label for="about" :value="__('About')">Message:</label>
                    <textarea name="message" class="form-control mt-3 aboutCreatePortfolio mb-3 mt-1 block w-100 shadow-none" rows="5" style="resize: none;">{{ old('about') }}</textarea>
                    @error('message')
                        <p class="marginErrorsMessages">Message has to be at least 5 characters!</p>
                    @enderror
                </div>
    
                <div class="text-center mt-3 mb-sm-6 mb-4">
                    <button type="submit" class="btn btn-primary btnCreatePortfolio text-white"><i class="fa-solid fa-pen-to-square text-white mr-2"></i>Send</button>
                </div>
            </form>
        </div> <!-- This closes the .col-6 div -->
        <div class="col-xxl-5">
            <h1 class="text-center fs-bold mt-3 fs-4 fw-semibold">Contact Details</h1>
            <div class="input-container colorSecond mt-3 divCreatePage">
                <div class="d-flex justify-content-center">
                    <hr class="mb-2 text-center w-50 border-2 opacity-100">
                </div>
                <div class="mb-2">
                    <div class="d-flex flex-row-reverse align-items-center justify-content-center mb-2">
                        <div class="ms-3">
                            <span class="mb-2"><span class="fs-6 fw-bold">Rick: </span>80925@roc-teraa.nl</span>
                            <br>
                            <span class="mb-2"><span class="fs-6 fw-bold">Jur: </span>89153@roc-teraa.nl</span>
                        </div>
                        <div class="">
                            <i class="fa fa-envelope fa-border border-black rounded-circle p-2 iconFooter text-black-50 p-1" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                {{-- <div class="d-flex justify-content-center">
                    <hr class="mb-2 text-center w-50 border-2 opacity-100">
                </div> --}}
                <div class="mb-2">
                    <div class="d-flex flex-row-reverse align-items-center justify-content-center mb-2">
                        <div class="ms-3">
                            <span class="mb-2"><span class="fs-6 fw-bold">Rick: </span>06 7389397</span>
                            <br>
                            <span class="mb-2"><span class="fs-6 fw-bold">Jur: </span>06 91838380</span>
                        </div>
                        <div class="">
                            <i class="fa-solid fa-border border-black rounded-circle p-2 fa-phone"></i>
                        </div>
                    </div>
                </div>
                {{-- <div class="d-flex justify-content-center">
                    <hr class="mb-2 text-center w-50 border-2 opacity-100">
                </div> --}}
                <div class="text-center mb-2">
                    <span class="fs-5 fw-bold">Helmond</span>
                    <br>
                    <span class="fs-6">Keizerin Marialaan 2</span>
                    <br>
                </div>
                <div class="d-flex justify-content-center">
                    <hr class="mb-2 text-center w-50 border-2 opacity-100">
                </div>
                <br>
                <div class="container mt-4">
                    <div class="responsive-iframe">
                        <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=keizerin%20marialaan%202+(H:M%20Portfolio's)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                            <a href="https://www.gps.ie/">gps trackers</a></iframe>
                    </div>
                </div>
                {{-- <div style="width: 100%"></div> --}}
                <br>
                {{-- <div class="text-center">
                    <i class="fa-brands fa-border border-dark rounded-circle fa-linkedin-in border-rounded p-2"></i>
                </div> --}}
            </div>
        </div>
        <div class="col-xxl-1"></div>
    </div>
</div>
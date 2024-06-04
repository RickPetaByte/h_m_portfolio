<div class="container text-center mt-5">
    <h1 class="display-4 font-weight-bold text-uppercase">Contact</h1>
</div>

<div class="container"> <!--- containerCreate ---> 
    @if (session()->has('success'))
        <div class="alert alert-success text-center mt-3 alertSuccess" role="alert">
            <h4 class="fw-bold">Succes!</h4><p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="row d-flex">
        <div class="col-6">
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="input-container colorSecond mt-5 divCreatePage">
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
                </div> <!-- This closes the .input-container div -->
    
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btnCreatePortfolio text-white"><i class="fa-solid fa-pen-to-square text-white mr-2"></i>Send</button>
                </div>
            </form>
        </div> <!-- This closes the .col-6 div -->
    
        <div class="col-6">
            <div class="input-container colorSecond mt-5 divCreatePage">
                <h1 class="text-center">Test</h1>
            </div>
        </div>
    </div>    
    
</div>
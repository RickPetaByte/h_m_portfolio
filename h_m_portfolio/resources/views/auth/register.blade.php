<x-guest-layout>
    <img src="img/moon.png" class="mr-5 icon">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="card-body">
            <div>
                <a href="/">
                    <img src="{{ asset('img/LogoCircle.png') }}" alt="Logo" class="w-20 h-20 mx-auto imageLoginRegistration">
                </a>
            </div>
            <form action="">
                <!-- Name -->
                <input id="name" class="form-control my-4 py-2 rounded backgroundTransparant"
                        type="text"
                        name="name" :value="old('name')"
                        required autofocus autocomplete="name" placeholder="Enter name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                <!-- Email Address -->
                <input id="email" class="form-control my-4 py-2 rounded backgroundTransparant"
                        type="email"
                        name="email" :value="old('email')"
                        required autocomplete="username" placeholder="Enter email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <!-- Password -->
                <input id="password" class="form-control my-4 py-2 rounded backgroundTransparant"
                        type="password"
                        name="password"
                        required autocomplete="new-password" placeholder="Enter password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                <!-- Confirm Password -->
                <input id="password_confirmation" class="form-control my-4 py-2 rounded backgroundTransparant"
                        type="password"
                        name="password_confirmation"
                        required autocomplete="new-password" placeholder="Confirm password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                <!-- Gender -->
                <select id="gender" class="form-control my-4 py-2 rounded genderDropdown backgroundTransparant"
                        name="gender" required autocomplete="gender">
                    <option value="" disabled selected>Select...</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />

                <div class="text-center mt-3">
                    <button class="btn btn-primary text-white mb-3 mt-1 loginRegistrationButton">Register <i class="pl-1 text-white fa-solid fa-right-to-bracket"></i></button>
                    <a href="{{ route('login') }}" class="nav-link">Already registered?</a>
                </div>
            </form>
        </div>
    </form>
</x-guest-layout>
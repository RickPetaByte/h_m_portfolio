<section class="colorBgProfile p-4">
    <div class="container">
        <header class="mb-4">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-4">
            @csrf
            @method('patch')

            <div class="row">
                <div class="col-lg-8">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-100" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="col-md-6">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-100" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-sm text-gray-800 dark:text-gray-200">
                                        {{ __('Your email address is unverified.') }}
                                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <x-input-label for="age" :value="__('Age')" />
                            <x-text-input id="age" name="age" type="number" class="mt-1 block w-100" :value="old('age', $user->age)" />
                            <x-input-error class="mt-2" :messages="$errors->get('age')" />
                        </div>
                        <div class="col-md-6">
                            <x-input-label for="phone" :value="__('Phone')" />
                            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-100" :value="old('phone', $user->phone)" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <x-input-label for="about" :value="__('About Yourself')" />
                        <textarea id="about" name="about" class="mt-1 block w-100" rows="5" style="resize: none;">{{ old('about', $user->about) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('about')" />
                    </div>
                </div>

                <div class="col-lg-4 d-flex flex-column align-items-center">
                    <div class="form-group mb-3">
                        <x-input-label for="picture" :value="__('Profile Picture')" />
                        <input id="picture" name="picture" type="file" class="mt-1 block w-100 pictureInput" accept="image/*" onchange="previewImage(event)" />
                        <x-input-error class="mt-2" :messages="$errors->get('picture')" />
                    </div>
                    <img id="picture-preview" src="{{ $user->picture ? asset('storage/img/profile-pictures/' . $user->picture) : asset('img/Standaard.png') }}" class="mt-2 pictureImg img-thumbnail" style="max-height: 200px;" />
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <button class="btn btn-primary text-white">{{ __('SAVE') }}</button>
                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>
    </div>
</section>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('picture-preview');
            output.src = reader.result;
            output.style.maxHeight = '200px'; // Max height
            output.style.maxWidth = '200px'; // Max width
            output.style.minHeight = '200px'; // Min height
            output.style.minWidth = '200px'; // Min width
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
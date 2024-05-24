<footer class="colorSecond borderNav" id="footer">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('img/LogoCircle.png') }}" alt="Logo" class="block h-12 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('about')" :active="request()->routeIs('dashboard')">
                        <p class="colorFirst">{{ __('About') }}</p>
                    </x-nav-link>
                </div>
            </div>
        </div>
    </div>
</footer>
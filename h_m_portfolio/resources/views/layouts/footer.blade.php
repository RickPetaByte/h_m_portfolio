<div class="footerTopDiv"></div>
<footer class="colorSecond borderNav" id="footer">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img id="footer-logo" src="{{ asset('img/LogoCircle.png') }}" alt="Logo" class="block h-12 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('about')" :active="request()->routeIs('dashboard')" class="border-none">
                        <p class="colorFirst buttons aboutButton">{{ __('About') }}</p>
                    </x-nav-link>
                </div>
            </div>

            <div class="flex items-center ml-6 colorSecond border border-0">
                <div class="ml-1">
                    <p class="colorFirst fw-bold">
                        Rick: 
                        <a href="https://www.linkedin.com/in/rick-profile" target="_blank">
                            <i class="iconRick textColorFooter fa-brands fa-linkedin"></i>
                        </a>
                    </p>
                    <p class="colorFirst fw-bold">
                        Jur: 
                        <a href="https://www.linkedin.com/in/jur-profile" target="_blank">
                            <i class="ml-4 textColorFooter fa-brands fa-linkedin"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
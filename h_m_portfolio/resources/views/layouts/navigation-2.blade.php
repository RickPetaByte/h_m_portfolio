<nav x-data="{ open: false }" class="colorSecond borderNav">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img id="logo" src="{{ asset('img/LogoCircle.png') }}" alt="Logo" class="block h-12 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex btnHomepageNav">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="border-none">
                        <p class="colorFirst buttons"><i class="fa-solid fa-house iconNavBar iconNavBarColor"></i>{{ __('Homepage') }}</p>
                    </x-nav-link>
                </div>
            </div>

            <form action="{{ route('delete-portfolio') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete the portfolio?');">
                @csrf
                <input type="hidden" name="file_name" value="{{ $fileName }}">
                <button type="submit" class="btn btn-danger text-white fw-bold" id="deleteButton">
                    <i class="fa fa-trash text-white mr-2"></i>Delete Portfolio
                </button>
            </form>

            <div class="flex items-center">
                <img src="img/moon.png" class="mr-5 icon iconThemeNavBar">

                <!-- Hamburger -->
                <!-- <img src="img/moon.png" class="mr-5 icon"> -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <!-- <img src="img/moon.png" class="mr-5 icon"> -->
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>
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

            <!-- Middle Create Portfolio Button -->
            @if (Auth::check()) <!-- Controleren of gebruiker is ingelogd -->
                @php
                    $userName = Auth::user()->name;
                    $files = glob(public_path("$userName*"));
                @endphp
                
                @if(count($files) === 0)
                    <div class="flex items-center justify-center flex-grow">
                        <a href="{{ route('create-portfolio') }}" class="btn btn-primary btnCreate colorFirst inline-flex items-center px-4 text-white font-medium">
                            <i class="fa-solid fa-pen-to-square text-white iconCreate"></i>Create
                        </a>
                    </div>
                @else
                    <div class="flex items-center justify-center flex-grow">
                        <a href="{{ asset(basename($files[0])) }}" class="btn btn-primary btnCreate colorFirst inline-flex items-center px-4 text-white font-medium">
                            <i class="fa-solid fa-eye text-white iconCreate"></i>Show
                        </a>
                    </div>
                @endif
            @else
                <div class="flex items-center justify-center flex-grow">
                    <a href="{{ route('create-portfolio') }}" class="btn btn-primary btnCreate colorFirst inline-flex items-center px-4 text-white font-medium">
                        <i class="fa-solid fa-pen-to-square text-white iconCreate"></i>Create
                    </a>
                </div>
            @endif

            <div class="flex items-center">
                <img src="img/moon.png" class="mr-5 icon iconThemeNavBar">
                <!-- Check if user is authenticated -->
                @if (Auth::check())
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6 colorSecond border border-0">
                        <!-- <img src="img/moon.png" class="mr-5 icon"> -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="buttons inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div class="flex items-center">
                                        <img src="{{ Auth::user()->picture ? asset('storage/img/profile-pictures/' . Auth::user()->picture) : asset('img/Standaard.png') }}" class="nav-profile-img mr-3" />
                                        <p class="colorFirst">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div class="ml-1">
                                        <p class="colorFirst">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </p>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="colorSecondBorder borderNavDropdown">
                                    <div class="colorSecond colorSecondHover">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            <p class="colorFirst"><i class="fa-solid fa-user iconNavBar iconNavBarColor"></i>{{ __('Profile') }}</p>
                                        </x-dropdown-link>
                                    </div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" class="colorSecond colorSecondHover">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            <p class="colorFirst"><i class="fa-solid fa-right-from-bracket iconNavBar iconNavBarColor"></i>{{ __('Log Out') }}</p>
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <!-- Links for guests -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6 colorSecond">
                        <a href="{{ route('login') }}" class="buttonsHome ml-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 focus:outline-none transition ease-in-out duration-150 colorFirst">Login</a>
                        <a href="{{ route('register') }}" class="buttonsHome ml-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 focus:outline-none transition ease-in-out duration-150 colorFirst">Register</a>
                    </div>
                @endif

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

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="colorSecondHover homepageResponsiveColor">
                <i class="fa-solid fa-house iconNavBar iconNavBarColor"></i>{{ __('Homepage') }}
            </x-responsive-nav-link>
        </div>
        @if (Auth::check())
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="colorSecondHover">
                        <div><i class="fa-solid fa-user iconNavBar iconNavBarColor"></i>{{ __('Profile') }}</div>
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                    this.closest('form').submit();" 
                                class="colorSecondHover">
                            <i class="fa-solid fa-right-from-bracket iconNavBar iconNavBarColor"></i>{{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <!-- Responsive links for guests -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="mt-3 space-y-1 colorSecondHover">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }} 
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }} 
                    </x-responsive-nav-link>
                </div>
            </div>
        @endif
    </div>
</nav>
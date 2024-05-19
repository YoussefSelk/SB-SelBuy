<nav x-data="{ open: false }" class="bg-transparent text-gray-700 relative z-50">
    <div class="container mx-auto flex items-center justify-between py-4">
        <h1 class="text-lg md:text-2xl font-bold transition-all duration-300 ml-3 md:ml-0">
            <a href="{{ route('home') }}" class="text-gray-700">
                <x-application-logo class="block h-9 w-auto mr-2" />
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white"></span>
            </a>
        </h1>

        <!-- Hamburger -->
        <div class="md:hidden mr-3">
            <button id="mobile-menu-button" class="focus:outline-none transition-all duration-300">
                <i class="fas fa-bars text-xl text-gray-700"></i>
            </button>
        </div>

        <div class="hidden md:flex items-center justify-center flex-1 space-x-4">
            <ul class="flex space-x-4">
                <li><a href="{{ route('home') }}" class="hover:text-gray-300 text-gray-700">Home</a></li>
                <li><a href="#" class="hover:text-gray-300 text-gray-700">Contact</a></li>
                <li><a href="{{ route('about.us') }}" class="hover:text-gray-300 text-gray-700">About Us</a></li>
                <li><a href="#" class="hover:text-gray-300 text-gray-700">FAQ</a></li>
                <li>
                    <a href="{{ route('privacy.policy') }}" class="hover:text-gray-300 text-gray-700">Privacy Policy</a>
                </li>
                <li>
                    <a href="{{ route('terms.and.conditions') }}" class="hover:text-gray-300 text-gray-700">
                        Terms & Conditions
                    </a>
                </li>
            </ul>
        </div>
        @if (Auth::check() && Auth::user()->hasRole('Seller') && Auth::user()->hasRole('Buyer'))
            <div class="hidden md:flex items-center mr-4">
                <a href="{{ route('chat.conversations') }} " class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-comment text-3xl"></i>
                </a>
            </div>
        @endif

        <div class="hidden md:flex">
            @if (Auth::check() && Auth::user()->hasRole('Seller'))
                <div class="mr-4">
                    <a href="{{ route('user.create.announcement.view') }}"
                        class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Post New Announcement
                    </a>
                </div>
            @elseif (Auth::check())
                <div class="mr-4">
                    <a href="{{ route('user.become.seller.view', Auth::user()->id) }}"
                        class="flex items-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-user-plus mr-2"></i>
                        Become Seller
                    </a>
                </div>
            @else
                <div class="mr-4">
                    <a href="{{ route('login') }}"
                        class="flex items-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-user-plus mr-2"></i>
                        Become Seller
                    </a>
                </div>
            @endif
        </div>


        <!-- Dropdown for authenticated users -->
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open"
                class="px-2 md:px-4 py-1 md:py-2 border text-black rounded-2xl text-sm md:text-base hover:bg-gray-200 transition-all duration-300">
                <div class="flex flex-row justify-center items-center">
                    <span class="mr-2">
                        @if (Auth::check())
                            <div class="flex flex-row  items-center">
                                <span class="mr-2">
                                    @php
                                        $user = Auth::user()->avatar;
                                    @endphp
                                    @if ($user)
                                        <img src="{{ asset('storage/profile_pictures/' . $user) }}"
                                            alt="Profile Picture" class="w-8 h-8 rounded-full" alt="user photo">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                                            alt="user photo" class="w-8 h-8 rounded-full">
                                    @endif
                                </span>
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                        @else
                            <span>Login</span>
                        @endif
                    </span>
                    <span>
                        <i class="fa fa-solid fa-caret-down"></i>
                    </span>
                </div>

            </button>

            <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                <div class="py-1">
                    @auth
                        @if (Auth::check() && Auth::user()->hasRole('Admin'))
                            <x-dropdown-link :href="route('dashboard')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>
                        @endif
                        @if (Auth::check() && Auth::user()->hasRole('Seller'))
                            <x-dropdown-link :href="route('user.my.announcements.view', Auth::user()->id)">
                                {{ __('My Announcements') }}
                            </x-dropdown-link>
                        @endif
                        <x-dropdown-link :href="route('favorites')">
                            {{ __('Favorites') }}
                        </x-dropdown-link>
                        <!-- If the user is authenticated -->
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    @else
                        <x-dropdown-link :href="route('login')">
                            {{ __('Login') }}
                        </x-dropdown-link>
                        <!-- If the user is not authenticated -->
                        <x-dropdown-link :href="route('register')">
                            {{ __('Register') }}
                        </x-dropdown-link>

                    @endauth
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-gray-300 rounded-sm text-white z-50">
        <ul class="py-4 px-2 space-y-2">
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Home</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Contact</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">About Us</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">FAQ</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Privacy Policy</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Terms & Conditions</a></li>
            @auth
                <!-- If the user is authenticated -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <li>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-700"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Logout
                        </a>
                    </li>
                </form>
            @else
            @endauth
        </ul>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $('#mobile-menu-button').click(function() {
            $('#mobile-menu').slideToggle(300);
        });

        $('#mobile-menu').on('click', 'a', function() {
            $('#mobile-menu').slideToggle(300);
        });
    });

    // Hide mobile menu when screen size changes
    $(window).resize(function() {
        var windowWidth = $(window).width();
        if (windowWidth > 768) {
            $('#mobile-menu').hide();
        }
    });
</script>

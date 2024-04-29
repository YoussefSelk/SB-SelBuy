<nav x-data="{ open: false }" class="bg-transparent text-gray-700 relative z-50">
    <div class="container mx-auto flex items-center justify-between py-4">
        <h1 class="text-lg md:text-2xl font-bold transition-all duration-300 ml-3 md:ml-0">
            <a href="#" class="text-gray-700">My eCommerce Website</a>
        </h1>

        <!-- Hamburger -->
        <div class="md:hidden mr-3">
            <button id="mobile-menu-button" class="focus:outline-none transition-all duration-300">
                <i class="fas fa-bars text-xl text-gray-700"></i>
            </button>
        </div>

        <div class="hidden md:flex items-center justify-center flex-1 space-x-4">
            <ul class="flex space-x-4">
                <li><a href="#" class="hover:text-gray-300 text-gray-700">Home</a></li>
                <li><a href="#" class="hover:text-gray-300 text-gray-700">Shop</a></li>
                <li><a href="#" class="hover:text-gray-300 text-gray-700">Cart</a></li>
                <li><a href="#" class="hover:text-gray-300 text-gray-700">Contact</a></li>
            </ul>
        </div>

        <!-- Dropdown for authenticated users -->
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open"
                class="px-2 md:px-4 py-1 md:py-2 bg-gray-700 text-white rounded-md hover:bg-gray-800 text-sm md:text-base transition-all duration-300">
                {{ Auth::check() ? Auth::user()->name : 'Login' }}
            </button>

            <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                <div class="py-1">
                    @auth
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
                        <!-- If the user is not authenticated -->
                        <x-dropdown-link :href="route('register')">
                            {{ __('Register') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('login')">
                            {{ __('Login') }}
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
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Shop</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Cart</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Contact</a></li>
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
                <!-- If the user is not authenticated -->
                <li><a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-gray-700">Sign Up</a></li>
                <li><a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-700">Sign In</a></li>
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

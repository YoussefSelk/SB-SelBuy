<x-guest-layout>
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg overflow-hidden">
        <div class="p-6 space-y-4">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Log in</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fas fa-envelope mr-2 text-blue-500 "></i>
                        Email
                    </label>
                    <input id="email" type="email" name="email" :value="old('email')" required
                        autocomplete="username" placeholder="Your email"
                        class="mt-2 block w-full px-4 py-2 rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mt-4 text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fas fa-lock mr-2 text-blue-500"></i>
                        Password
                    </label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        placeholder="Your password"
                        class="mt-2 block w-full px-4 py-2 rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-6">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-blue-500 shadow-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-blue-500 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-200">Forgot
                            your password?</a>
                    @endif

                    <x-primary-button class="ml-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

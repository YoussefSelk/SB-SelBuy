<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 bottom-0 left-0 z-50 w-full h-full">
    <div class="relative  p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class=" bg-white rounded-lg shadow dark:bg-gray-700 w-full md:w-96 h-auto">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Create New User
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{ route('admin.add.user') }}" class="space-y-4 p-4 md:p-6">
                @csrf
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fas fa-user mr-2 text-blue-500"></i>
                        Name
                    </label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus
                        autocomplete="name" placeholder="Your name"
                        class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i>
                        Email
                    </label>
                    <input id="email" type="email" name="email" :value="old('email')" required
                        autocomplete="username" placeholder="Your email"
                        class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fas fa-lock mr-2 text-blue-500"></i>
                        Password
                    </label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        placeholder="Your password"
                        class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fas fa-lock mr-2 text-blue-500"></i>
                        Confirm Password
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password" placeholder="Confirm your password"
                        class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Morocco Cities -->
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                        Ville
                    </label>
                    <select id="city" name="city"
                        class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="" selected disabled>Choisissez une ville</option>
                        <option value="Agadir">Agadir</option>
                        <option value="Al Hoceima">Al Hoceima</option>
                        <option value="Assilah">Assilah</option>
                        <!-- Other cities options here -->
                    </select>
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fas fa-phone-alt mr-2 text-blue-500"></i>
                        Numéro de téléphone
                    </label>
                    <input id="phone" type="tel" name="phone" required autocomplete="tel"
                        placeholder="Your phone number"
                        class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                        Role
                    </label>
                    <select id="role" name="role"
                        class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="" selected disabled>Choisissez un Role</option>
                        @foreach ($roles as $role)
                            @if (Auth::user()->hasRole('Admin') && !Auth::user()->hasRole('SuperAdmin'))
                                @if ($role->name == 'Admin' || $role->name == 'SuperAdmin')
                                    @continue
                                @else
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endif
                            @elseif (Auth::user()->hasRole('SuperAdmin') && Auth::user()->hasRole('SuperAdmin'))
                                @if ($role->name == 'SuperAdmin')
                                    @continue
                                @else
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>
                <div class="flex flex-col items-center md:flex-row md:items-center justify-between">
                    <button type="submit"
                        class="mt-4 md:mt-0 md:ml-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-offset-gray-800">
                        Register
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

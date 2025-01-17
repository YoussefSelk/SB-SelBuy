<x-guest-layout>
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Register</h2>
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
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
                        <option value="Azrou">Azrou</option>
                        <option value="Beni Mellal">Beni Mellal</option>
                        <option value="Boujdour">Boujdour</option>
                        <option value="Bouznika">Bouznika</option>
                        <option value="Casablanca">Casablanca</option>
                        <option value="Chefchaouen">Chefchaouen</option>
                        <option value="Dakhla">Dakhla</option>
                        <option value="El Jadida">El Jadida</option>
                        <option value="Essaouira">Essaouira</option>
                        <option value="Fès">Fès</option>
                        <option value="Fnideq">Fnideq</option>
                        <option value="Guelmim">Guelmim</option>
                        <option value="Ifrane">Ifrane</option>
                        <option value="Kénitra">Kénitra</option>
                        <option value="Khemisset">Khemisset</option>
                        <option value="Khouribga">Khouribga</option>
                        <option value="Ksar El Kebir">Ksar El Kebir</option>
                        <option value="Laâyoune">Laâyoune</option>
                        <option value="Larache">Larache</option>
                        <option value="Marrakech">Marrakech</option>
                        <option value="Meknès">Meknès</option>
                        <option value="Midelt">Midelt</option>
                        <option value="Mohammédia">Mohammédia</option>
                        <option value="Nador">Nador</option>
                        <option value="Ouarzazate">Ouarzazate</option>
                        <option value="Oued Zem">Oued Zem</option>
                        <option value="Oujda">Oujda</option>
                        <option value="Rabat">Rabat</option>
                        <option value="Safi">Safi</option>
                        <option value="Salé">Salé</option>
                        <option value="Sefrou">Sefrou</option>
                        <option value="Settat">Settat</option>
                        <option value="Sidi Bennour">Sidi Bennour</option>
                        <option value="Sidi Ifni">Sidi Ifni</option>
                        <option value="Sidi Kacem">Sidi Kacem</option>
                        <option value="Sidi Slimane">Sidi Slimane</option>
                        <option value="Sidi Yahya El Gharb">Sidi Yahya El Gharb</option>
                        <option value="Skhirat">Skhirat</option>
                        <option value="Tanger">Tanger</option>
                        <option value="Tarfaya">Tarfaya</option>
                        <option value="Taroudant">Taroudant</option>
                        <option value="Taza">Taza</option>
                        <option value="Témara">Témara</option>
                        <option value="Tétouan">Tétouan</option>
                        <option value="Tiznit">Tiznit</option>
                        <option value="Youssoufia">Youssoufia</option>
                        <option value="Zagora">Zagora</option>
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

                <div class="flex items-center justify-end">
                    <a href="{{ route('login') }}"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">Already
                        registered?</a>
                    <button type="submit"
                        class="ml-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-offset-gray-800">
                        Register
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-guest-layout>

<section>
    <header>
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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
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
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)"
                required autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
        <div>
            <x-input-label for="ville" :value="__('City')" />
            <select id="ville" name="ville"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required autofocus>
                <option disabled selected>Select City</option>
                <option value="Agadir" @if (old('ville', $user->ville) == 'Agadir') selected @endif>Agadir</option>
                <option value="Al Hoceima" @if (old('ville', $user->ville) == 'Al Hoceima') selected @endif>Al Hoceima</option>
                <option value="Azemmour" @if (old('ville', $user->ville) == 'Azemmour') selected @endif>Azemmour</option>
                <option value="Beni Mellal" @if (old('ville', $user->ville) == 'Beni Mellal') selected @endif>Beni Mellal</option>
                <option value="Benslimane" @if (old('ville', $user->ville) == 'Benslimane') selected @endif>Benslimane</option>
                <option value="Bouznika" @if (old('ville', $user->ville) == 'Bouznika') selected @endif>Bouznika</option>
                <option value="Casablanca" @if (old('ville', $user->ville) == 'Casablanca') selected @endif>Casablanca</option>
                <option value="Chefchaouen" @if (old('ville', $user->ville) == 'Chefchaouen') selected @endif>Chefchaouen</option>
                <option value="Dakhla" @if (old('ville', $user->ville) == 'Dakhla') selected @endif>Dakhla</option>
                <option value="El Jadida" @if (old('ville', $user->ville) == 'El Jadida') selected @endif>El Jadida</option>
                <option value="Erfoud" @if (old('ville', $user->ville) == 'Erfoud') selected @endif>Erfoud</option>
                <option value="Essaouira" @if (old('ville', $user->ville) == 'Essaouira') selected @endif>Essaouira</option>
                <option value="Fes" @if (old('ville', $user->ville) == 'Fes') selected @endif>Fes</option>
                <option value="Fnideq" @if (old('ville', $user->ville) == 'Fnideq') selected @endif>Fnideq</option>
                <option value="Guelmim" @if (old('ville', $user->ville) == 'Guelmim') selected @endif>Guelmim</option>
                <option value="Ifrane" @if (old('ville', $user->ville) == 'Ifrane') selected @endif>Ifrane</option>
                <option value="Kenitra" @if (old('ville', $user->ville) == 'Kenitra') selected @endif>Kenitra</option>
                <option value="Khemisset" @if (old('ville', $user->ville) == 'Khemisset') selected @endif>Khemisset</option>
                <option value="Khenifra" @if (old('ville', $user->ville) == 'Khenifra') selected @endif>Khenifra</option>
                <option value="Khouribga" @if (old('ville', $user->ville) == 'Khouribga') selected @endif>Khouribga</option>
                <option value="Ksar El Kebir" @if (old('ville', $user->ville) == 'Ksar El Kebir') selected @endif>Ksar El Kebir</option>
                <option value="Laayoune" @if (old('ville', $user->ville) == 'Laayoune') selected @endif>Laayoune</option>
                <option value="Larache" @if (old('ville', $user->ville) == 'Larache') selected @endif>Larache</option>
                <option value="Marrakech" @if (old('ville', $user->ville) == 'Marrakech') selected @endif>Marrakech</option>
                <option value="Martil" @if (old('ville', $user->ville) == 'Martil') selected @endif>Martil</option>
                <option value="Meknes" @if (old('ville', $user->ville) == 'Meknes') selected @endif>Meknes</option>
                <option value="Mohammedia" @if (old('ville', $user->ville) == 'Mohammedia') selected @endif>Mohammedia</option>
                <option value="Nador" @if (old('ville', $user->ville) == 'Nador') selected @endif>Nador</option>
                <option value="Oualidia" @if (old('ville', $user->ville) == 'Oualidia') selected @endif>Oualidia</option>
                <option value="Ouarzazate" @if (old('ville', $user->ville) == 'Ouarzazate') selected @endif>Ouarzazate</option>
                <option value="Oujda" @if (old('ville', $user->ville) == 'Oujda') selected @endif>Oujda</option>
                <option value="Rabat" @if (old('ville', $user->ville) == 'Rabat') selected @endif>Rabat</option>
                <option value="Safi" @if (old('ville', $user->ville) == 'Safi') selected @endif>Safi</option>
                <option value="Sale" @if (old('ville', $user->ville) == 'Sale') selected @endif>Sale</option>
                <option value="Tangier" @if (old('ville', $user->ville) == 'Tangier') selected @endif>Tangier</option>
                <option value="Tan-Tan" @if (old('ville', $user->ville) == 'Tan-Tan') selected @endif>Tan-Tan</option>
                <option value="Taroudant" @if (old('ville', $user->ville) == 'Taroudant') selected @endif>Taroudant</option>
                <option value="Taza" @if (old('ville', $user->ville) == 'Taza') selected @endif>Taza</option>
                <option value="Temara" @if (old('ville', $user->ville) == 'Temara') selected @endif>Temara</option>
                <option value="Tetouan" @if (old('ville', $user->ville) == 'Tetouan') selected @endif>Tetouan</option>
                <option value="Tiznit" @if (old('ville', $user->ville) == 'Tiznit') selected @endif>Tiznit</option>
                <option value="Zagora" @if (old('ville', $user->ville) == 'Zagora') selected @endif>Zagora</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('ville')" />
        </div>



        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

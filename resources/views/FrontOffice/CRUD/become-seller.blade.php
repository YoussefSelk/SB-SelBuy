@extends('layouts.public')

@section('title', 'Home')

@section('content')


    <!-- component -->
    <div class="mt-16 p-6 bg-gray-100 flex items-center justify-center">
        <div class="container max-w-screen-lg mx-auto">
            <div>
                <h2 class="font-semibold text-xl text-gray-600">Become a Seller</h2>
                <p class="text-gray-500 mb-6">Check If This Informations are Correct</p>

                <form action="{{ route('user.become.seller.submit', $user->id) }}" method="POST">
                    @csrf
                    <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                            <div class="text-gray-600">
                                <p class="font-medium text-lg">Personal Details</p>
                                <p>Please verify and fill out all the fields.</p>
                            </div>

                            <div class="lg:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                    <div class="md:col-span-5">
                                        <label for="name">Full Name</label>
                                        <input type="text" name="name" id="name"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                            value="{{ old('name', $user->name) }}" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                    </div>

                                    <div class="md:col-span-5">
                                        <label for="email">Email Address</label>
                                        <input type="text" name="email" id="email"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                            value="{{ old('email', $user->email) }}" placeholder="email@domain.com" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                    </div>

                                    <div class="md:col-span-5">
                                        <label for="ville">City</label>
                                        <select name="ville" id="ville"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                                            <option disabled selected>Select City</option>
                                            <option value="Agadir"
                                                {{ old('ville', $user->ville) == 'Agadir' ? 'selected' : '' }}>Agadir
                                            </option>
                                            <option value="Al Hoceima"
                                                {{ old('ville', $user->ville) == 'Al Hoceima' ? 'selected' : '' }}>Al
                                                Hoceima</option>
                                            <option value="Azemmour"
                                                {{ old('ville', $user->ville) == 'Azemmour' ? 'selected' : '' }}>Azemmour
                                            </option>
                                            <option value="Beni Mellal"
                                                {{ old('ville', $user->ville) == 'Beni Mellal' ? 'selected' : '' }}>Beni
                                                Mellal</option>
                                            <option value="Benslimane"
                                                {{ old('ville', $user->ville) == 'Benslimane' ? 'selected' : '' }}>
                                                Benslimane</option>
                                            <option value="Bouznika"
                                                {{ old('ville', $user->ville) == 'Bouznika' ? 'selected' : '' }}>Bouznika
                                            </option>
                                            <option value="Casablanca"
                                                {{ old('ville', $user->ville) == 'Casablanca' ? 'selected' : '' }}>
                                                Casablanca</option>
                                            <option value="Chefchaouen"
                                                {{ old('ville', $user->ville) == 'Chefchaouen' ? 'selected' : '' }}>
                                                Chefchaouen</option>
                                            <option value="Dakhla"
                                                {{ old('ville', $user->ville) == 'Dakhla' ? 'selected' : '' }}>Dakhla
                                            </option>
                                            <option value="El Jadida"
                                                {{ old('ville', $user->ville) == 'El Jadida' ? 'selected' : '' }}>El Jadida
                                            </option>
                                            <option value="Erfoud"
                                                {{ old('ville', $user->ville) == 'Erfoud' ? 'selected' : '' }}>Erfoud
                                            </option>
                                            <option value="Essaouira"
                                                {{ old('ville', $user->ville) == 'Essaouira' ? 'selected' : '' }}>Essaouira
                                            </option>
                                            <option value="Fes"
                                                {{ old('ville', $user->ville) == 'Fes' ? 'selected' : '' }}>Fes</option>
                                            <option value="Fnideq"
                                                {{ old('ville', $user->ville) == 'Fnideq' ? 'selected' : '' }}>Fnideq
                                            </option>
                                            <option value="Guelmim"
                                                {{ old('ville', $user->ville) == 'Guelmim' ? 'selected' : '' }}>Guelmim
                                            </option>
                                            <option value="Ifrane"
                                                {{ old('ville', $user->ville) == 'Ifrane' ? 'selected' : '' }}>Ifrane
                                            </option>
                                            <option value="Kenitra"
                                                {{ old('ville', $user->ville) == 'Kenitra' ? 'selected' : '' }}>Kenitra
                                            </option>
                                            <option value="Khemisset"
                                                {{ old('ville', $user->ville) == 'Khemisset' ? 'selected' : '' }}>Khemisset
                                            </option>
                                            <option value="Khenifra"
                                                {{ old('ville', $user->ville) == 'Khenifra' ? 'selected' : '' }}>Khenifra
                                            </option>
                                            <option value="Khouribga"
                                                {{ old('ville', $user->ville) == 'Khouribga' ? 'selected' : '' }}>Khouribga
                                            </option>
                                            <option value="Ksar El Kebir"
                                                {{ old('ville', $user->ville) == 'Ksar El Kebir' ? 'selected' : '' }}>Ksar
                                                El Kebir</option>
                                            <option value="Laayoune"
                                                {{ old('ville', $user->ville) == 'Laayoune' ? 'selected' : '' }}>Laayoune
                                            </option>
                                            <option value="Larache"
                                                {{ old('ville', $user->ville) == 'Larache' ? 'selected' : '' }}>Larache
                                            </option>
                                            <option value="Marrakech"
                                                {{ old('ville', $user->ville) == 'Marrakech' ? 'selected' : '' }}>Marrakech
                                            </option>
                                            <option value="Martil"
                                                {{ old('ville', $user->ville) == 'Martil' ? 'selected' : '' }}>Martil
                                            </option>
                                            <option value="Meknes"
                                                {{ old('ville', $user->ville) == 'Meknes' ? 'selected' : '' }}>Meknes
                                            </option>
                                            <option value="Mohammedia"
                                                {{ old('ville', $user->ville) == 'Mohammedia' ? 'selected' : '' }}>
                                                Mohammedia</option>
                                            <option value="Nador"
                                                {{ old('ville', $user->ville) == 'Nador' ? 'selected' : '' }}>Nador
                                            </option>
                                            <option value="Oualidia"
                                                {{ old('ville', $user->ville) == 'Oualidia' ? 'selected' : '' }}>Oualidia
                                            </option>
                                            <option value="Ouarzazate"
                                                {{ old('ville', $user->ville) == 'Ouarzazate' ? 'selected' : '' }}>
                                                Ouarzazate</option>
                                            <option value="Oujda"
                                                {{ old('ville', $user->ville) == 'Oujda' ? 'selected' : '' }}>Oujda
                                            </option>
                                            <option value="Rabat"
                                                {{ old('ville', $user->ville) == 'Rabat' ? 'selected' : '' }}>Rabat
                                            </option>
                                            <option value="Safi"
                                                {{ old('ville', $user->ville) == 'Safi' ? 'selected' : '' }}>Safi</option>
                                            <option value="Saidia"
                                                {{ old('ville', $user->ville) == 'Saidia' ? 'selected' : '' }}>Saidia
                                            </option>
                                            <option value="Salé"
                                                {{ old('ville', $user->ville) == 'Salé' ? 'selected' : '' }}>Salé</option>
                                            <option value="Sefrou"
                                                {{ old('ville', $user->ville) == 'Sefrou' ? 'selected' : '' }}>Sefrou
                                            </option>
                                            <option value="Tangier"
                                                {{ old('ville', $user->ville) == 'Tangier' ? 'selected' : '' }}>Tangier
                                            </option>
                                            <option value="Taza"
                                                {{ old('ville', $user->ville) == 'Taza' ? 'selected' : '' }}>Taza</option>
                                            <option value="Temara"
                                                {{ old('ville', $user->ville) == 'Temara' ? 'selected' : '' }}>Temara
                                            </option>
                                            <option value="Tétouan"
                                                {{ old('ville', $user->ville) == 'Tétouan' ? 'selected' : '' }}>Tétouan
                                            </option>
                                            <option value="Tiznit"
                                                {{ old('ville', $user->ville) == 'Tiznit' ? 'selected' : '' }}>Tiznit
                                            </option>
                                        </select>
                                        <x-input-error :messages="$errors->get('ville')" class="mt-2" />

                                    </div>


                                    <div class="md:col-span-5">
                                        <div class="inline-flex items-center">
                                            <input type="checkbox" name="privacy_policy" id="privacy_policy"
                                                class="form-checkbox text-blue-500 border-blue-500" />
                                            <label for="privacy_policy" class="ml-2 text-gray-600">I agree to the <a
                                                    href="{{ route('privacy.policy') }}"
                                                    class="text-blue-500 hover:underline">Privacy
                                                    Policy</a></label>
                                        </div>
                                        <x-input-error :messages="$errors->get('privacy_policy')" class="mt-2" />

                                    </div>

                                    <div class="md:col-span-5">
                                        <div class="inline-flex items-center">
                                            <input type="checkbox" name="terms_conditions" id="terms_conditions"
                                                class="form-checkbox text-blue-500 border-blue-500" />
                                            <label for="terms_conditions" class="ml-2 text-gray-600">I agree to the <a
                                                    href="{{ route('terms.and.conditions') }}"
                                                    class="text-blue-500 hover:underline">Terms and
                                                    Conditions</a></label>
                                        </div>
                                        <x-input-error :messages="$errors->get('terms_conditions')" class="mt-2" />

                                    </div>


                                    <div class="md:col-span-2">
                                        <label for="phone">Phone</label>
                                        <input name="phone" id="phone" placeholder="Phone"
                                            class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent"
                                            value="{{ old('phone', $user->phone) }}" />
                                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />

                                    </div>

                                    <div class="md:col-span-5 text-right">
                                        <div class="inline-flex items-end">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

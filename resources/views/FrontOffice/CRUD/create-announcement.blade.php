@extends('layouts.public')

@section('title', 'Create New Announcement')

@section('content')
    {{-- @php
        $user = Auth::user();
    @endphp --}}
    <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div
                class="absolute inset-0 bg-gradient-to-r from-cyan-700 to-blue-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
            </div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div class="divide-y divide-gray-200">
                        <h2 class="text-center text-3xl font-extrabold text-gray-900">Create New Announcement</h2>
                        <form method="POST" action="{{ route('user.create.announcement') }}" enctype="multipart/form-data"
                            class="mt-8 space-y-6">
                            @csrf
                            <input type="number" class="hidden" name="user" id="user"
                                value="{{ Auth::user()->id }}">
                            <div class="rounded-md shadow-sm -space-y-px">
                                <div class="mb-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input id="title" type="text" name="title" :value="old('title')" required
                                        autofocus autocomplete="title" placeholder="Announcement Title"
                                        class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <div class="mb-4">
                                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                    <input id="price" type="number" name="price" :value="old('price')" required
                                        autofocus autocomplete="price" placeholder="Product Price"
                                        class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                </div>
                                <div class="mb-4">
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-900">Description</label>
                                    <textarea id="description" rows="4"
                                        class="block w-full mt-1 p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Description ..." name="description"></textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                                <div class="mb-4">
                                    <label for="image" class="block text-sm font-medium text-gray-900">Image</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label for="dropzone-file"
                                            class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                                        upload</span>
                                                    or drag and drop</p>
                                                <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                            </div>
                                            <input id="dropzone-file" type="file" name="images[]" class="hidden" multiple
                                                onchange="previewImages(event)">
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-center mt-4" id="imagePreview"
                                        style="display: none;">
                                        <div class="grid grid-cols-3 gap-4">
                                            <!-- Image preview will be shown here -->
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="city" class="block text-sm font-medium text-gray-900">Select a
                                        City</label>
                                    <select id="city" name="city"
                                        class="block w-full mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                        <option selected disabled>Choose a city</option>
                                        <option value="Agadir">Agadir</option>
                                        <option value="Al Hoceima">Al Hoceima</option>
                                        <option value="Azemmour">Azemmour</option>
                                        <option value="Beni Mellal">Beni Mellal</option>
                                        <option value="Benslimane">Benslimane</option>
                                        <option value="Bouznika">Bouznika</option>
                                        <option value="Casablanca">Casablanca</option>
                                        <option value="Chefchaouen">Chefchaouen</option>
                                        <option value="Dakhla">Dakhla</option>
                                        <option value="El Jadida">El Jadida</option>
                                        <option value="Erfoud">Erfoud</option>
                                        <option value="Essaouira">Essaouira</option>
                                        <option value="Fes">Fes</option>
                                        <option value="Fnideq">Fnideq</option>
                                        <option value="Guelmim">Guelmim</option>
                                        <option value="Ifrane">Ifrane</option>
                                        <option value="Kenitra">Kenitra</option>
                                        <option value="Khemisset">Khemisset</option>
                                        <option value="Khenifra">Khenifra</option>
                                        <option value="Khouribga">Khouribga</option>
                                        <option value="Ksar El Kebir">Ksar El Kebir</option>
                                        <option value="Laayoune">Laayoune</option>
                                        <option value="Larache">Larache</option>
                                        <option value="Marrakech">Marrakech</option>
                                        <option value="Martil">Martil</option>
                                        <option value="Meknes">Meknes</option>
                                        <option value="Mohammedia">Mohammedia</option>
                                        <option value="Nador">Nador</option>
                                        <option value="Oualidia">Oualidia</option>
                                        <option value="Ouarzazate">Ouarzazate</option>
                                        <option value="Oujda">Oujda</option>
                                        <option value="Rabat">Rabat</option>
                                        <option value="Safi">Safi</option>
                                        <option value="Saidia">Saidia</option>
                                        <option value="Salé">Salé</option>
                                        <option value="Sefrou">Sefrou</option>
                                        <option value="Tangier">Tangier</option>
                                        <option value="Taza">Taza</option>
                                        <option value="Temara">Temara</option>
                                        <option value="Tetouan">Tetouan</option>
                                        <option value="Tiznit">Tiznit</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                </div>
                                <div class="mb-4">
                                    <label for="category" class="block text-sm font-medium text-gray-900">Select a
                                        Category</label>
                                    <select id="category" name="category"
                                        class="block w-full mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                        <option selected disabled>Choose a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                </div>
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Add
                                    Announcement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImages(event) {
            const files = event.target.files;
            const preview = document.getElementById('imagePreview');
            preview.style.display = 'flex';
            preview.innerHTML = '';
            if (files) {
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    if (!file.type.match('image')) continue;
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('w-full', 'h-auto', 'object-cover', 'rounded-lg');
                        const container = document.createElement('div');
                        container.classList.add('w-48', 'h-auto', 'overflow-hidden', 'border', 'border-gray-300',
                            'rounded-lg');
                        container.appendChild(img);
                        preview.appendChild(container);
                    }
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
@endsection

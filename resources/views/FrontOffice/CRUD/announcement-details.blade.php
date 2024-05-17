@extends('layouts.public')

@section('title', 'Home')

@section('content')

    <div class="max-w-md mx-auto p-6 bg-white rounded-md shadow-md mb-8">
        @php
            $items = [['label' => 'Home', 'url' => route('home')], ['label' => 'Announcement Details', 'url' => '#']];
        @endphp
        <x-my-components.breadcrumb :items="$items"></x-breadcrumbs>
    </div>
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <!-- Carousel wrapper -->
        <div id="controls-carousel" class="relative w-full" data-carousel="static">
            <div class="relative h-72 overflow-hidden md:h-96">
                <!-- Carousel -->
                @if ($announcement->images->count() > 0)
                    @foreach ($announcement->images as $key => $image)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ asset('images/' . $image->image_path) }}"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="...">
                            @if (Auth::check() && Auth::user()->id == $announcement->user_id)
                                <a href="#"
                                    class="deleteImage absolute top-3 left-3 p-2 bg-slate-500 rounded-full cursor-pointer "
                                    data-image-id="{{ $image->id }}">
                                    <i class="fa fa-solid fa-trash text-red-500"></i>
                                </a>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="https://via.placeholder.com/300x200.png?text=No+Image+Available"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="No Image Available">
                    </div>
                @endif
            </div>

            <!-- Slider controls -->
            <button type="button"
                class="absolute top-1/2 left-4 transform -translate-y-1/2 z-30 flex items-center justify-center h-10 w-10 bg-white rounded-full shadow-md focus:outline-none"
                data-carousel-prev>
                <span class="sr-only">Previous</span>
                <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button type="button"
                class="absolute top-1/2 right-4 transform -translate-y-1/2 z-30 flex items-center justify-center h-10 w-10 bg-white rounded-full shadow-md focus:outline-none"
                data-carousel-next>
                <span class="sr-only">Next</span>
                <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- Content Container -->
        <div class="p-8">
            @if (Auth::check() && Auth::user()->id == $announcement->user_id)
                <form id="announcementForm" action="{{ route('announcement.update', $announcement->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Title -->
                    <div class="mb-4">
                        <label for="announcementTitle" class="font-bold text-gray-600">Title:</label>
                        <input type="text" name="title" id="announcementTitle" value="{{ $announcement->title }}"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="announcementDescription" class="font-bold text-gray-600">Description:</label>
                        <textarea name="description" id="announcementDescription" rows="5"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $announcement->description }}</textarea>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label for="announcementPrice" class="font-bold text-gray-600">Price:</label>
                        <input type="number" name="price" id="announcementPrice" value="{{ $announcement->price }}"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <!-- City -->
                    <!-- City -->
                    <div class="mb-4">
                        <label for="announcementCity" class="font-bold text-gray-600">City:</label>
                        <select name="city" id="announcementCity"
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option disabled>Choose a city</option>
                            <option value="Agadir" @if ($announcement->ville == 'Agadir') selected @endif>Agadir</option>
                            <option value="Al Hoceima" @if ($announcement->city == 'Al Hoceima') selected @endif>Al Hoceima</option>
                            <option value="Azemmour" @if ($announcement->ville == 'Azemmour') selected @endif>Azemmour</option>
                            <option value="Beni Mellal" @if ($announcement->city == 'Beni Mellal') selected @endif>Beni Mellal
                            </option>
                            <option value="Benslimane" @if ($announcement->ville == 'Benslimane') selected @endif>Benslimane</option>
                            <option value="Bouznika" @if ($announcement->ville == 'Bouznika') selected @endif>Bouznika</option>
                            <option value="Casablanca" @if ($announcement->ville == 'Casablanca') selected @endif>Casablanca</option>
                            <option value="Chefchaouen" @if ($announcement->ville == 'Chefchaouen') selected @endif>Chefchaouen
                            </option>
                            <option value="Dakhla" @if ($announcement->ville == 'Dakhla') selected @endif>Dakhla</option>
                            <option value="El Jadida" @if ($announcement->ville == 'El Jadida') selected @endif>El Jadida</option>
                            <option value="Erfoud" @if ($announcement->ville == 'Erfoud') selected @endif>Erfoud</option>
                            <option value="Essaouira" @if ($announcement->ville == 'Essaouira') selected @endif>Essaouira</option>
                            <option value="Fes" @if ($announcement->ville == 'Fes') selected @endif>Fes</option>
                            <option value="Fnideq" @if ($announcement->ville == 'Fnideq') selected @endif>Fnideq</option>
                            <option value="Guelmim" @if ($announcement->ville == 'Guelmim') selected @endif>Guelmim</option>
                            <option value="Ifrane" @if ($announcement->ville == 'Ifrane') selected @endif>Ifrane</option>
                            <option value="Kenitra" @if ($announcement->ville == 'Kenitra') selected @endif>Kenitra</option>
                            <option value="Khemisset" @if ($announcement->ville == 'Khemisset') selected @endif>Khemisset</option>
                            <option value="Khenifra" @if ($announcement->ville == 'Khenifra') selected @endif>Khenifra</option>
                            <option value="Khouribga" @if ($announcement->ville == 'Khouribga') selected @endif>Khouribga</option>
                            <option value="Ksar El Kebir" @if ($announcement->ville == 'Ksar El Kebir') selected @endif>Ksar El Kebir
                            </option>
                            <option value="Laayoune" @if ($announcement->ville == 'Laayoune') selected @endif>Laayoune</option>
                            <option value="Larache" @if ($announcement->ville == 'Larache') selected @endif>Larache</option>
                            <option value="Marrakech" @if ($announcement->ville == 'Marrakech') selected @endif>Marrakech</option>
                            <option value="Martil" @if ($announcement->ville == 'Martil') selected @endif>Martil</option>
                            <option value="Meknes" @if ($announcement->ville == 'Meknes') selected @endif>Meknes</option>
                            <option value="Mohammedia" @if ($announcement->ville == 'Mohammedia') selected @endif>Mohammedia
                            </option>
                            <option value="Nador" @if ($announcement->ville == 'Nador') selected @endif>Nador</option>
                            <option value="Oualidia" @if ($announcement->ville == 'Oualidia') selected @endif>Oualidia</option>
                            <option value="Ouarzazate" @if ($announcement->ville == 'Ouarzazate') selected @endif>Ouarzazate
                            </option>
                            <option value="Oujda" @if ($announcement->ville == 'Oujda') selected @endif>Oujda</option>
                            <option value="Rabat" @if ($announcement->ville == 'Rabat') selected @endif>Rabat</option>
                            <option value="Safi" @if ($announcement->ville == 'Safi') selected @endif>Safi</option>
                            <option value="Saidia" @if ($announcement->ville == 'Saidia') selected @endif>Saidia</option>
                            <option value="Salé" @if ($announcement->ville == 'Salé') selected @endif>Salé</option>
                            <option value="Sefrou" @if ($announcement->ville == 'Sefrou') selected @endif>Sefrou</option>
                            <option value="Tangier" @if ($announcement->ville == 'Tangier') selected @endif>Tangier</option>
                            <option value="Taza" @if ($announcement->ville == 'Taza') selected @endif>Taza</option>
                            <option value="Temara" @if ($announcement->ville == 'Temara') selected @endif>Temara</option>
                            <option value="Tetouan" @if ($announcement->ville == 'Tetouan') selected @endif>Tetouan</option>
                            <option value="Tiznit" @if ($announcement->ville == 'Tiznit') selected @endif>Tiznit</option>
                        </select>
                    </div>

                    <!-- Image -->
                    <div class="mb-4">
                        <label for="announcementImages" class="font-bold text-gray-600">Images:</label>
                        <input type="file" name="images[]" id="announcementImages" multiple
                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Update
                            Announcement</button>
                    </div>
                </form>
            @else
                <!-- Announcement Info -->
                <div class="flex items-center mb-4 bg-white shadow rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="mr-4">
                                @if ($announcement->user->avatar)
                                    <img src="{{ asset('storage/profile_pictures/' . $announcement->user->avatar) }}"
                                        alt="Profile Picture" class="w-12 h-12 rounded-full" alt="user photo">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ $announcement->user->name }}"
                                        alt="user photo" class="w-12 h-12 rounded-full">
                                @endif
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">{{ $announcement->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $announcement->created_at }}</p>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <p class="text-gray-600"><i
                                class="fas fa-phone-alt mr-1"></i>{{ $announcement->user->phone ? $announcement->user->phone : 'Phone not available' }}
                        </p>
                        <p class="text-gray-600"><i class="fas fa-envelope mr-1"></i>{{ $announcement->user->email }}</p>
                    </div>
                </div>
                <div class="border-t-2 border-gray-200 mt-4 mb-4"></div>

                <!-- Category Name -->
                <div class="flex flex-row justify-between items-center bg-white shadow rounded-lg p-4">
                    <div class="flex flex-col">
                        <span class="text-xs font-semibold text-gray-500 uppercase">Category Name</span>
                        <p class="text-lg text-gray-800 font-bold mt-1">{{ $announcement->category->name }}</p>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-semibold text-gray-500 uppercase">City</span>
                        <p class="text-lg text-gray-800 font-bold mt-1">{{ $announcement->ville }}</p>
                    </div>
                </div>

                <div class="border-t-2 border-gray-200 mt-4 mb-4"></div>

                <!-- Announcement Title -->
                <div class="flex flex-row justify-between items-center bg-white shadow rounded-lg p-4">
                    <div class="mb-4">
                        <label for="announcementTitle" class="font-bold text-gray-600">Title:</label>
                        <p class="block mt-1 text-lg leading-tight font-medium text-black">{{ $announcement->title }}</p>
                    </div>
                    <div class="mb-4">
                        <label for="announcementTitle" class="font-bold text-gray-600">Price :</label>
                        <p class="block mt-1 text-lg leading-tight font-medium text-black">{{ $announcement->price }} MAD
                        </p>
                    </div>
                </div>


                <div class="border-t-2 border-gray-200 mt-4 mb-4"></div>
                <div class="flex flex-row justify-between items-center rounded-lg p-4">
                    <!-- Announcement Description -->
                    <div class="mt-4 text-gray-600 description bg-white shadow rounded-lg p-4">
                        <label for="announcementDescription" class="font-bold text-gray-600">Description:</label>

                        @if (strlen($announcement->description) > 200)
                            {{ substr($announcement->description, 0, 200) }}<span class="ellipsis">...</span><a
                                href="#" class="text-indigo-600 hover:underline">Read more</a>
                        @else
                            <p>{{ $announcement->description }}</p>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('chat', $announcement->user->id) }}">
                            <i class="fa fa-regular fa-comments" style="color: #74C0FC;"></i>
                        </a>
                    </div>

                </div>
            @endif

            <!-- Disclaimer -->
            <div class="mt-8 text-sm text-gray-600 bg-slate-200 shadow rounded-lg p-4">
                <p><strong> <span><i class="fa-solid fa-triangle-exclamation"></i></span>
                        Disclaimer:</strong> This website is not responsible for the products or services announced .
                    Users are advised to exercise caution and conduct their own due diligence before
                    engaging in any transaction.</p>
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script>
        $(document).ready(function() {
            $('#announcementForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(data) {
                        // Handle success response
                        toastr.success(data.message, 'Success');
                    },
                    error: function(data) {
                        // Handle error response
                        toastr.error('An error occurred while updating the announcement.');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.deleteImage').click(function(e) {
                e.preventDefault();
                var imageId = $(this).data('image-id');
                var url = "{{ route('announcement.deleteImage', ':id') }}";
                url = url.replace(':id', imageId);

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function(data) {
                        toastr.success(data.message, 'Success');
                        location.reload();
                    },
                    error: function(data) {
                        toastr.error('An error occurred while deleting the image.');
                    }
                });
            });
        });
    </script>



@endsection

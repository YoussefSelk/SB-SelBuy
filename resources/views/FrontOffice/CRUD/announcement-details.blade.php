@extends('layouts.public')

@section('title', 'Home')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
        <!-- Carousel wrapper -->
        <div id="controls-carousel" class="relative w-full" data-carousel="static">
            <div class="relative h-72 overflow-hidden md:h-96">
                <!-- Carousel -->
                @foreach ($announcement->images as $key => $image)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('images/' . $image->image_path) }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                @endforeach
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
                <form id="announcementForm" action="{{ route('announcement.update', $announcement->id) }}" method="POST">
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

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Update
                            Announcement</button>
                    </div>
                </form>
            @else
                <!-- Announcement Info -->
                <div class="flex items-center mb-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            @if ($announcement->user->avatar)
                                <img class="h-10 w-10 rounded-full"
                                    src="{{ asset('images/' . $announcement->user->avatar) }}" alt="">
                            @else
                                <img class="h-10 w-10 rounded-full"
                                    src="https://ui-avatars.com/api/?name={{ $announcement->user->name }}" alt="">
                            @endif
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
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold mb-4">
                    <label for="category" class="font-bold text-gray-600">Category Name:</label>
                    <p class="text-black">{{ $announcement->category->name }}</p>
                </div>
                <div class="border-t-2 border-gray-200 mt-4 mb-4"></div>

                <!-- Announcement Title -->
                <div class="mb-4">
                    <label for="announcementTitle" class="font-bold text-gray-600">Title:</label>
                    <p class="block mt-1 text-lg leading-tight font-medium text-black">{{ $announcement->title }}</p>
                </div>

                <div class="border-t-2 border-gray-200 mt-4 mb-4"></div>

                <!-- Announcement Description -->
                <div class="mt-4 text-gray-600 description">
                    <label for="announcementDescription" class="font-bold text-gray-600">Description:</label>

                    @if (strlen($announcement->description) > 200)
                        {{ substr($announcement->description, 0, 200) }}<span class="ellipsis">...</span><a href="#"
                            class="text-indigo-600 hover:underline">Read more</a>
                    @else
                        <p>{{ $announcement->description }}</p>
                    @endif

                </div>
            @endif

            <!-- Disclaimer -->
            <div class="mt-8 text-sm text-gray-600">
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
                    data: $(this).serialize(),
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
@endsection

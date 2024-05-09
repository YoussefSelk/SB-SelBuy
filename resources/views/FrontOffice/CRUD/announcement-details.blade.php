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
            <form id="editAnnouncementForm" action="{{ route('user.announcement.update', $announcement) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
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

                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold mb-4">
                    <label for="" class="font-bold text-gray-600">Category Name:</label>
                    <p class="text-black">{{ $announcement->category->name }}</p>
                </div>
                <div class="border-t-2 border-gray-200 mt-4 mb-4"></div>

                <div class="mb-4">
                    <label for="" class="font-bold text-gray-600">Title:</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $announcement->title) }}"
                        class="block w-full mt-1 text-lg leading-tight font-medium text-black">
                </div>

                <div class="border-t-2 border-gray-200 mt-4 mb-4"></div>

                <div class="mt-4 text-gray-600 description">
                    <label for="" class="font-bold text-gray-600">Description:</label>
                    <textarea id="description" name="description" class="block w-full mt-1 text-lg leading-tight font-medium text-black">{{ old('description', $announcement->description) }}</textarea>
                </div>

                <div class="border-t-2 border-gray-200 mt-4 mb-4"></div>

                @if (auth()->id() === $announcement->user_id)
                    <div class="mb-4">
                        <label for="" class="font-bold text-gray-600">Photos:</label>
                        <input type="file" id="photos" name="photos[]"
                            class="block w-full mt-1 text-lg leading-tight font-medium text-black" multiple>
                    </div>
                @endif

                <!-- Disclaimer -->
                <div class="mt-8 text-sm text-gray-600">
                    <p><strong> <span><i class="fa-solid fa-triangle-exclamation"></i></span>
                            Disclaimer:</strong> This website is not responsible for the products or services announced .
                        Users are advised to exercise caution and conduct their own due diligence before
                        engaging in any transaction.</p>
                </div>
                @if (auth()->id() === $announcement->user_id)
                    <div class="mt-4">
                        <button id="updateAnnouncement"
                            class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button">
                            Submit Changes
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-NI5ZhDxwJy09bViZj9w4RX5F0x4nUsZS6Uv2lZ5sDvwq9+g4xDGwXab2bKmtgkJy12DwYpLnhgxU0Y1KIC8vcw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
@endsection

@section('scripts')
    <script>
        // JavaScript and jQuery for the carousel functionality
        $(document).ready(function() {
            // Functionality to navigate the carousel
            $('.carousel-bullet').click(function() {
                var slideIndex = $(this).parent().index();
                var slideId = '#carousel-' + (slideIndex + 1);
                $(slideId).prop('checked', true);
            });

            // Functionality to auto-advance slides
            var autoAdvance = function() {
                var nextSlide = $('input.carousel-open:checked').next('input.carousel-open');
                if (nextSlide.length) {
                    nextSlide.prop('checked', true);
                } else {
                    $('#carousel-1').prop('checked', true);
                }
            };
            setInterval(autoAdvance, 5000);

            // Handle changes made by the user
            $('#updateAnnouncement').on('click', function() {
                var formData = new FormData($('#editAnnouncementForm')[0]);
                formData.append('_method', 'PUT');
                $.ajax({
                    url: $('#editAnnouncementForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        // Handle success response
                        alert('Changes Submitted Successfully!');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error response
                        alert('Error occurred while submitting changes!');
                    }
                });
            });
        });
    </script>
@endsection

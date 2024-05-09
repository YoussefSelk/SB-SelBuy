@extends('layouts.public')

@section('title', 'Home')

@section('content')

    <div class="container mx-auto px-4">
        <!-- Hero Section -->
        <div class="relative mt-6 mb-12">
            <div id="gallery" class="relative w-full" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-80 md:h-96 overflow-hidden rounded-lg">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <a data-fancybox="gallery" href="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg">
                            <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg"
                                class="absolute block w-full h-full object-cover top-0 left-0" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Products Section -->
        <div class="mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Featured Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($featuredProducts as $product)
                    <!-- Product Card -->
                    <a href="{{ route('user.annoucement.details', $product->id) }}">
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                            <div class="flex items-center p-4 border-b border-gray-100">
                                <div class="mr-4">
                                    <img src="{{ $product->user->avatar ? asset('images/' . $product->user->avatar) : 'https://via.placeholder.com/150' }}"
                                        alt="User Avatar" class="w-12 h-12 rounded-full">
                                </div>

                                <div class="flex flex-col">
                                    <div class="text-gray-800 font-medium">{{ $product->user->name }}</div>
                                    <div class="flex items-center text-gray-600 mt-2">
                                        <i class="far fa-clock mr-2"></i>
                                        <span>{{ $product->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                            </div>
                            @foreach ($product->images->take(1) as $image)
                                <div class="p-4">
                                    <img src="{{ asset('images/' . $image->image_path) }}" alt=""
                                        class="w-full h-56 object-cover rounded-lg">
                                </div>
                            @endforeach
                            <div class="p-6 flex flex-row items-center justify-between">
                                <div class="">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $product->title }}</h3>
                                    <div class="flex items-center text-gray-800">
                                        <span class="font-bold">MAD {{ $product->price }}</span>
                                    </div>
                                </div>

                                {{-- <div class="flex items-center mt-2">
                                <button class="like-button mr-2 text-gray-600 hover:text-red-500 focus:outline-none"
                                    data-product-id="{{ $product->id }}">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <span class="like-count text-gray-600">{{ $product->likes }}</span>
                            </div> --}}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>


        <!-- Categories Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4">Categories</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <!-- Category Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">{{ $category->name }}</h3>
                            <p class="text-gray-600">{{ $category->announcements_count }} Products</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Advertisement Section -->
        <div class="mb-12">
            <img src="https://via.placeholder.com/728x90" alt="Advertisement" class="w-full">
        </div>
    </div>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.like-button').click(function() {
                var button = $(this);
                var productId = button.data('product-id');
                var likeCount = button.parent().find('.like-count');

                $.ajax({
                    type: "POST",
                    url: "{{ url('announcements') }}/" + productId + "/like",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        likeCount.text(response.likes);
                        button.toggleClass('text-red-500');
                        if (button.hasClass('text-red-500')) {
                            likeCount.addClass('text-red-500');
                            animateHeart(button);
                        } else {
                            likeCount.removeClass('text-red-500');
                        }
                    }
                });
            });

            function animateHeart(button) {
                var heart = $(
                    '<i class="fas fa-heart absolute text-red-500" style="animation: animateHeart 1s ease;"></i>'
                    );
                button.append(heart);
                setTimeout(function() {
                    heart.remove();
                }, 1000);
            }
        });
    </script> --}}
@endsection

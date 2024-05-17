@extends('layouts.public')

@section('title', 'Home')
@section('carousel')
    <div id="animation-carousel" class="relative w-full" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="relative min-h-[700px] md:min-h-[700px] overflow-hidden">
            <!-- Welcome Message (Hardcoded) -->
            <div class="hidden duration-200 ease-linear" data-carousel-item>
                <div
                    class="bg-gradient-to-r from-zinc-900 via-zinc-800 to-zinc-700 text-white p-8 min-h-[700px] md:min-h-[700px] flex flex-col md:flex-row justify-around items-center">
                    <div class="container mx-auto text-center md:text-left mb-4 md:mb-0 md:mr-4">
                        <h1 class="text-4xl font-bold mb-2">Welcome to our Website</h1>
                        <p class="mb-4">We're glad to have you here!</p>
                        <p class="mb-4">Explore our latest posts and enjoy your time.</p>
                        <div class="flex justify-center md:justify-start">
                            <button class="bg-pink-500 text-white px-4 py-2 rounded-lg mr-4">Explore Now</button>
                            <button class="bg-transparent border border-white text-white px-4 py-2 rounded-lg">Learn
                                More</button>
                        </div>
                        <p class="text-xs mt-4">Today is {{ now()->format('l, F jS, Y') }}</p>
                    </div>
                    <div class="flex justify-center md:ml-4">
                        <img src="https://via.placeholder.com/400x600" alt="Welcome Image"
                            class="object-cover h-auto md:h-full max-w-full">
                    </div>
                </div>
            </div>

            <!-- Posts -->
            @foreach ($posts as $index => $post)
                <!-- Item -->
                <div class="hidden duration-200 ease-linear" data-carousel-item>
                    <div
                        class="bg-gradient-to-r from-zinc-900 via-zinc-800 to-zinc-700 text-white p-8 min-h-[700px] md:min-h-[700px] flex flex-col md:flex-row justify-around items-center">
                        <div class="container mx-auto text-center md:text-left mb-4 md:mb-0 md:ml-4">
                            <h1 class="text-4xl font-bold mb-2">{{ $post->title }}</h1>
                            <p class="mb-2">{{ $post->description }}</p>
                            <p class="text-xs mt-2">{{ $post->created_at }}</p>
                        </div>
                        <div class="flex justify-center md:mr-4">
                            @if ($post->image_url != null)
                                <img src="{{ asset($post->image_url) }}" alt="image"
                                    class="object-cover h-auto md:h-full max-w-full">
                            @else
                                <img src="https://placehold.co/400x600" alt="image"
                                    class="object-cover h-auto md:h-full max-w-full">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-1/2 left-4 md:left-8 z-30 transform -translate-y-1/2 bg-white bg-opacity-50 rounded-full p-2 focus:outline-none"
            data-carousel-prev>
            <svg class="w-6 h-6 md:w-8 md:h-8 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button type="button"
            class="absolute top-1/2 right-4 md:right-8 z-30 transform -translate-y-1/2 bg-white bg-opacity-50 rounded-full p-2 focus:outline-none"
            data-carousel-next>
            <svg class="w-6 h-6 md:w-8 md:h-8 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

@endsection
@section('content')
    <div class="container mx-auto px-4">
        <!-- Filter Section -->
        <div class="mb-8 mt-8">
            <h2 class="text-2xl font-bold mb-2">Filter:</h2>
            <form id="filterForm" action="{{ route('filter.announcements') }}" method="GET"
                class="bg-gray-100 rounded-lg shadow-md p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Category Selector -->
                    <div>
                        <label for="category" class="font-semibold block mb-2">Category:</label>
                        <select name="category" id="category"
                            class="w-full px-4 py-2 bg-gray-200 text-gray-800 rounded-lg focus:outline-none">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Price Range Selector -->
                    <div>
                        <label for="price_min" class="font-semibold block mb-2">Price Range:</label>
                        <div class="flex">
                            <select name="price_min" id="price_min"
                                class="flex-grow px-4 py-2 bg-gray-200 text-gray-800 rounded-lg mr-2 focus:outline-none">
                                <option value="">Min</option>
                                <option value="0">MAD 0</option>
                                <option value="50">MAD 50</option>
                                <option value="100">MAD 100</option>
                                <option value="200">MAD 200</option>
                                <option value="500">MAD 500</option>
                                <option value="1000">MAD 1000</option>
                                <option value="2000">MAD 2000</option>
                                <option value="5000">MAD 5000</option>
                                <option value="10000">MAD 10000</option>
                            </select>
                            <span class="mx-2">-</span>
                            <select name="price_max" id="price_max"
                                class="flex-grow px-4 py-2 bg-gray-200 text-gray-800 rounded-lg ml-2 focus:outline-none">
                                <option value="">Max</option>
                                <option value="50">MAD 50</option>
                                <option value="100">MAD 100</option>
                                <option value="200">MAD 200</option>
                                <option value="500">MAD 500</option>
                                <option value="1000">MAD 1000</option>
                                <option value="2000">MAD 2000</option>
                                <option value="5000">MAD 5000</option>
                                <option value="10000">MAD 10000</option>
                            </select>
                        </div>
                    </div>
                    <!-- Search Input -->
                    <div class="col-span-2">
                        <label for="search" class="font-semibold block mb-2">Search:</label>
                        <input type="text" id="search" name="search"
                            class="w-full px-4 py-2 bg-gray-200 text-gray-800 rounded-lg focus:outline-none"
                            placeholder="Search...">
                    </div>
                    <!-- Apply Filters Button -->
                    <div class="col-span-3 sm:col-span-2 lg:col-span-1">
                        <button type="submit"
                            class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none">Apply
                            Filters</button>
                    </div>
                </div>
            </form>
        </div>

        <div id="announcementsContainer"
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-8 mb-12">
            <!-- Filtered announcements will be displayed here -->
        </div>



        <!-- Featured Products Section -->
        <div class="mb-12 mt-12">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Featured Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($featuredProducts as $product)
                    <!-- Product Card -->
                    <a href="{{ route('user.announcement.details', $product->id) }}">
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                            <div class="flex items-center p-4 border-b border-gray-100">

                                <div class="mr-4">
                                    @if ($product->user->avatar)
                                        <img src="{{ asset('storage/profile_pictures/' . $product->user->avatar) }}"
                                            alt="Profile Picture" class="w-12 h-12 rounded-full" alt="user photo">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ $product->user->name }}"
                                            alt="user photo" class="w-12 h-12 rounded-full">
                                    @endif
                                </div>

                                <div class="flex flex-col">
                                    <div class="text-gray-800 font-medium">{{ $product->user->name }}</div>
                                    <div class="flex items-center text-gray-600 mt-2">
                                        <i class="far fa-clock mr-2"></i>
                                        <span>{{ $product->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                            </div>
                            @if ($product->images->count() > 0)
                                @foreach ($product->images->take(1) as $image)
                                    <div class="p-4">
                                        <img src="{{ asset('images/' . $image->image_path) }}" alt=""
                                            class="w-full h-56 object-cover rounded-lg">
                                    </div>
                                @endforeach
                            @else
                                <div class="p-4">
                                    <img src="https://via.placeholder.com/300x200.png?text=No+Image+Available"
                                        alt="No Image Available" class="w-full h-56 object-cover rounded-lg">
                                </div>
                            @endif


                            <div class="p-6 flex flex-row items-center justify-between">
                                <div class="">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $product->title }}</h3>
                                    <div class="flex items-center text-gray-800">
                                        <span class="font-bold">MAD {{ $product->price }}</span>
                                    </div>
                                    @if (auth()->check())
                                        @if (auth()->user()->hasFavorite($product->id))
                                            <button id="removeFromFavoritesBtn-{{ $product->id }}"
                                                class="remove-from-favorites-btn"
                                                data-favorite-id="{{ $product->id }}">Remove from
                                                Favorites</button>
                                        @else
                                            <button id="addToFavoritesBtn-{{ $product->id }}"
                                                class="add-to-favorites-btn"
                                                data-announcement-id="{{ $product->id }}">Add to Favorites</button>
                                        @endif
                                    @else
                                        <p>Please <a href="{{ route('login') }}">login</a> to add to favorites.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>





        <!-- Car Announcement Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Car Announcements</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($carAnnouncements as $product)
                    <a href="{{ route('user.announcement.details', $product->id) }}">
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                            <div class="flex items-center p-4 border-b border-gray-100">
                                <div class="mr-4">
                                    @if ($product->user->avatar)
                                        <img src="{{ asset('storage/profile_pictures/' . $product->user->avatar) }}"
                                            alt="Profile Picture" class="w-12 h-12 rounded-full" alt="user photo">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ $product->user->name }}"
                                            alt="user photo" class="w-12 h-12 rounded-full">
                                    @endif
                                </div>

                                <div class="flex flex-col">
                                    <div class="text-gray-800 font-medium">{{ $product->user->name }}</div>
                                    <div class="flex items-center text-gray-600 mt-2">
                                        <i class="far fa-clock mr-2"></i>
                                        <span>{{ $product->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                            </div>
                            @if ($product->images->count() > 0)
                                @foreach ($product->images->take(1) as $image)
                                    <div class="p-4">
                                        <img src="{{ asset('images/' . $image->image_path) }}" alt=""
                                            class="w-full h-56 object-cover rounded-lg">
                                    </div>
                                @endforeach
                            @else
                                <div class="p-4">
                                    <img src="https://via.placeholder.com/300x200.png?text=No+Image+Available"
                                        alt="No Image Available" class="w-full h-56 object-cover rounded-lg">
                                </div>
                            @endif
                            <div class="p-6 flex flex-row items-center justify-between">
                                <div class="">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $product->title }}</h3>
                                    <div class="flex items-center text-gray-800">
                                        <span class="font-bold">MAD {{ $product->price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Tech Announcement Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Tech Announcements</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($techAnnouncements as $product)
                    <a href="{{ route('user.announcement.details', $product->id) }}">
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                            <div class="flex items-center p-4 border-b border-gray-100">
                                <div class="mr-4">
                                    @if ($product->user->avatar)
                                        <img src="{{ asset('storage/profile_pictures/' . $product->user->avatar) }}"
                                            alt="Profile Picture" class="w-12 h-12 rounded-full" alt="user photo">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ $product->user->name }}"
                                            alt="user photo" class="w-12 h-12 rounded-full">
                                    @endif
                                </div>

                                <div class="flex flex-col">
                                    <div class="text-gray-800 font-medium">{{ $product->user->name }}</div>
                                    <div class="flex items-center text-gray-600 mt-2">
                                        <i class="far fa-clock mr-2"></i>
                                        <span>{{ $product->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                            </div>
                            @if ($product->images->count() > 0)
                                @foreach ($product->images->take(1) as $image)
                                    <div class="p-4">
                                        <img src="{{ asset('images/' . $image->image_path) }}" alt=""
                                            class="w-full h-56 object-cover rounded-lg">
                                    </div>
                                @endforeach
                            @else
                                <div class="p-4">
                                    <img src="https://via.placeholder.com/300x200.png?text=No+Image+Available"
                                        alt="No Image Available" class="w-full h-56 object-cover rounded-lg">
                                </div>
                            @endif
                            <div class="p-6 flex flex-row items-center justify-between">
                                <div class="">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $product->title }}</h3>
                                    <div class="flex items-center text-gray-800">
                                        <span class="font-bold">MAD {{ $product->price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <!-- Categories Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">Categories</h2>
            <div id="categories-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <!-- Category Card -->
                    <div
                        class="bg-white rounded-lg shadow-lg transform transition duration-500 hover:scale-105 category-card {{ $loop->index >= 8 ? 'hidden' : '' }}">
                        <div class="p-4 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold mb-2 flex items-center text-gray-700">
                                    <i class="fas fa-tag mr-2 text-indigo-500"></i>
                                    {{ $category->name }}
                                </h3>
                                <p class="text-gray-600 flex items-center">
                                    <i class="fas fa-boxes mr-2"></i>
                                    {{ $category->announcements_count }} Announcements
                                </p>
                            </div>
                            <a href="{{ route('user.category.anouncements', $category->id) }}"
                                class="text-indigo-500 hover:text-indigo-600 transition-colors">
                                <i class="fas fa-arrow-circle-right text-xl"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-6">
                <button id="show-more-button"
                    class="bg-indigo-500 text-white px-4 py-2 rounded-full shadow-lg hover:bg-indigo-600 transition-transform transform hover:scale-105">
                    Show More
                </button>
                <button id="show-less-button"
                    class="bg-red-500 text-white px-4 py-2 rounded-full shadow-lg hover:bg-red-600 transition-transform transform hover:scale-105 hidden">
                    Show Less
                </button>
            </div>
        </div>





        <!-- Advertisement Section -->
        <div class="mb-12">
            <img src="https://via.placeholder.com/728x90" alt="Advertisement" class="w-full">
        </div>
    </div>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

{{-- Handle the Filter --}}

<script>
    $(document).ready(function() {
        $('#filterForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'GET',
                url: $(this).attr('action'),
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#announcementsContainer').empty();
                    if (response.announcements.data.length > 0) {
                        $.each(response.announcements.data, function(index, announcement) {
                            var user = announcement.user ? announcement.user : {
                                name: "Unknown",
                                avatar: null
                            };
                            var image = announcement.images.length > 0 ?
                                "{{ asset('images/') }}/" + announcement.images[0]
                                .image_path :
                                'https://via.placeholder.com/300x200.png?text=No+Image+Available';
                            var date = moment(announcement.created_at).fromNow();
                            var html = '<a href="/announcements/' + announcement
                                .id + '/details">';

                            html +=
                                '<div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">';
                            html +=
                                '<div class="flex items-center p-4 border-b border-gray-100">';
                            html += '<div class="mr-4">';
                            html += '<img src="' + (user.avatar ?
                                    "{{ asset('images/') }}" + user.avatar :
                                    'https://via.placeholder.com/150') +
                                '" alt="User Avatar" class="w-12 h-12 rounded-full">';
                            html += '</div>';
                            html += '<div class="flex flex-col">';
                            html += '<div class="text-gray-800 font-medium">' + user
                                .name + '</div>';
                            html +=
                                '<div class="flex items-center text-gray-600 mt-2">';
                            html += '<i class="far fa-clock mr-2"></i>';
                            html += '<span>' + date + '</span>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '<div class="p-4">';
                            html += '<img src="' + image +
                                '" alt="" class="w-full h-56 object-cover rounded-lg">';
                            html += '</div>';
                            html +=
                                '<div class="p-6 flex flex-row items-center justify-between">';
                            html += '<div>';
                            html +=
                                '<h3 class="text-xl font-semibold text-gray-900 mb-3">' +
                                announcement.title + '</h3>';
                            html += '<div class="flex items-center text-gray-800">';
                            html += '<span class="font-bold">MAD ' + announcement
                                .price + '</span>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</a>';
                            $('#announcementsContainer').append(html);
                        });
                    } else {
                        toastr.warning('No announcements found.');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Failed to load announcements. Please try again later.');
                }
            });
        });
    });
</script>
{{-- Handle the Categorie show more and show less --}}
<script>
    $(document).ready(function() {
        $('#show-more-button').click(function() {
            $('.category-card.hidden').slice(0, 8).removeClass('hidden').hide().slideDown(600, 'swing');

            if ($('.category-card.hidden').length === 0) {
                $('#show-more-button').fadeOut(600);
                $('#show-less-button').fadeIn(600);
            }
        });

        $('#show-less-button').click(function() {
            $('.category-card').slice(8).slideUp(600, 'swing', function() {
                $(this).addClass('hidden');
            });
            $('#show-more-button').fadeIn(600);
            $('#show-less-button').fadeOut(600);
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Add to favorites
        $(document).on('click', '.add-to-favorites-btn', function(e) {
            e.preventDefault();
            var btn = $(this); // Store the button element reference
            var announcementId = btn.data('announcement-id');
            $.ajax({
                url: '/favorites/add',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    announcement_id: announcementId
                },
                success: function(response) {
                    // Show success message
                    toastr.success('Announcement added to favorites successfully!');
                    // Update button text and class
                    btn.removeClass('add-to-favorites-btn').addClass(
                        'remove-from-favorites-btn').text('Remove from Favorites');
                    // You can perform additional actions here if needed
                },
                error: function(xhr) {
                    // Handle error, e.g., show an error message
                    toastr.error('Failed to add announcement to favorites.');
                }
            });
        });

        // Remove from favorites
        $(document).on('click', '.remove-from-favorites-btn', function(e) {
            e.preventDefault();
            var btn = $(this); // Store the button element reference
            var favoriteId = btn.data('favorite-id');
            $.ajax({
                url: '/favorites/remove/' + favoriteId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Show success message
                    toastr.success('Announcement removed from favorites successfully!');
                    // Update button text and class
                    btn.removeClass('remove-from-favorites-btn').addClass(
                        'add-to-favorites-btn').text('Add to Favorites');
                    // You can perform additional actions here if needed
                },
                error: function(xhr) {
                    // Handle error, e.g., show an error message
                    toastr.error('Failed to remove announcement from favorites.');
                }
            });
        });
    });
</script>

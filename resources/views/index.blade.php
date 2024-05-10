@extends('layouts.public')

@section('title', 'Home')

@section('content')

    <div class="container mx-auto px-4">
        <div class="mt-12 mb-12">
            <img src="https://via.placeholder.com/728x90" alt="Advertisement" class="w-full">
        </div>

        <!-- Featured Products Section -->
        <div class="mb-12">
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
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-shadow hover:shadow-lg">
                        <div class="p-4 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold mb-2 flex items-center">
                                    <i class="fas fa-tag mr-2 text-indigo-500"></i>
                                    {{ $category->name }}
                                </h3>
                                <p class="text-gray-600 flex items-center">
                                    <i class="fas fa-boxes mr-2"></i>
                                    {{ $category->announcements_count }} Announecements
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
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Filter Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-2">Filter:</h2>
            <form id="filterForm" action="{{ route('filter.announcements') }}" method="GET">
                <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <div class="flex-grow">
                        <label for="category" class="font-semibold">Category:</label>
                        <select name="category" id="category"
                            class="w-full px-4 py-2 bg-gray-200 text-gray-800 rounded-lg">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-grow">
                        <label for="price_min" class="font-semibold">Price Range:</label>
                        <div class="flex">
                            <select name="price_min" id="price_min"
                                class="flex-grow px-4 py-2 bg-gray-200 text-gray-800 rounded-lg mr-2">
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
                                class="flex-grow px-4 py-2 bg-gray-200 text-gray-800 rounded-lg ml-2">
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
                    <button type="submit"
                        class="w-full sm:w-auto px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Apply
                        Filters</button>
                </div>
            </form>
        </div>


        <div id="announcementsContainer"
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-8 mb-12">
            <!-- Filtered announcements will be displayed here -->
        </div>

        <!-- Advertisement Section -->
        <div class="mb-12">
            <img src="https://via.placeholder.com/728x90" alt="Advertisement" class="w-full">
        </div>
    </div>

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                                announcement.images[0].image_path :
                                'placeholder.jpg';
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
                            html += '<img src="{{ asset('images/') }}/' + image +
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

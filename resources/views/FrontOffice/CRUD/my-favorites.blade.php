@extends('layouts.public')

@section('content')
    <div class="container mx-auto">
        <!-- Featured Products Section -->
        <div class="mb-12 mt-12">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Favorite Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($favorites as $product)
                    <!-- Product Card -->
                    <a href="{{ route('user.announcement.details', $product->announcement->id) }}">
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
                                        <span>{{ $product->announcement->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                            </div>
                            @if ($product->announcement->images->count() > 0)
                                @foreach ($product->announcement->images->take(1) as $image)
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
                                    <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $product->announcement->title }}
                                    </h3>
                                    <div class="flex items-center text-gray-800">
                                        <span class="font-bold">MAD {{ $product->announcement->price }}</span>
                                    </div>
                                    @if (auth()->check())
                                        @if (auth()->user()->hasFavorite($product->announcement->id))
                                            <button id="removeFromFavoritesBtn-{{ $product->announcement->id }}"
                                                class="remove-from-favorites-btn"
                                                data-favorite-id="{{ $product->announcement->id }}">Remove from
                                                Favorites</button>
                                        @else
                                            <button id="addToFavoritesBtn-{{ $product->announcement->id }}"
                                                class="add-to-favorites-btn"
                                                data-announcement-id="{{ $product->announcement->id }}">Add to
                                                Favorites</button>
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
    </div>
@endsection

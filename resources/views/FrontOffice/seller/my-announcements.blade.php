@extends('layouts.public')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6">{{ $user->name }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($announcements as $product)
                    <!-- Product Card -->
                    <a href="{{ route('user.announcement.details', $product->id) }}">
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
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

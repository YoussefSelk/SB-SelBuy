<!-- resources/views/components/my-components/announcement-card.blade.php -->

@props(['announcement'])

@php
    $user = $announcement->user;
@endphp

<a href="{{ route('user.announcement.details', $announcement->id) }}">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
        <div class="p-4 border-b border-gray-100">
            <div class="flex items-center mb-4">
                <img src="{{ $user->avatar ? asset('images/' . $user->avatar) : 'https://via.placeholder.com/150' }}"
                    alt="User Avatar" class="w-12 h-12 rounded-full mr-4">
                <div>
                    <div class="text-gray-800 font-medium">{{ $user->name }}</div>
                    <div class="flex items-center text-gray-600 mt-1">
                        <i class="far fa-clock mr-2"></i>
                        <span>{{ $announcement->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @foreach ($announcement->images as $image)
                    <img src="{{ asset('images/' . $image->image_path) }}" alt=""
                        class="w-full h-40 object-cover rounded-lg">
                @endforeach
            </div>
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $announcement->title }}</h3>
                <div class="text-gray-800 font-bold">MAD {{ $announcement->price }}</div>
            </div>
        </div>
    </div>
</a>

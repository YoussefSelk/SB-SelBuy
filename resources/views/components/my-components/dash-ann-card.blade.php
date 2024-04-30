<!-- resources/views/components/product-card.blade.php -->

@props(['image', 'title', 'price', 'buttonText', 'buttonLink'])

<div class="relative flex flex-col text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-64">
    <div class="relative mx-2 mt-2 overflow-hidden text-gray-700 bg-white bg-clip-border rounded-xl h-48">
        <img src="{{ $image }}" alt="card-image" class="object-cover w-full h-full" />
    </div>
    <div class="p-3">
        <div class="flex items-center justify-between mb-2">
            <p class="block font-sans text-sm antialiased font-medium leading-relaxed text-blue-gray-900">
                {{ $title }}
            </p>
            <p class="block font-sans text-sm antialiased font-medium leading-relaxed text-blue-gray-900">
                {{ $price }}
            </p>
        </div>
        <div class="block font-sans text-xs antialiased font-normal leading-normal text-gray-700 opacity-75">
            {{ $slot }}
        </div>
    </div>
    <div class="p-3 pt-0">
        <a href="{{ $buttonLink }}"
            class="align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg shadow-gray-900/10 hover:shadow-gray-900/20 focus:opacity-[0.85] active:opacity-[0.85] active:shadow-none block w-full bg-blue-gray-900/10 text-blue-gray-900 shadow-none hover:scale-105 hover:shadow-none focus:scale-105 focus:shadow-none active:scale-100">
            {{ $buttonText }}
        </a>
    </div>
</div>

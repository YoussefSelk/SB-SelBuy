<!-- resources/views/components/dashboard-card.blade.php -->

@props(['title', 'iconColor', 'icon', 'class' => 'w-full md:w-1/2 lg:w-1/3', 'cardClass' => ''])

<div class="{{ $class }} px-4 mb-4">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg {{ $cardClass }}">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="flex-shrink-0 {{ $iconColor }} rounded-md p-3">
                    <i class="{{ $icon }} text-white"></i>
                </div>
                <div class="ml-4 text-lg text-gray-600 dark:text-gray-300 leading-7 font-semibold">
                    <a href="#">{{ $title }}</a>
                </div>
            </div>

            <div class="ml-12">
                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>

@props(['href', 'active'])

@php
    $classes =
        $active ?? false
            ? 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group'
            : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700';
@endphp

<a {{ $attributes->merge(['class' => 'flex items-center p-2 rounded-lg ' . $classes]) }} href="{{ $href }}">
    {{ $slot }}
</a>

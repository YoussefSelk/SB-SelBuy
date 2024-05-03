<!-- resources/views/components/breadcrumb.blade.php -->

@props(['items'])

<ol class="flex items-center whitespace-nowrap">
    @foreach ($items as $key => $item)
        @if ($loop->last)
            <li class="inline-flex items-center text-sm font-semibold text-gray-800 truncate dark:text-neutral-200"
                aria-current="page">
                {{ $item['label'] }}
            </li>
        @else
            <li class="{{ $loop->index > 0 ? 'text-sm' : 'inline-flex items-center' }}">
                <a class="flex items-center text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500"
                    href="{{ $item['url'] }}">
                    {{ $item['label'] }}
                </a>
                <svg class="flex-shrink-0 mx-2 overflow-visible size-4 text-gray-400 dark:text-neutral-600"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </li>
        @endif
    @endforeach
</ol>

@props(['headers'])

<div class="overflow-x-auto">
    <table class="min-w-full bg-white dark:bg-gray-800" id="DataTable">
        <thead class="bg-gray-100 dark:bg-gray-700">
            <tr>
                @foreach ($headers as $header)
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="text-gray-600 dark:text-gray-400 text-sm">
            {{ $slot }}
        </tbody>
    </table>
</div>


@include('includes.DataTable')

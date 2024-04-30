<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Announcement') }}
        </h2>
    </x-slot>



    <x-my-components.dash-card title="Categories List" iconColor="bg-indigo-500" icon="fas fa-chart-bar" class="w-full"
        cardClass="mt-4">

        {{-- <x-my-components.dash-table :headers="['#', 'Name', 'Action']">
            @foreach ($categories as $categorie)
                <tr class="border-b border-gray-200 dark:border-gray-600">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $categorie->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $categorie->name }}</td>
                    <td class=""><a href="{{ route('admin.users.edit', $user->id) }}">Edit</td>
                </tr>
            @endforeach
        </x-my-components.dash-table> --}}
    </x-my-components.dash-card>

</x-app-layout>

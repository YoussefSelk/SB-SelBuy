<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap -mx-4">
                <!-- Card 1 -->
                <x-my-components.dash-card title="Dashboard Card Title" iconColor="bg-indigo-500" icon="fas fa-chart-bar"
                    width="w-full">
                    <p class="text-red-500 dark:text-gray-400">hi</p>
                </x-my-components.dash-card>


                <!-- Add more cards as needed -->
            </div>
        </div>
    </div>
</x-app-layout>

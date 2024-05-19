<x-app-layout>

    <div
        class="p-6 bg-white rounded-md shadow-md overflow-hidden flex flex-col md:flex-row justify-around items-center dark:bg-dark-eval-1">
        <div class="flex flex-row items-center">
            <div class="mr-4">
                @php
                    $user = Auth::user()->avatar;
                @endphp
                @if ($user)
                    <img src="{{ asset('storage/profile_pictures/' . $user) }}" alt="Profile Picture"
                        class="w-32 h-32 rounded-xl" alt="user photo">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="user photo"
                        class="w-32 h-32 rounded-xl">
                @endif
            </div>
            <div>
                <p class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</p>
                <p class="text-gray-500 dark:text-gray-400">Welcome to your Dashboard</p>
                <p class="text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>

            </div>
        </div>

        <div class="p-6 bg-white dark:bg-dark-eval-1 rounded-md md:w-1/2">
            <strong class="text-lg text-gray-800 dark:text-gray-200">Counts:</strong>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div class="bg-white dark:bg-gray-800 rounded-md shadow-md p-4 flex items-center justify-between">
                    <div>
                        <p class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{ count($users) }}</p>
                        <p class="text-gray-500 dark:text-gray-400">Users</p>
                    </div>
                    <i class="fas fa-user-friends text-3xl text-blue-500 dark:text-blue-300"></i>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-md shadow-md p-4 flex items-center justify-between">
                    <div>
                        <p class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{ count($announcements) }}
                        </p>
                        <p class="text-gray-500 dark:text-gray-400">Announcements</p>
                    </div>
                    <i class="fas fa-bullhorn text-3xl text-blue-500 dark:text-blue-300"></i>

                </div>

                <div class="bg-white dark:bg-gray-800 rounded-md shadow-md p-4 flex items-center justify-between">
                    <div>
                        <p class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{ count($categories) }}</p>
                        <p class="text-gray-500 dark:text-gray-400">Categories</p>
                    </div>
                    <i class="fas fa-folder text-3xl text-purple-500 dark:text-purple-300"></i>
                </div>
            </div>
        </div>
    </div>
    <div
        class="p-6 mt-12 bg-white rounded-md shadow-md overflow-hidden flex flex-col md:flex-row justify-around items-center dark:bg-dark-eval-1">
        <div style="width: 50%; margin: auto;">
            {!! $userChart->container() !!}
        </div>

        {!! $userChart->script() !!}
    </div>
    <div
        class="p-6 mt-12 bg-white rounded-md shadow-md overflow-hidden flex flex-col md:flex-row justify-around items-center dark:bg-dark-eval-1">
        <div style="width: 50%; margin: auto;">
            {!! $cityChart->container() !!}
        </div>

        {!! $cityChart->script() !!}
    </div>
</x-app-layout>

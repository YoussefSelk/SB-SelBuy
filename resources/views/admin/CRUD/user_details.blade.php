<x-app-layout>
    <div class="p-6 bg-white rounded-md shadow-md overflow-hidden flex flex-col md:flex-row ">
        @php
            $items = [['label' => 'Home', 'url' => route('admin.users')], ['label' => 'User Details', 'url' => '#']];
        @endphp

        <x-my-components.breadcrumb :items="$items" />

    </div>
    <div class="p-6 mt-4 bg-white rounded-md shadow-md overflow-hidden ">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                data-tabs-toggle="#default-styled-tab-content"
                data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab"
                        data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">User Informations</button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab"
                        aria-controls="dashboard" aria-selected="false">Dashboard</button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab"
                        aria-controls="settings" aria-selected="false">Settings</button>
                </li>
                <li role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="contacts-styled-tab" data-tabs-target="#styled-contacts" type="button" role="tab"
                        aria-controls="contacts" aria-selected="false">Contacts</button>
                </li>
            </ul>
        </div>
        <div id="default-styled-tab-content">
            <div class="hidden p-4 rounded-lg  dark:bg-gray-800" id="styled-profile" role="tabpanel"
                aria-labelledby="profile-tab">
                <div class="p-6 bg-white rounded-md  flex flex-col md:flex-row justify-between items-center">
                    <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                        <div class="w-20 h-20 rounded-full overflow-hidden">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/profile_pictures/' . $user->avatar) }}"
                                    alt="Profile Picture" class="w-full h-full object-cover" alt="user photo">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="user photo"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="text-lg font-semibold mb-2">{{ $user->name }}</div>
                        <div class="text-sm text-gray-600 mb-2">{{ $user->email }}</div>
                        <div class="text-sm text-gray-600 mb-2">{{ $user->phone ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-600 mb-2">{{ $user->ville ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-600">
                            Status: <span
                                class="@if ($user->status == 'active') text-green-600 @else text-red-600 @endif">{{ ucfirst($user->status) }}</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel"
                aria-labelledby="dashboard-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                    classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel"
                aria-labelledby="settings-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                    classes to control the content visibility and styling.</p>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-contacts" role="tabpanel"
                aria-labelledby="contacts-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                        class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>.
                    Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                    classes to control the content visibility and styling.</p>
            </div>
        </div>
    </div>
</x-app-layout>

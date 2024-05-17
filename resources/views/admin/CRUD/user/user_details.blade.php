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
                        aria-controls="dashboard" aria-selected="false">Announcements</button>
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
                <div class="p-6 bg-white rounded-md shadow-md overflow-hidden">
                    <div class="overflow-x-auto ">
                        <x-my-components.dash-table :headers="['#', 'Name', 'User Name', 'Category Name', 'Price', 'is_active', 'Actions']">
                            @foreach ($user->announcements as $announcement)
                                <tr class="border-b border-gray-200 dark:border-gray-600">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $announcement->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $announcement->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $announcement->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $announcement->category->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $announcement->price }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $announcement->is_active }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex flex-row ">
                                        <!-- Delete Button with SweetAlert and AJAX -->
                                        <button onclick="deleteAnnouncement({{ $announcement->id }})"
                                            class="text-red-600 hover:text-red-900 focus:outline-none">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                        <form id="deleteForm_{{ $announcement->id }}"
                                            action="{{ route('admin.delete.announcement', $announcement->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="{{ route('admin.details.announcement', $announcement->id) }}"
                                            class="ml-2">
                                            <i class="fa fa-sharp fa-thin fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </x-my-components.dash-table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script>
    function deleteAnnouncement(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#deleteForm_" + id).submit();
            }
        });
    }
    // Show toastr notification after successful deletion
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif
</script>

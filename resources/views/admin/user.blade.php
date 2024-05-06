<x-app-layout>
    <div
        class="p-6 mb-4 bg-white rounded-md shadow-md overflow-hidden flex flex-col md:flex-row items-center justify-between dark:bg-dark-eval-1">
        <div class="flex items-center">
            <i class="fas fa-users text-4xl md:text-5xl text-blue-500 mr-4"></i>
            <span class="text-xl md:text-2xl">{{ count($users) }}</span>
        </div>
        <!-- Button to toggle modal -->
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="block bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg text-lg px-5 py-2.5 text-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            <i class="fas fa-user-plus text-xl mr-2"></i>
            Add User
        </button>
    </div>



    <div class="p-6 bg-white rounded-md shadow-md overflow-hidden">
        <div class="overflow-x-auto ">
            <x-my-components.dash-table :headers="['Avatar', '#', 'Name', 'Email', 'Role', 'Action']">
                @foreach ($users as $user)
                    <tr class="border-b border-gray-200 dark:border-gray-600">
                        <td class="px-6 py-4 whitespace-nowrap">

                            @if ($user->avatar)
                                <img src="{{ asset('storage/profile_pictures/' . $user->avatar) }}"
                                    alt="Profile Picture" class="w-9 h-9 rounded-full" alt="user photo">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="user photo"
                                    class="w-9 h-9 rounded-full">
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @foreach ($user->roles as $role)
                                <span
                                    class="@if ($role->name == 'Admin' || $role->name == 'SuperAdmin') text-red-600 @else text-gray-800 @endif  bg-gray-200  text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if (Auth::user()->hasRole('SuperAdmin'))
                                @if ($user->hasRole('SuperAdmin'))
                                    <span class="text-red-500">
                                        <i class="fas fa-ban"></i> Forbidden
                                    </span>
                                    @continue
                                @endif
                                <a href="{{ route('admin.edit.user', $user->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.delete.user', $user->id) }}" method="POST"
                                    class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-btn">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            @elseif (Auth::user()->hasRole('Admin'))
                                @if ($user->hasRole('SuperAdmin') || $user->hasRole('Admin'))
                                    <span class="text-red-500">
                                        <i class="fas fa-ban"></i> Forbidden
                                    </span>
                                    @continue
                                @endif
                                <a href="{{ route('admin.edit.user', $user->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.delete.user', $user->id) }}" method="POST"
                                    class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-btn">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('admin.details.user', $user->id) }}"
                                class="ml-2 text-indigo-600 hover:text-indigo-900"> <i class="fas fa-eye"></i>
                                View</a>
                        </td>
                    </tr>
                @endforeach
            </x-my-components.dash-table>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script>
        document.querySelectorAll('.delete-btn').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
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
                        event.target.closest('.delete-form').submit();
                    }
                })
            });
        });
        // Show toastr notification after successful deletion
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>
</x-app-layout>
@include('modals.add-user-modal')

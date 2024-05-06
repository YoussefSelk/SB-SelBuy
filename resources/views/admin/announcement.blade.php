<x-app-layout>
    <div
        class="p-6 mb-4 bg-white rounded-md shadow-md overflow-hidden flex flex-col md:flex-row items-center justify-between dark:bg-dark-eval-1">
        <div class="flex items-center">
            <i class="fas fa-users text-4xl md:text-5xl text-blue-500 mr-4"></i>
            <span class="text-xl md:text-2xl">{{ count($categories) }}</span>
        </div>
        <!-- Button to toggle modal -->
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="block bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg text-lg px-5 py-2.5 text-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            <i class="fa fa-solid fa-plus"></i>
            Add Annoucement
        </button>

    </div>



    <div class="p-6 bg-white rounded-md shadow-md overflow-hidden">
        <div class="overflow-x-auto ">
            <x-my-components.dash-table :headers="['#', 'Name', 'User Name', 'Category Name', 'Price', 'is_active', 'Actions']">
                @foreach ($announcements as $announcement)
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
                                action="{{ route('admin.delete.announcement', $announcement->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="{{ route('admin.details.announcement', $announcement->id) }}" class="ml-2">
                                <i class="fa fa-sharp fa-thin fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-my-components.dash-table>
        </div>
    </div>


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
</x-app-layout>
@include('modals.add-announcement-modal')

<x-app-layout>
    <div
        class="p-6 mb-4 bg-white rounded-md shadow-md overflow-hidden flex flex-col md:flex-row items-center justify-between dark:bg-dark-eval-1">
        <div class="flex items-center">
            <i class="fas fa-tag  md:text-5xl text-blue-500 mr-4"></i>
            <span class="text-xl md:text-2xl">{{ count($categories) }}</span>
        </div>
        <!-- Button to toggle modal -->
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="block bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg text-lg px-5 py-2.5 text-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            <i class="fa fa-solid fa-plus"></i>
            Add Category
        </button>
    </div>



    <div class="p-6 bg-white rounded-md shadow-md overflow-hidden">
        <div class="overflow-x-auto ">
            <x-my-components.dash-table :headers="['#', 'Name', 'Actions']">
                @foreach ($categories as $category)
                    <tr class="border-b border-gray-200 dark:border-gray-600">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.edit.category', $category->id) }}"
                                class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.delete.category', $category->id) }}" method="POST"
                                class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-btn">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>

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
@include('modals.add-category-modal')

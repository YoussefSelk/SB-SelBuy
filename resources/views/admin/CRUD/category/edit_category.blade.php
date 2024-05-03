<x-app-layout>
    <div class="p-6 bg-white rounded-md shadow-md overflow-hidden flex flex-col md:flex-row ">
        @php
            $items = [
                ['label' => 'Home', 'url' => route('admin.categories')],
                ['label' => 'Edit Category', 'url' => '#'],
            ];
        @endphp

        <x-my-components.breadcrumb :items="$items" />

    </div>
    <div class="p-6 mt-2 bg-white rounded-md shadow-md overflow-hidden flex flex-col md:flex-row justify-around ">
        <div class="max-w-md mx-autorounded-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-6">Edit Category</h2>
                <form method="POST" action="{{ route('admin.edit.category.submit', $category->id) }}">
                    @csrf

                    <div class="mb-4">
                        <label for="floating_first_name" class="block text-sm font-medium text-gray-700">Full
                            name</label>
                        <input type="text" value="{{ old('name', $category->name) }}" name="name"
                            id="floating_first_name" placeholder="First name"
                            class="mt-1 block w-full py-2.5 px-4 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm">
                    </div>


                    <button type="submit"
                        class="mt-4 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

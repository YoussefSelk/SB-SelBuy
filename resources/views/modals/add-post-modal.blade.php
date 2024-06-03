<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <div class="relative w-full max-w-md max-h-full p-4">
        <!-- Modal content -->
        <div class="bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Create New Post
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="createPostForm" method="POST" action="{{ route('admin.posts.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="p-4 space-y-4">
                    <div>
                        <label for="title"
                            class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-200">Title</label>
                        <input type="text" name="title" id="title"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 dark:bg-gray-600 dark:text-gray-200"
                            placeholder="Enter title">
                    </div>
                    <div>
                        <label for="description"
                            class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-200">Description</label>
                        <textarea name="description" id="description"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 dark:bg-gray-600 dark:text-gray-200"
                            rows="5" placeholder="Enter description"></textarea>
                    </div>
                    <div>
                        <label for="image"
                            class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-200">Image</label>
                        <input type="file" name="image" id="image"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 dark:bg-gray-600 dark:text-gray-200">
                        <img id="imagePreview" class="mt-2 hidden" src="#" alt="Image preview"
                            style="max-width: 100%; max-height: 200px;">
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create
                            Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<x-app-layout>
    <div class="container mx-auto">
        <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-semibold mb-4">Create a New Post</h2>
            <form id="createPostForm" method="POST" action="{{ route('admin.posts.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                    <input type="text" name="title" id="title"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="Enter title">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                    <textarea name="description" id="description"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" rows="5"
                        placeholder="Enter description"></textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image</label>
                    <input type="file" name="image" id="image"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                    <img id="imagePreview" class="mt-2 hidden" src="#" alt="Image preview"
                        style="max-width: 100%; max-height: 200px;">
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create
                        Post</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#image').change(function() {
                const file = $(this)[0].files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result).removeClass('hidden');
                }
                reader.readAsDataURL(file);
            });
        });
    </script>
</x-app-layout>

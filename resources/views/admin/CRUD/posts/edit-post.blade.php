<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="max-w-2xl mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
            <div class="p-4 border-b dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('Edit Post') }}
                </h3>
            </div>
            <div class="p-4">
                <form method="POST" action="{{ route('admin.posts.edit', $post->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title"
                            class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">{{ __('Title') }}</label>
                        <input type="text"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            id="title" name="title" value="{{ $post->title }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="description"
                            class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">{{ __('Description') }}</label>
                        <textarea
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            id="description" name="description" rows="5" required>{{ $post->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image"
                            class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300">{{ __('Image') }}</label>

                        @if ($post->image_url && $post->image_url !== 'https://via.placeholder.com/300x200.png?text=No+Image+Available')
                            <img id="currentImage" src="{{ asset($post->image_url) }}" alt="Current image"
                                class="mt-2 rounded-md" style="max-width: 100%; max-height: 200px;">
                            <button type="button" id="deleteImageBtn"
                                class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ __('Delete Image') }}</button>
                        @else
                            <input type="file"
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                id="image" name="image">
                            <img id="currentImage" src="https://via.placeholder.com/300x200.png?text=No+Image+Available"
                                alt="Default image" class="mt-2 rounded-md hidden"
                                style="max-width: 100%; max-height: 200px;">
                        @endif

                        <img id="imagePreview" class="mt-2 hidden rounded-sm" src="#" alt="Image preview"
                            style="max-width: 100%; max-height: 200px;">
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ __('Update Post') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#image').change(function() {
                const file = $(this)[0].files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result).removeClass('hidden');
                    $('#currentImage').addClass(
                    'hidden'); // Hide current image when previewing a new one
                }
                reader.readAsDataURL(file);
            });

            $('#deleteImageBtn').click(function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('admin.posts.delete_image', $post->id) }}',
                            type: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    toastr.success(response.message);
                                    $('#currentImage').attr('src',
                                        'https://via.placeholder.com/300x200.png?text=No+Image+Available'
                                        );
                                    $('#deleteImageBtn').remove();
                                    $('#image').removeClass(
                                    'hidden'); // Show the image input field
                                } else {
                                    toastr.error(response.message);
                                }
                            }
                        });
                    }
                });
            });

            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>

    <!-- Include SweetAlert and Toastr libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</x-app-layout>

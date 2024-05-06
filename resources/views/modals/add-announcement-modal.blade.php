<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 bottom-0 left-0 z-50 w-full h-full bg-gray-900 bg-opacity-50">
    <div class="flex items-center justify-center min-h-full">
        <div class="bg-white rounded-lg shadow w-full md:max-w-xl">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Create New Announcement
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
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
            <form method="POST" action="{{ route('admin.add.announcement') }}" enctype="multipart/form-data"
                class="p-4 md:p-6" style="max-height: calc(100vh - 8rem); overflow-y: auto;">
                @csrf
                <!-- Name -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-user mr-2 text-blue-500"></i>
                            Name
                        </label>
                        <input id="title" type="text" name="title" :value="old('title')" required autofocus
                            autocomplete="title" placeholder="Announcement Title"
                            class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-dollar-sign mr-2 text-blue-500"></i>
                            Price
                        </label>
                        <input id="price" type="number" name="price" :value="old('price')" required autofocus
                            autocomplete="price" placeholder="Product Price"
                            class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-900">Description</label>
                    <textarea id="description" rows="4"
                        class="block w-full mt-1 p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Description ..." name="description"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-900">Image</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span>
                                    or drag and drop</p>
                                <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                            </div>
                            <input id="dropzone-file" type="file" name="images[]" class="hidden" multiple
                                onchange="previewImages(event)">
                        </label>
                    </div>
                    <div class="flex items-center justify-center mt-4" id="imagePreview" style="display: none;">
                        <div class="grid grid-cols-3 gap-4">
                            <!-- Image preview will be shown here -->
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="user" class="block text-sm font-medium text-gray-900">Select a User</label>
                        <select id="user" name="user"
                            class="block w-full mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option selected disabled>Choose a user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-900">Select a Category</label>
                        <select id="category" name="category"
                            class="block w-full mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option selected disabled>Choose a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Add
                        Announcement</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImages(event) {
        const files = event.target.files;
        const preview = document.getElementById('imagePreview');
        preview.style.display = 'flex';
        preview.innerHTML = '';
        if (files) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (!file.type.match('image')) continue;
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-full', 'h-auto', 'object-cover', 'rounded-lg');
                    const container = document.createElement('div');
                    container.classList.add('w-48', 'h-auto', 'overflow-hidden', 'border', 'border-gray-300',
                        'rounded-lg');
                    container.appendChild(img);
                    preview.appendChild(container);
                }
                reader.readAsDataURL(file);
            }
        }
    }
</script>

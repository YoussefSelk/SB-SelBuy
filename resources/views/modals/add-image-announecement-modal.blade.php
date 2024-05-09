<!-- Modal for uploading images -->
<div id="uploadImagesModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75 blur"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            class="inline-block align-middle bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: exclamation -->
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                            Upload Images
                        </h3>
                        <div class="mt-2">
                            <!-- Image Upload Form -->
                            <form id="uploadForm"
                                action="{{ route('admin.add.images.annoucement', $announcement->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <label for="images" class="block text-sm font-medium text-gray-700">
                                        Select Images
                                    </label>
                                    <div
                                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M37 22h-9v9h-4v-9H11v-4h9V11h4v7h9v4z">
                                                </path>
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="file-upload"
                                                    class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                    <span>Upload a file</span>
                                                    <input id="file-upload" name="images[]" type="file"
                                                        class="sr-only" multiple required
                                                        onchange="displayImageNames()">
                                                </label>
                                                <p class="pl-1 text-xs text-gray-500">No file selected</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF up to 10MB
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 sm:mt-6">
                                    <button type="button" onclick="submitForm()"
                                        class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
                                        Upload Images
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- Display selected image names -->
                        <div id="selectedImageNames" class="hidden mt-4">
                            <h4 class="text-lg font-medium text-gray-900">Selected Images</h4>
                            <ul id="selectedImagesList" class="mt-2 text-sm text-gray-600">
                                <!-- Names of selected images will be listed here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Close modal button -->
    <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 focus:outline-none">
        <span class="sr-only">Close</span>
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>
@if (Auth::check() && Auth::user()->id == $announcement->user->id)
    <!-- Button to open upload images modal -->
    <button id="uploadImagesButton"
        class="block bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg text-lg px-5 py-2.5 text-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
        <i class="fa fa-solid fa-image"></i>
        Add Images
    </button>
@endif
<script>
    $(document).ready(function() {

        // Show upload images modal when the button is clicked
        $("#uploadImagesButton").click(function() {
            $("#uploadImagesModal").removeClass("hidden");
        });

        // Hide modal when close button is clicked
        $(".modal-close").click(function() {
            closeModal();
        });

        // Hide modal when clicked outside of it
        $(window).click(function(event) {
            if (event.target == document.getElementById('uploadImagesModal')) {
                closeModal();
            }
        });
    });

    function submitForm() {
        // Show uploading images section
        $("#uploadingImages").removeClass("hidden");
        // Submit the form
        $("#uploadForm").submit();
    }

    function displayImageNames() {
        // Get the names of uploading images
        var files = document.getElementById('file-upload').files;
        var fileList = [];
        for (var i = 0; i < files.length; i++) {
            fileList.push(files[i].name);
        }
        // Display the names of uploading images
        var selectedImagesList = $("#selectedImagesList");
        selectedImagesList.empty();
        fileList.forEach(function(file) {
            selectedImagesList.append("<li>" + file + "</li>");
        });
        // Display selected file name
        if (fileList.length > 0) {
            $("#selectedImageNames").removeClass("hidden");
        } else {
            $("#selectedImageNames").addClass("hidden");
        }
    }

    function closeModal() {
        $("#uploadImagesModal").addClass("hidden");
    }
</script>

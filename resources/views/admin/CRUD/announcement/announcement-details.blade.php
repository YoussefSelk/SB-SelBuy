<x-app-layout>

    <div class="p-6 bg-white rounded-md shadow-md mb-8">
        @php
            $items = [
                ['label' => 'Home', 'url' => route('admin.announcements')],
                ['label' => 'Announcement Details', 'url' => '#'],
            ];
        @endphp
        <x-my-components.breadcrumb :items="$items"></x-breadcrumbs>
    </div>

    <div class="p-6 bg-white rounded-md shadow-md mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex justify-center items-center flex-col">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-1 lg:grid-cols-2 announcement-images">
                    @if (count($announcement->images) > 0)
                        @foreach ($announcement->images as $key => $image)
                            <div class="m-2 announcement-image @if ($key >= 2) hidden @endif">
                                <img class="w-40 h-40 object-cover rounded-lg"
                                    src="{{ asset('images/' . $image->image_path) }}" alt="Announcement Image">
                                <span class=" flex flex-row items-center justify-center mt-2">
                                    <p class="text-sm mr-4 text-gray-500 ">Image {{ $key + 1 }}</p>
                                    <a href="{{ route('admin.delete.image.annoucement', $image->id) }}"
                                        class=""><i class="fa fa-solid fa-trash" style="color: #ff0000;"></i></a>
                                </span>
                            </div>
                        @endforeach
                    @else
                        <div class="m-2 announcement-image">
                            <img class="w-40 h-40 object-cover rounded-lg" src="https://via.placeholder.com/150"
                                alt="Default Image">
                            <span class=" flex flex-row items-center justify-center mt-2">
                                <p class="text-sm mr-4 text-gray-500 ">Default Image</p>
                            </span>
                        </div>
                    @endif
                </div>
                @if (count($announcement->images) > 2)
                    <button id="showMoreImages"
                        class="mt-4 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Show
                        More</button>
                @endif

                <!-- Button to open modal for uploading images -->
                <button id="uploadImagesButton"
                    class="mt-4 w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Upload
                    Images</button>
            </div>
            <div>
                <div class="text-left">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">{{ $announcement->title }}</h2>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $announcement->description }}</p>
                    <div class="mt-6 flex items-center justify-between">
                        <p class="text-lg font-bold text-indigo-600 dark:text-indigo-400">${{ $announcement->price }}
                        </p>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600 dark:text-gray-400">{{ $announcement->views }} views</span>
                            <span class="text-gray-600 dark:text-gray-400">{{ $announcement->likes }} likes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

@include('modals.add-image-announecement-modal')

<script>
    $(document).ready(function() {
        $(".announcement-image:gt(1)").hide();
        $("#showMoreImages").click(function() {
            $(".announcement-image:gt(1)").slideToggle();
            $(this).text($(this).text() == 'Show More' ? 'Show Less' : 'Show More');
        });
    });

    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif
</script>

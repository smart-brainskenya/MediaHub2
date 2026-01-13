<x-public-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Image Gallery</h2>
                    @if($images->count())
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($images as $image)
                                <a href="{{ route('images.show', $image) }}" class="block group">
                                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                                        <img src="{{ Storage::disk('media_images')->url($image->file_path) }}" alt="{{ $image->name }}" class="h-full w-full object-cover object-center group-hover:opacity-75">
                                    </div>
                                    <h3 class="mt-2 font-semibold text-lg text-gray-900 group-hover:text-indigo-600">{{ $image->name }}</h3>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500">No images available at the moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-public-layout>

<x-public-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Video Library</h2>
                    @if($videos->count())
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($videos as $video)
                                <a href="{{ route('videos.show', $video) }}" class="block group">
                                    <div class="bg-gray-200 aspect-video flex items-center justify-center">
                                        {{-- Placeholder for thumbnail --}}
                                        <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <h3 class="mt-2 font-semibold text-lg text-gray-900 group-hover:text-indigo-600">{{ $video->name }}</h3>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500">No videos available at the moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-public-layout>

<x-public-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">{{ $video->name }}</h2>

                    <div class="mb-4">
                        <video controls class="w-full" src="{{ Storage::disk('media_videos')->url($video->file_path) }}"></video>
                    </div>

                    <div x-data="{
                        embedCode: `<iframe width='560' height='315' src='{{ route('videos.embed', $video) }}' frameborder='0' allowfullscreen></iframe>`,
                        videoUrl: '{{ Storage::disk('media_videos')->url($video->file_path) }}',
                        copyToClipboard(text) {
                            navigator.clipboard.writeText(text).then(() => {
                                alert('Copied!');
                            }).catch(err => {
                                alert('Failed to copy!');
                                console.error('Could not copy text: ', err);
                            });
                        }
                    }" class="space-y-4">
                        <div>
                            <h3 class="font-semibold mb-2">Copy Embed Code</h3>
                            <div class="flex items-center space-x-2">
                                <input type="text" readonly :value="embedCode" class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm">
                                <button @click="copyToClipboard(embedCode)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Copy</button>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold mb-2">Copy Video Link</h3>
                            <div class="flex items-center space-x-2">
                                <input type="text" readonly :value="videoUrl" class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm">
                                <button @click="copyToClipboard(videoUrl)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>

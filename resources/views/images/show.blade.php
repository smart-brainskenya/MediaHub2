<x-public-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">{{ $image->name }}</h2>

                    <div class="mb-4">
                        <img src="{{ Storage::disk('media_images')->url($image->file_path) }}" alt="{{ $image->name }}" class="w-full">
                    </div>

                    <div x-data="{
                        imageUrl: '{{ Storage::disk('media_images')->url($image->file_path) }}',
                        imageTag: `<img src='{{ Storage::disk('media_images')->url($image->file_path) }}' alt='{{ $image->name }}'>`,
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
                            <h3 class="font-semibold mb-2">Copy Image URL</h3>
                            <div class="flex items-center space-x-2">
                                <input type="text" readonly :value="imageUrl" class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm">
                                <button @click="copyToClipboard(imageUrl)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Copy</button>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold mb-2">Copy &lt;img&gt; Tag</h3>
                            <div class="flex items-center space-x-2">
                                <input type="text" readonly :value="imageTag" class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm">
                                <button @click="copyToClipboard(imageTag)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>

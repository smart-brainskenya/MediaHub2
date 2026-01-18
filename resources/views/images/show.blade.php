<x-public-layout>
    <div class="py-12 relative overflow-hidden">
        <!-- Background Accents -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-sky/5 rounded-full blur-3xl -mr-32"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-brand-orange/5 rounded-full blur-3xl -ml-32"></div>

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb Navigation -->
            <div class="flex items-center space-x-2 text-sm text-slate-600 mb-8 bg-white/50 w-fit px-4 py-2 rounded-full shadow-sm">
                <a href="/" class="hover:text-brand-blue font-bold transition-colors">Home</a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <a href="{{ route('images.index') }}" class="hover:text-brand-blue font-bold transition-colors">Image Gallery</a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="text-brand-blue font-black truncate max-w-[150px] md:max-w-none">{{ $image->name }}</span>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-3 bg-gradient-ocean"></div>
                
                <div class="p-8 md:p-16">
                    <!-- Image Title & Category -->
                    <div class="text-center mb-12">
                        @if($image->category)
                            <span class="inline-block px-6 py-2 mb-4 text-sm font-black text-white rounded-full shadow-lg transform -rotate-2 hover:rotate-0 transition-transform" style="background-color: {{ $image->category->color ?? '#0954B8' }}">
                                {{ strtoupper($image->category->name) }}
                            </span>
                        @endif
                        <h1 class="text-4xl md:text-6xl font-black text-brand-blue leading-tight">{{ $image->name }}</h1>
                    </div>

                    <!-- Image Display -->
                    <div class="mb-10 group relative">
                        <div class="absolute inset-0 bg-brand-blue/5 rounded-[2.5rem] transform rotate-1 group-hover:rotate-0 transition-transform duration-500"></div>
                        <div class="relative flex justify-center bg-slate-50 rounded-[2.5rem] p-4 md:p-8 border-4 border-slate-50 shadow-inner overflow-hidden">
                            @php
                                $imageUrl = str_starts_with($image->file_path, 'http') 
                                    ? $image->file_path 
                                    : \Illuminate\Support\Facades\Storage::disk('media_images')->url($image->file_path);
                            @endphp
                            <img src="{{ $imageUrl }}" 
                                 alt="{{ $image->name }}" 
                                 class="max-h-[65vh] w-auto object-contain rounded-2xl shadow-2xl transform group-hover:scale-[1.02] transition-transform duration-500"
                                 loading="lazy">
                        </div>
                    </div>

                    <!-- Description -->
                    @if($image->description)
                        <div class="mb-12 text-center max-w-3xl mx-auto">
                            <p class="text-slate-600 text-xl md:text-2xl leading-relaxed font-medium">"{{ $image->description }}"</p>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div x-data="{
                        imageUrl: '{{ $imageUrl }}',
                        imageTag: `<img src='{{ $imageUrl }}' alt='{{ $image->name }}'>`,
                        copiedUrl: false,
                        copiedTag: false,
                        copyToClipboard(text, type) {
                            navigator.clipboard.writeText(text).then(() => {
                                this[type] = true;
                                setTimeout(() => this[type] = false, 2000);
                            }).catch(err => {
                                console.error('Could not copy text: ', err);
                            });
                        }
                    }" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <!-- Copy URL Button -->
                        <button 
                            @click="copyToClipboard(imageUrl, 'copiedUrl')" 
                            class="group relative inline-flex items-center justify-center px-8 py-5 bg-gradient-ocean text-white font-black text-xl rounded-[2rem] shadow-xl hover:shadow-brand-blue/40 transform hover:-translate-y-1 transition-all active:scale-95"
                        >
                            <svg x-show="!copiedUrl" class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.828a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            <span x-text="copiedUrl ? '✓ COPIED!' : 'COPY ADDRESS'"></span>
                        </button>

                        <!-- Copy HTML Tag Button -->
                        <button 
                            @click="copyToClipboard(imageTag, 'copiedTag')" 
                            class="group relative inline-flex items-center justify-center px-8 py-5 bg-white border-4 border-brand-sky text-brand-blue font-black text-xl rounded-[2rem] shadow-xl hover:shadow-brand-sky/20 transform hover:-translate-y-1 transition-all active:scale-95"
                        >
                            <svg x-show="!copiedTag" class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            <span x-text="copiedTag ? '✓ COPIED!' : 'COPY IMG TAG'"></span>
                        </button>
                    </div>

                    <!-- Back to Gallery Button -->
                    <div class="text-center">
                        <a href="{{ route('images.index') }}" class="inline-flex items-center px-8 py-4 bg-slate-100 text-slate-600 font-black rounded-2xl hover:bg-slate-200 transition-all hover:px-12">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            BACK TO GALLERY
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>

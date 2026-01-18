<x-public-layout>
    <div class="py-12 relative overflow-hidden">
        <!-- Background Accents -->
        <div class="absolute top-1/4 left-0 w-80 h-80 bg-brand-yellow/5 rounded-full blur-3xl -ml-40"></div>
        <div class="absolute bottom-1/4 right-0 w-80 h-80 bg-brand-blue/5 rounded-full blur-3xl -mr-40"></div>

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumb Navigation -->
            <div class="flex items-center space-x-2 text-sm text-slate-600 mb-8 bg-white/50 w-fit px-4 py-2 rounded-full shadow-sm">
                <a href="/" class="hover:text-brand-blue font-bold transition-colors">Home</a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <a href="{{ route('videos.index') }}" class="hover:text-brand-blue font-bold transition-colors">Video Library</a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="text-brand-blue font-black truncate max-w-[150px] md:max-w-none">{{ $video->name }}</span>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-3 bg-gradient-sunset"></div>
                
                <div class="p-8 md:p-16">
                    <!-- Video Title & Category -->
                    <div class="text-center mb-12">
                        @if($video->category)
                            <span class="inline-block px-6 py-2 mb-4 text-sm font-black text-white rounded-full shadow-lg transform rotate-2 hover:rotate-0 transition-transform" style="background-color: {{ $video->category->color ?? '#38B6FF' }}">
                                {{ strtoupper($video->category->name) }}
                            </span>
                        @endif
                        <h1 class="text-4xl md:text-6xl font-black text-brand-blue leading-tight">{{ $video->name }}</h1>
                    </div>

                    <!-- Video Player -->
                    @php
                        $videoUrl = str_starts_with($video->file_path, 'http') 
                            ? $video->file_path 
                            : \Illuminate\Support\Facades\Storage::disk('media_videos')->url($video->file_path);
                    @endphp
                    <div class="mb-10 group relative">
                        <div class="absolute inset-0 bg-brand-orange/5 rounded-[2.5rem] transform -rotate-1 group-hover:rotate-0 transition-transform duration-500"></div>
                        <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl bg-slate-900 border-4 border-slate-50">
                            <video controls class="w-full h-auto aspect-video" src="{{ $videoUrl }}"></video>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($video->description)
                        <div class="mb-12 text-center max-w-3xl mx-auto">
                            <p class="text-slate-600 text-xl md:text-2xl leading-relaxed font-medium">"{{ $video->description }}"</p>
                        </div>
                    @endif

                    <!-- Action Section -->
                    <div x-data="{
                        embedCode: `<iframe width='560' height='315' src='{{ route('videos.embed', $video) }}' frameborder='0' allowfullscreen></iframe>`,
                        videoUrl: '{{ $videoUrl }}',
                        copiedEmbed: false,
                        copiedUrl: false,
                        copyToClipboard(text, type) {
                            navigator.clipboard.writeText(text).then(() => {
                                this[type] = true;
                                setTimeout(() => this[type] = false, 2000);
                            }).catch(err => {
                                console.error('Could not copy text: ', err);
                            });
                        }
                    }" class="space-y-8">
                        <!-- Copy Embed Code Section -->
                        <div class="bg-gradient-to-br from-brand-yellow/5 to-brand-orange/10 rounded-[2.5rem] p-8 md:p-10 border-4 border-brand-yellow/20 relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-brand-yellow/10 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-150 duration-700"></div>
                            
                            <h3 class="font-black text-2xl text-slate-900 mb-2 relative z-10">Embed This Video</h3>
                            <p class="text-lg text-slate-600 mb-6 relative z-10 font-medium">Copy this code to put the video on your own website!</p>
                            
                            <div class="flex flex-col md:flex-row gap-4 relative z-10">
                                <input type="text" readonly :value="embedCode" class="flex-1 bg-white/80 backdrop-blur-sm border-2 border-brand-yellow/30 rounded-2xl px-6 py-4 text-sm font-mono text-slate-700 focus:ring-4 focus:ring-brand-yellow/20 focus:border-brand-yellow transition-all">
                                <button 
                                    @click="copyToClipboard(embedCode, 'copiedEmbed')" 
                                    class="px-10 py-4 bg-gradient-sunset text-white font-black text-lg rounded-2xl shadow-xl hover:shadow-brand-orange/40 transform hover:-translate-y-1 transition-all active:scale-95 whitespace-nowrap"
                                >
                                    <span x-text="copiedEmbed ? '✓ COPIED!' : 'COPY CODE'"></span>
                                </button>
                            </div>
                        </div>

                        <!-- Copy Video URL Section -->
                        <div class="bg-gradient-to-br from-brand-sky/5 to-brand-blue/10 rounded-[2.5rem] p-8 md:p-10 border-4 border-brand-sky/20 relative overflow-hidden group">
                            <div class="absolute bottom-0 left-0 w-32 h-32 bg-brand-sky/10 rounded-full -ml-16 -mb-16 transition-transform group-hover:scale-150 duration-700"></div>

                            <h3 class="font-black text-2xl text-slate-900 mb-2 relative z-10">Video Address</h3>
                            <p class="text-lg text-slate-600 mb-6 relative z-10 font-medium">Copy the direct link to the video file.</p>
                            
                            <div class="flex flex-col md:flex-row gap-4 relative z-10">
                                <input type="text" readonly :value="videoUrl" class="flex-1 bg-white/80 backdrop-blur-sm border-2 border-brand-sky/30 rounded-2xl px-6 py-4 text-sm font-mono text-slate-700 focus:ring-4 focus:ring-brand-sky/20 focus:border-brand-sky transition-all">
                                <button 
                                    @click="copyToClipboard(videoUrl, 'copiedUrl')" 
                                    class="px-10 py-4 bg-gradient-ocean text-white font-black text-lg rounded-2xl shadow-xl hover:shadow-brand-blue/40 transform hover:-translate-y-1 transition-all active:scale-95 whitespace-nowrap"
                                >
                                    <span x-text="copiedUrl ? '✓ COPIED!' : 'COPY LINK'"></span>
                                </button>
                            </div>
                        </div>

                        <!-- Back to Library Button -->
                        <div class="text-center pt-4">
                            <a href="{{ route('videos.index') }}" class="inline-flex items-center px-8 py-4 bg-slate-100 text-slate-600 font-black rounded-2xl hover:bg-slate-200 transition-all hover:px-12">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                BACK TO LIBRARY
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>

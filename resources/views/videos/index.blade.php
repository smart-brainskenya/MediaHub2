<x-public-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-10">
                <div class="flex items-center space-x-2 text-sm text-slate-600 mb-4 bg-white/50 w-fit px-4 py-1 rounded-full shadow-sm">
                    <a href="/" class="hover:text-brand-blue font-medium transition-colors">Home</a>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="text-brand-blue font-semibold">Video Library</span>
                </div>
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div>
                        <h1 class="text-4xl md:text-6xl font-bold text-brand-blue mb-3">Video Library</h1>
                        <p class="text-slate-600 text-lg md:text-xl">Watch and learn with our engaging videos!</p>
                    </div>
                    <a href="{{ route('images.index') }}" class="inline-flex items-center px-8 py-3 rounded-full bg-gradient-ocean text-white font-bold shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Explore Images
                    </a>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="mb-12 bg-white p-8 rounded-[2.5rem] shadow-xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-gradient-sunset"></div>
                <form action="{{ route('videos.index') }}" method="GET" class="flex flex-col md:flex-row gap-6 relative z-10">
                    <div class="flex-1 relative">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Find a video to watch..." 
                               class="w-full pl-12 pr-4 py-4 rounded-2xl border-2 border-slate-100 focus:border-brand-orange focus:ring focus:ring-brand-orange focus:ring-opacity-10 transition-all text-lg">
                        <svg class="w-6 h-6 text-brand-orange absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <div class="w-full md:w-72">
                        <select name="category" onchange="this.form.submit()" class="w-full py-4 rounded-2xl border-2 border-slate-100 focus:border-brand-orange focus:ring focus:ring-brand-orange focus:ring-opacity-10 transition-all text-lg font-medium">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-brand-orange text-white px-10 py-4 rounded-2xl font-bold text-lg hover:bg-opacity-90 shadow-lg hover:shadow-brand-orange/20 transition-all">
                        Search
                    </button>
                    @if(request()->anyFilled(['search', 'category']))
                        <a href="{{ route('videos.index') }}" class="flex items-center justify-center py-4 px-6 text-slate-500 hover:text-brand-orange font-bold transition-colors">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Videos Grid -->
            @if($videos->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach ($videos as $video)
                        <a href="{{ route('videos.show', $video) }}" 
                           class="group bg-white rounded-[2rem] overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-500 cursor-pointer border-2 border-transparent hover:border-brand-orange/20">
                            <div class="relative overflow-hidden bg-slate-900 aspect-video flex items-center justify-center">
                                @if($video->thumbnail_url)
                                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <!-- Video Placeholder with Play Icon -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center">
                                        <div class="relative">
                                            <svg class="w-16 h-16 text-slate-500 group-hover:text-brand-sky transition-all duration-500 transform group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"></circle>
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                                @if($video->category)
                                    <div class="absolute top-4 left-4 z-10">
                                        <span class="px-4 py-1.5 text-xs font-black text-white rounded-full shadow-lg" style="background-color: {{ $video->category->color ?? '#38B6FF' }}">
                                            {{ strtoupper($video->category->name) }}
                                        </span>
                                    </div>
                                @endif
                                <!-- Overlay on Hover -->
                                <div class="absolute inset-0 bg-gradient-to-t from-brand-orange/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center z-10">
                                    <div class="bg-white text-brand-orange rounded-full p-4 transform scale-75 group-hover:scale-100 transition-transform duration-500 shadow-xl">
                                        <svg class="w-10 h-10 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="font-bold text-xl text-slate-900 group-hover:text-brand-orange transition-colors line-clamp-2 leading-tight">{{ $video->name }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-16">
                    {{ $videos->links() }}
                </div>
            @else
                <div class="bg-white rounded-[3rem] shadow-xl p-20 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-slate-100"></div>
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <p class="text-2xl text-slate-600 font-bold mb-4">Oops! We couldn't find any videos.</p>
                    <a href="{{ route('videos.index') }}" class="inline-flex items-center text-brand-orange font-bold text-lg hover:underline transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        View all videos
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-public-layout>

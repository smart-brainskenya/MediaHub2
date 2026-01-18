<x-public-layout>
    <div class="min-h-[80vh] flex flex-col items-center justify-center px-4 py-12 relative overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute -top-24 -left-24 w-64 h-64 bg-brand-sky/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -right-32 w-80 h-80 bg-brand-yellow/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 left-1/4 w-72 h-72 bg-brand-orange/10 rounded-full blur-3xl"></div>

        <!-- Hero Section -->
        <div class="mb-12 text-center relative z-10">
            <div class="inline-block mb-6 transform hover:rotate-6 transition-transform duration-300">
                <img src="{{ asset('logo.svg') }}" alt="Smart Brains Kenya Logo" class="h-24 md:h-32 w-auto filter drop-shadow-xl">
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-brand-blue mb-4 tracking-tight">
                What would you like to <span class="text-transparent bg-clip-text bg-gradient-ocean">find today?</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto">
                Explore our amazing collection of images and videos to use in your awesome coding projects!
            </p>
        </div>

        <!-- Primary Navigation Cards -->
        <div class="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
            <!-- Image Gallery Card -->
            <a href="{{ route('images.index') }}" 
               class="group relative bg-white rounded-[2rem] shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-3">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-ocean"></div>
                <div class="p-10 flex flex-col items-center">
                    <div class="mb-8 w-24 h-24 rounded-3xl bg-gradient-ocean flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-brand-blue mb-3">Image Gallery</h2>
                    <p class="text-slate-500 text-center">Find the perfect pictures for your websites.</p>
                    <div class="mt-8 px-8 py-3 bg-brand-sky/10 text-brand-blue font-bold rounded-full group-hover:bg-brand-blue group-hover:text-white transition-all duration-300">
                        Let's Go! →
                    </div>
                </div>
            </a>

            <!-- Video Library Card -->
            <a href="{{ route('videos.index') }}" 
               class="group relative bg-white rounded-[2rem] shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-3">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-sunset"></div>
                <div class="p-10 flex flex-col items-center">
                    <div class="mb-8 w-24 h-24 rounded-3xl bg-gradient-sunset flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:-rotate-3 transition-all duration-300">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-brand-blue mb-3">Video Library</h2>
                    <p class="text-slate-500 text-center">Watch and learn with cool videos.</p>
                    <div class="mt-8 px-8 py-3 bg-brand-yellow/10 text-brand-orange font-bold rounded-full group-hover:bg-brand-orange group-hover:text-white transition-all duration-300">
                        Watch Now! →
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-public-layout>
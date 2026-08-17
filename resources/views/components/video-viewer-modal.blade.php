<!-- Video Viewer Modal -->
<div x-show="showVideo"
    class="fixed inset-0 z-[100] flex items-center justify-center overflow-hidden bg-slate-900/80 backdrop-blur-sm"
    x-cloak style="display: none;">
    <div x-show="showVideo" @click.away="showVideo = false; currentVideo = '';"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl mx-4 sm:mx-auto select-none pointer-events-auto flex flex-col">
        <div
            class="px-6 py-4 border-b border-slate-200 flex justify-between items-center bg-white rounded-t-2xl z-20 shadow-sm relative">
            <h3 class="text-lg font-bold text-slate-800 brand-font flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                    </path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Putar Video
            </h3>
            <button @click="showVideo = false; currentVideo = '';"
                class="text-slate-400 hover:text-rose-500 transition-colors p-1 bg-slate-50 hover:bg-rose-50 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <div class="flex-1 bg-slate-900 rounded-b-2xl flex items-center justify-center p-4 aspect-video relative"
            id="video-container" x-html="currentVideo">
        </div>
    </div>
</div>
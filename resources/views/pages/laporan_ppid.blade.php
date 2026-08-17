@extends('layouts.public')

@section('content')
    <div class="bg-slate-900 pb-32 pt-16 relative overflow-hidden">
        <!-- Abstract pattern -->
        <div class="absolute inset-0 opacity-[0.05] text-white">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pattern-laporan" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path
                            d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                            fill="currentColor"></path>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-laporan)"></rect>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-2xl md:text-4xl font-extrabold text-white brand-font tracking-tight mb-4">Laporan PPID
            </h1>
            <p class="text-indigo-100 max-w-2xl mx-auto text-base">Informasi dokumen laporan rekapitulasi layanan PPID.</p>
        </div>
    </div>

    <!-- Main Content Area -->
    <div x-data="{ 
                            showPreview: false, 
                            previewUrl: '',
                            showVideo: false, 
                            currentVideo: '',
                            openVideo(base64Content) {
                                let content = atob(base64Content);
                                if (content.includes('youtube.com/watch') || content.includes('youtu.be/')) {
                                    let videoId = '';
                                    if (content.includes('youtube.com/watch')) {
                                        videoId = content.split('v=')[1].split('&')[0];
                                    } else {
                                        videoId = content.split('youtu.be/')[1].split('?')[0];
                                    }
                                    content = `<iframe class=\'w-full h-full rounded-b-lg\' src=\'https://www.youtube.com/embed/${videoId}\' frameborder=\'0\' allow=\'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\' allowfullscreen></iframe>`;
                                } else if (!content.includes('<iframe')) {
                                    content = `<iframe class=\'w-full h-full rounded-b-lg\' src=\'${content}\' frameborder=\'0\' allowfullscreen></iframe>`;
                                }
                                this.currentVideo = content;
                                this.showVideo = true;
                            }
                        }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 mb-16">

        @if(isset($laporans) && $laporans->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($laporans as $info)
                    <div
                        class="bg-white/90 backdrop-blur-md rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-slate-100 hover:shadow-[0_8px_30px_-4px_rgba(79,70,229,0.15)] hover:border-indigo-100 transition-all duration-500 transform hover:-translate-y-2 group flex flex-col relative overflow-hidden">
                        <div
                            class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-blue-500 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left z-20">
                        </div>

                        @if(($info->info_type ?? 'file') === 'file' && Str::endsWith(strtolower($info->file_path), '.pdf'))
                            <div
                                class="w-full h-48 bg-slate-100 relative overflow-hidden border-b border-slate-100 flex items-center justify-center">
                                <div class="absolute inset-0 flex items-center justify-center text-slate-300 pdf-loading-indicator z-0">
                                    <svg class="animate-spin h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                        </circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                                <canvas
                                    class="pdf-thumbnail w-full h-auto object-cover opacity-0 transition-opacity duration-700 relative z-10"
                                    data-pdf-url="{{ asset('storage/' . $info->file_path) }}"></canvas>
                                <!-- Overlay gradient -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-slate-900/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                </div>
                            </div>
                        @else
                            <div
                                class="w-full h-48 bg-slate-50 flex items-center justify-center border-b border-slate-200 relative overflow-hidden">
                                <svg class="w-16 h-16 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif

                        <div class="p-6 sm:p-8 flex flex-col flex-grow relative z-20 bg-white">
                            <div class="flex justify-between items-start mb-6">
                                <div
                                    class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-500 shadow-sm border border-indigo-100/50">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex gap-2">
                                    <span
                                        class="px-3 py-1 bg-slate-50 border border-slate-100 text-slate-500 rounded-full text-[10px] sm:text-xs font-bold uppercase tracking-wider shadow-sm">Laporan
                                        PPID</span>
                                    @if($info->published_year)
                                        <span
                                            class="px-3 py-1 bg-indigo-50 border border-indigo-100 text-indigo-700 rounded-full text-[10px] sm:text-xs font-bold uppercase tracking-wider shadow-sm">Tahun
                                            {{ $info->published_year }}</span>
                                    @endif
                                </div>
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 mb-3 brand-font leading-tight">{{ $info->title }}</h3>
                            <p class="text-slate-500 mb-6 text-sm flex-grow leading-relaxed">
                                {{ Str::limit($info->description, 120) }}</p>

                            <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
                                @if(($info->info_type ?? 'file') === 'file')
                                    <button
                                        @click.prevent="showPreview = true; loadPdfViewer('{{ asset('storage/' . $info->file_path) }}')"
                                        class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors group/link brand-font">
                                        Lihat Dokumen
                                        <svg class="w-4 h-4 ml-1.5 group-hover/link:translate-x-0.5 transition-transform" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                @elseif($info->info_type === 'url')
                                    <a href="{{ $info->url }}" target="_blank"
                                        class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors group/link brand-font">
                                        Buka Tautan
                                        <svg class="w-4 h-4 ml-1.5 group-hover/link:translate-x-0.5 transition-transform" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                @elseif($info->info_type === 'video')
                                    <button @click.prevent="openVideo('{{ base64_encode($info->video_embed ?? '') }}')"
                                        class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors group/link brand-font">
                                        Putar Video
                                        <svg class="w-4 h-4 ml-1.5 group-hover/link:translate-x-0.5 transition-transform" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div
                class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden transform transition-all p-12 text-center">
                <div class="mx-auto w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mb-6 shadow-inner">
                    <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-slate-800 brand-font mb-4">Belum Ada Dokumen Laporan</h2>
                <p class="text-slate-500 max-w-lg mx-auto leading-relaxed mb-8">
                    Saat ini belum ada dokumen yang diunggah untuk kategori Laporan PPID.
                </p>
                <a href="{{ url('/') }}"
                    class="inline-flex justify-center items-center px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition-all duration-300 shadow-lg shadow-indigo-600/30 group brand-font">
                    Kembali ke Beranda
                    <svg class="w-5 h-5 ml-2 group-hover:-translate-x-1 transition-transform rotate-180" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7-7m7-7H3">
                        </path>
                    </svg>
                </a>
            </div>
        @endif

        @include('components.pdf-viewer-modal')
        @include('components.video-viewer-modal')
    </div>

    <script>
        function renderPdfThumbnails() {
            const canvases = document.querySelectorAll('.pdf-thumbnail');

            canvases.forEach(canvas => {
                // Return early if already rendered or rendering
                if (canvas.hasAttribute('data-rendered')) return;
                canvas.setAttribute('data-rendered', 'true');

                const url = canvas.getAttribute('data-pdf-url');
                const loadingIndicator = canvas.parentElement.querySelector('.pdf-loading-indicator');

                // Polling to wait for pdfjsLib to become available
                let checks = 0;
                const checkPdfJs = setInterval(() => {
                    checks++;
                    if (typeof pdfjsLib !== 'undefined') {
                        clearInterval(checkPdfJs);

                        pdfjsLib.getDocument(url).promise.then(function (pdf) {
                            return pdf.getPage(1);
                        }).then(function (page) {
                            const viewport = page.getViewport({ scale: 1.0 });
                            const context = canvas.getContext('2d');

                            canvas.width = viewport.width;
                            canvas.height = viewport.height;

                            const renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };

                            return page.render(renderContext).promise;
                        }).then(function () {
                            if (loadingIndicator) loadingIndicator.style.display = 'none';
                            canvas.classList.remove('opacity-0');
                        }).catch(function (error) {
                            console.error('Error rendering PDF thumbnail:', error);
                            if (loadingIndicator) loadingIndicator.innerHTML = '<span class="text-xs">Preview Not Available</span>';
                        });
                    } else if (checks > 20) { // Limit to 10 seconds (20 * 500ms)
                        clearInterval(checkPdfJs);
                        if (loadingIndicator) loadingIndicator.innerHTML = '<span class="text-xs">System Error</span>';
                    }
                }, 500);
            });
        }

        // Run immediately for normal navigation
        renderPdfThumbnails();

        // Setup listener for Turbolinks/Turbo
        document.addEventListener('turbo:load', renderPdfThumbnails);
    </script>
@endsection
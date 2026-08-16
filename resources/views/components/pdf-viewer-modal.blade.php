<!-- PDF Viewer Modal -->
<div x-show="showPreview"
    class="fixed inset-0 z-[100] flex items-center justify-center overflow-hidden bg-slate-900/80 backdrop-blur-sm"
    x-cloak style="display: none;" oncontextmenu="return false;">
    <div x-show="showPreview"
        @click.away="showPreview = false; document.getElementById('pdf-container').innerHTML = '';"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
        class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl h-[85vh] flex flex-col mx-4 sm:mx-auto select-none pointer-events-auto">
        <div
            class="px-6 py-4 border-b border-slate-200 flex justify-between items-center bg-white rounded-t-2xl z-20 shadow-sm relative">
            <h3 class="text-lg font-bold text-slate-800 brand-font flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                    </path>
                </svg>
                Pratinjau Dokumen
            </h3>
            <button @click="showPreview = false; document.getElementById('pdf-container').innerHTML = '';"
                class="text-slate-400 hover:text-rose-500 transition-colors p-1 bg-slate-50 hover:bg-rose-50 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <div class="flex-1 bg-slate-100 p-0 overflow-y-auto rounded-b-2xl relative"
            style="-webkit-overflow-scrolling: touch;">
            <div id="pdf-container" class="flex flex-col items-center py-6 px-2 sm:px-6 w-full min-h-full">
            </div>
            <div id="pdf-loader"
                class="absolute inset-0 flex items-center justify-center text-slate-400 bg-slate-100/80 backdrop-blur-sm z-10"
                style="display: none;">
                <div class="flex flex-col items-center">
                    <svg class="animate-spin h-10 w-10 text-indigo-600 mb-4" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span class="font-semibold text-slate-600 brand-font">Memuat Dokumen...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
<script>
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';

    window.loadPdfViewer = function (url) {
        let container = document.getElementById('pdf-container');
        let loader = document.getElementById('pdf-loader');

        container.innerHTML = '';
        loader.style.display = 'flex';

        url = url.split('#')[0];

        pdfjsLib.getDocument(url).promise.then(function (pdf) {
            loader.style.display = 'none';
            let promises = [];

            for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                promises.push(pdf.getPage(pageNum).then(function (page) {
                    let viewport = page.getViewport({ scale: 1.5 });
                    let wrapper = document.createElement('div');
                    wrapper.className = 'w-full max-w-[800px] mb-6 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.08)] mx-auto relative group';

                    let canvas = document.createElement('canvas');
                    let context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    canvas.className = 'w-full h-auto block rounded-sm';

                    wrapper.appendChild(canvas);
                    container.appendChild(wrapper);

                    return page.render({
                        canvasContext: context,
                        viewport: viewport
                    }).promise;
                }));
            }
        }).catch(function (error) {
            loader.style.display = 'none';
            container.innerHTML = '<div class="text-rose-500 bg-rose-50 p-6 rounded-xl border border-rose-100 font-bold mt-10">Gagal memuat Dokumen.</div>';
        });
    };
</script>
<div x-data="{ open: false }" @open-request-modal.window="open = true" @keydown.escape.window="open = false" x-cloak>

    <!-- Backdrop -->
    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">

        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">

            <div x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-4xl w-full border border-slate-100">

                <!-- Close Button -->
                <button @click="open = false"
                    class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full p-2 transition-colors z-10 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                <!-- Modal Content -->
                <div class="px-6 py-10 sm:px-10 sm:py-12">

                    <div class="text-center mb-12 relative z-10">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-50 text-indigo-600 mb-6 shadow-inner relative">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-slate-800 brand-font mb-3">Pilih Jenis Pemohon Informasi</h2>
                        <p class="text-slate-500 max-w-xl mx-auto text-sm">Sebelum melanjutkan ke formulir permohonan
                            informasi, silakan pilih profil pemohon yang paling sesuai dengan identitas Anda.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">

                        <!-- Perorangan -->
                        <a href="{{ auth()->check() ? route('requests.create', ['type' => 'perorangan']) : route('register', ['type' => 'perorangan']) }}"
                            class="group block bg-white rounded-3xl p-8 shadow-sm border border-slate-200 hover:border-indigo-300 hover:shadow-indigo-100/50 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">

                            <div
                                class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 border border-indigo-100/50 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>

                            <h3
                                class="text-xl font-bold text-slate-800 brand-font mb-3 group-hover:text-indigo-600 transition-colors">
                                Permohonan Perorangan</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-6">Pengajuan informasi yang
                                mengatasnamakan diri sendiri secara pribadi. Anda cukup melampirkan salinan KTP
                                pendaftar.</p>

                            <span
                                class="inline-flex items-center text-indigo-600 font-semibold text-sm brand-font group-hover:text-indigo-700">
                                Lanjutkan Perorangan
                                <svg class="w-4 h-4 ml-1.5 transition-transform group-hover:translate-x-1" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        </a>

                        <!-- Lembaga / Instansi -->
                        <a href="{{ auth()->check() ? route('requests.create', ['type' => 'lembaga']) : route('register', ['type' => 'lembaga']) }}"
                            class="group block bg-white rounded-3xl p-8 shadow-sm border border-slate-200 hover:border-blue-300 hover:shadow-blue-100/50 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">

                            <div
                                class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 border border-blue-100/50 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>

                            <h3
                                class="text-xl font-bold text-slate-800 brand-font mb-3 group-hover:text-blue-600 transition-colors">
                                Permohonan Instansi</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-6">Pengajuan mewakili kelompok, lembaga,
                                ormas, atau institusi. Membutuhkan lampiran SK Pengesahan / Akta Notaris.</p>

                            <span
                                class="inline-flex items-center text-blue-600 font-semibold text-sm brand-font group-hover:text-blue-700">
                                Lanjutkan Instansi/Lembaga
                                <svg class="w-4 h-4 ml-1.5 transition-transform group-hover:translate-x-1" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        </a>

                    </div>
                </div>

                <!-- Decorative Background -->
                <div
                    class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-indigo-50 blur-3xl pointer-events-none opacity-60">
                </div>
                <div
                    class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 rounded-full bg-blue-50 blur-3xl pointer-events-none opacity-60">
                </div>

            </div>
        </div>
    </div>
</div>
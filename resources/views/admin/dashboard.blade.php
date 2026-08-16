<x-app-layout>
    <x-slot name="header">
        Dashboard Admin PPID
    </x-slot>

    <!-- Dashboard Statistics Widgets -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
        <!-- Permohonan Baru -->
        <div
            class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Masuk</p>
                <h4 class="text-2xl font-bold text-slate-800 brand-font">{{ $stats['new_requests'] }}</h4>
            </div>
        </div>

        <!-- Permohonan Diproses -->
        <div
            class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Diproses</p>
                <h4 class="text-2xl font-bold text-slate-800 brand-font">{{ $stats['processing_requests'] }}</h4>
            </div>
        </div>

        <!-- Permohonan Selesai -->
        <div
            class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Selesai</p>
                <h4 class="text-2xl font-bold text-slate-800 brand-font">{{ $stats['completed_requests'] }}</h4>
            </div>
        </div>

        <!-- Jumlah Keberatan -->
        <div
            class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Keberatan</p>
                <h4 class="text-2xl font-bold text-slate-800 brand-font">{{ $stats['total_objections'] }}</h4>
            </div>
        </div>

        <!-- Statistik Pengunjung -->
        <div
            class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wide">Pengunjung</p>
                <h4 class="text-2xl font-bold text-slate-800 brand-font">{{ number_format($stats['visitors']) }}</h4>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Main Admin Content (Left/Center) -->
        <div class="xl:col-span-2 space-y-6">
            <div
                class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 sm:p-8 flex items-start gap-4 shadow-sm h-full">
                <div
                    class="w-12 h-12 rounded-full bg-indigo-200/50 flex items-center justify-center text-indigo-700 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-indigo-900 brand-font mb-1">Selamat Datang di Dasbor PPID
                        Administrator!</h4>
                    <p class="text-indigo-700/80 text-sm leading-relaxed mb-4">Anda dapat mengelola seluruh alur
                        informasi publik melalui panel navigasi di sebelah kiri. Saat ini Anda berada di halaman
                        ikhtisar aktivitas PPID.</p>
                    <a href="{{ route('admin.requests.index') }}"
                        class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 transition inline-flex shadow-sm gap-2">
                        Kelola Permohonan Masyarakat
                        <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions (Right) -->
        <div class="space-y-6">
            <div
                class="bg-gradient-to-br from-indigo-900 to-slate-800 rounded-2xl shadow-lg border border-indigo-900 overflow-hidden relative">
                <div class="absolute top-0 right-0 p-4 opacity-10 pointer-events-none">
                    <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div class="p-5 sm:p-6 backdrop-blur-sm h-full relative z-10">
                    <h3 class="text-lg font-bold text-white brand-font mb-1">Publikasi Informasi</h3>
                    <p class="text-[13px] text-indigo-200 mb-5 font-light">Publikasikan dokumen terbuka.</p>

                    <form action="{{ route('admin.public-info.store') }}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col space-y-3.5">
                        @csrf
                        <div>
                            <label
                                class="block text-[11px] font-semibold text-indigo-300 mb-1 uppercase tracking-wide">Judul
                                Informasi</label>
                            <input type="text" name="title"
                                class="w-full bg-slate-900/50 border border-indigo-500/30 rounded-lg px-3 py-2 text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-indigo-400 focus:border-indigo-400 text-[13px] transition-all"
                                required placeholder="Cth: Laporan Tahunan">
                        </div>
                        <div>
                            <label
                                class="block text-[11px] font-semibold text-indigo-300 mb-1 uppercase tracking-wide">Kategori
                                Informasi</label>
                            <select name="category" required
                                class="w-full bg-slate-900/50 border border-indigo-500/30 rounded-lg px-3 py-2 text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-indigo-400 focus:border-indigo-400 text-[13px] transition-all appearance-none">
                                <option value="berkala">Berkala</option>
                                <option value="serta_merta">Serta Merta</option>
                                <option value="setiap_saat">Setiap Saat</option>
                                <option value="dikecualikan">Dikecualikan</option>
                                <option value="arsip">Arsip Dokumen</option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-[11px] font-semibold text-indigo-300 mb-1 uppercase tracking-wide">Deskripsi
                                <span class="text-slate-500 lowercase">(Opsional)</span></label>
                            <textarea name="description" rows="2"
                                class="w-full bg-slate-900/50 border border-indigo-500/30 rounded-lg px-3 py-2 text-white placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-indigo-400 focus:border-indigo-400 text-[13px] transition-all resize-none"
                                placeholder="Isi deskripsi..."></textarea>
                        </div>
                        <div>
                            <label
                                class="block text-[11px] font-semibold text-indigo-300 mb-1 uppercase tracking-wide">File
                                (PDF/Doc)</label>
                            <div class="relative group cursor-pointer">
                                <div
                                    class="absolute inset-0 bg-indigo-500/10 border border-dashed border-indigo-400/40 rounded-lg group-hover:bg-indigo-500/20 transition-colors">
                                </div>
                                <input type="file" name="info_file"
                                    class="relative z-10 w-full block text-[13px] text-slate-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-[11px] file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 cursor-pointer focus:outline-none p-1"
                                    required>
                            </div>
                        </div>
                        <button type="submit"
                            class="mt-3 w-full bg-indigo-500 text-white font-semibold py-2.5 px-4 rounded-lg hover:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-slate-900 transition-all text-[13px] shadow-sm">
                            Posting Dokumen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
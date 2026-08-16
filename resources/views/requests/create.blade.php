<x-app-layout>
    <x-slot name="header">
        Ajukan Permohonan Informasi
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 sm:p-8 flex items-start gap-4 shadow-sm">
            <div
                class="w-12 h-12 rounded-full bg-indigo-200/50 flex items-center justify-center text-indigo-700 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-lg font-bold text-indigo-900 brand-font mb-1">Panduan Pengajuan</h4>
                <p class="text-indigo-700/80 text-sm leading-relaxed">Berikan subjek informasi spesifik dan
                    alasan/tujuan penggunaan dokumen publik yang kuat. Permohonan Anda akan direspons oleh Admin PPID
                    paling lambat 10 hari kerja sesuai peraturan yang berlaku.</p>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-xl shadow-slate-200/40 sm:rounded-3xl border border-slate-100">
            <div class="p-8 sm:p-10">
                <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data"
                    data-turbo="false" class="space-y-8">
                    @csrf
                    <div>
                        <label class="block text-slate-700 text-sm font-bold mb-3 brand-font uppercase tracking-wide"
                            for="subject">Subjek / Rincian Informasi</label>
                        <input type="text" name="subject" id="subject"
                            class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm"
                            placeholder="Ketik rincian informasi yang dicari (misal: Laporan Anggaran 2025)..."
                            required>
                    </div>

                    <div>
                        <label class="block text-slate-700 text-sm font-bold mb-3 brand-font uppercase tracking-wide"
                            for="information_purpose">Tujuan Penggunaan <span class="text-red-500">*</span></label>
                        <select name="information_purpose" id="information_purpose"
                            class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm"
                            required>
                            <option value="">-- Pilih Tujuan --</option>
                            <option value="Penelitian & akademik">Penelitian & akademik</option>
                            <option value="Pengawasan publik & kontrol sosial">Pengawasan publik & kontrol sosial
                            </option>
                            <option value="Keperluan profesional & bisnis">Keperluan profesional & bisnis</option>
                            <option value="Layanan administratif pribadi">Layanan administratif pribadi</option>
                            <option value="Pengaduan & bantuan sosial">Pengaduan & bantuan sosial</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-slate-700 text-sm font-bold mb-3 brand-font uppercase tracking-wide"
                            for="description">Alasan / Penjelasan Rinci Permohonan <span
                                class="text-red-500">*</span></label>
                        <textarea name="description" id="description" rows="4"
                            class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm resize-none"
                            placeholder="Jelaskan secara singkat untuk keperluan apa dokumen/informasi ini diminta..."
                            required></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                        <!-- Cara Memperoleh Informasi -->
                        <div>
                            <label
                                class="block text-slate-700 text-sm font-bold mb-3 brand-font uppercase tracking-wide">Cara
                                Memperoleh Informasi <span class="text-red-500">*</span></label>
                            <div class="space-y-3">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="obtaining_method"
                                        value="Melihat/Membaca/Mendengarkan/Mencatat"
                                        class="w-5 h-5 text-indigo-600 border-slate-300 focus:ring-indigo-500" required>
                                    <span
                                        class="text-slate-600 text-sm font-medium group-hover:text-indigo-600 transition-colors">Melihat/Membaca/Mendengarkan/Mencatat</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="obtaining_method" value="Mendapatkan Salinan informasi"
                                        class="w-5 h-5 text-indigo-600 border-slate-300 focus:ring-indigo-500" required>
                                    <span
                                        class="text-slate-600 text-sm font-medium group-hover:text-indigo-600 transition-colors">Mendapatkan
                                        Salinan informasi</span>
                                </label>
                            </div>
                        </div>

                        <!-- Upload File Permohonan -->
                        <div>
                            <label
                                class="block text-slate-700 text-sm font-bold mb-3 brand-font uppercase tracking-wide">
                                Surat Permohonan <span
                                    class="text-slate-400 font-normal lowercase ml-1">(Opsional)</span>
                            </label>
                            <div
                                class="p-6 border-2 border-slate-200 border-dashed rounded-xl bg-slate-50 relative group hover:border-indigo-400 hover:bg-indigo-50/30 transition-all flex flex-col items-center justify-center">
                                <input type="file" name="attachment_file" accept=".pdf,.png,.jpg,.jpeg"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                    onchange="if(this.files[0]) { document.getElementById('filename-display').textContent = this.files[0].name; document.getElementById('filename-display').classList.remove('hidden'); document.getElementById('upload-placeholder').classList.add('hidden'); }">
                                <div id="upload-placeholder" class="text-center pointer-events-none">
                                    <svg class="w-8 h-8 text-slate-400 mx-auto mb-2 group-hover:text-indigo-500 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <p class="text-sm text-slate-600 font-medium">Pilih surat permohonan pendukung</p>
                                    <p class="text-[11px] text-slate-400 mt-1">PDF atau JPG (Maks. 5 MB)</p>
                                </div>
                                <div id="filename-display"
                                    class="hidden text-sm font-semibold text-indigo-700 bg-indigo-100 px-3 py-1.5 rounded-lg text-center max-w-full truncate pointer-events-none">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                        <a href="{{ route('requests.index') }}"
                            class="px-6 py-3 bg-slate-100 text-slate-600 font-bold rounded-xl hover:bg-slate-200 transition-colors text-sm brand-font">Batal</a>
                        <button type="submit"
                            class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 transform hover:-translate-y-0.5 text-sm brand-font flex items-center gap-2">
                            Kirim Permohonan
                            <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
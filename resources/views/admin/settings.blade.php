<x-app-layout>
    <x-slot name="header">
        Pengaturan Sistem
    </x-slot>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden" x-data="{ tab: 'identitas' }">
        <div class="flex flex-col md:flex-row">

            <!-- Settings Sidebar -->
            <div class="w-full md:w-64 bg-slate-50 border-b md:border-b-0 md:border-r border-slate-200 shrink-0">
                <div class="p-4 md:p-5">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3 px-3">Menu Pengaturan
                    </h3>
                    <nav class="space-y-1">
                        <button @click="tab = 'identitas'"
                            :class="tab === 'identitas' ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-200/50'"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] transition-colors text-left">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                            Identitas Website
                        </button>
                        <button @click="tab = 'logo'"
                            :class="tab === 'logo' ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-200/50'"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] transition-colors text-left">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Media & Foto Pimpinan
                        </button>
                        <button @click="tab = 'surat'"
                            :class="tab === 'surat' ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-200/50'"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] transition-colors text-left">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Template Surat
                        </button>
                        <button @click="tab = 'email'"
                            :class="tab === 'email' ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-200/50'"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] transition-colors text-left">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            Email Notifikasi
                        </button>
                        <button @click="tab = 'backup'"
                            :class="tab === 'backup' ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-200/50'"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] transition-colors text-left">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                                </path>
                            </svg>
                            Backup Database
                        </button>
                        <button @click="tab = 'log'"
                            :class="tab === 'log' ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-200/50'"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-[13px] transition-colors text-left">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                                </path>
                            </svg>
                            Log Aktivitas
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1 p-5 sm:p-8 min-h-[500px]">

                <!-- Identitas Website -->
                <div x-show="tab === 'identitas'" x-cloak x-transition.opacity.duration.200ms>
                    <h2 class="text-xl font-bold text-slate-800 brand-font mb-6 border-b border-slate-100 pb-3">
                        Identitas Website</h2>
                    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-5 max-w-2xl">
                        @csrf
                        <div>
                            <label class="block text-[13px] font-semibold text-slate-700 mb-1">Nama Instansi</label>
                            <input type="text" name="app_name"
                                class="w-full rounded-lg border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3"
                                value="{{ $settings['app_name'] ?? 'PPID Pemerintah Daerah' }}">
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-slate-700 mb-1">Deskripsi & Motto</label>
                            <textarea name="app_description" rows="3"
                                class="w-full rounded-lg border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3">{{ $settings['app_description'] ?? 'Transparan, Cepat, dan Akuntabel dalam Pelayanan Publik.' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-slate-700 mb-1">Alamat Kantor</label>
                            <input type="text" name="app_address"
                                class="w-full rounded-lg border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3"
                                value="{{ $settings['app_address'] ?? 'Jl. Kemerdekaan No. 45, Komplek Perkantoran' }}">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[13px] font-semibold text-slate-700 mb-1">Telepon</label>
                                <input type="text" name="app_phone"
                                    class="w-full rounded-lg border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3"
                                    value="{{ $settings['app_phone'] ?? '(021) 555-1234' }}">
                            </div>
                            <div>
                                <label class="block text-[13px] font-semibold text-slate-700 mb-1">Email Resmi</label>
                                <input type="email" name="app_email"
                                    class="w-full rounded-lg border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3"
                                    value="{{ $settings['app_email'] ?? 'ppid@example.com' }}">
                            </div>
                        </div>
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg text-[13px] hover:bg-indigo-700 transition">Simpan
                            Identitas</button>
                    </form>
                </div>

                <!-- Media & Foto Pimpinan -->
                <div x-show="tab === 'logo'" x-cloak x-transition.opacity.duration.200ms>
                    <h2 class="text-xl font-bold text-slate-800 brand-font mb-6 border-b border-slate-100 pb-3">Media &
                        Foto Pimpinan</h2>
                    <form action="{{ route('admin.settings.logo') }}" method="POST" enctype="multipart/form-data"
                        data-turbo="false" class="space-y-8">
                        @csrf

                        <!-- Logo Instansi -->
                        <div
                            class="flex flex-col sm:flex-row items-start gap-6 p-5 border border-slate-200 rounded-2xl bg-white shadow-sm">
                            @if(isset($settings['app_logo']) && $settings['app_logo'])
                                <div
                                    class="w-24 h-24 rounded-xl bg-white border border-slate-200 overflow-hidden shadow-sm flex items-center justify-center shrink-0 p-2">
                                    <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="Logo"
                                        class="max-w-full max-h-full object-contain">
                                </div>
                            @else
                                <div
                                    class="w-24 h-24 rounded-xl bg-slate-50 border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-400 shrink-0">
                                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-[9px] font-medium uppercase">Kosong</span>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h4 class="text-[13px] font-semibold text-slate-800 mb-1">Upload Logo Instansi/Sekolah
                                </h4>
                                <p class="text-xs text-slate-500 mb-3">Format disarankan PNG (transparan) atau JPG Maks
                                    2MB.</p>
                                <input type="file" name="app_logo" accept=".png, .jpg, .jpeg, .svg"
                                    class="block w-full text-[13px] text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Foto Kepsek -->
                            <div
                                class="flex flex-col sm:flex-row items-center sm:items-start gap-4 p-5 border border-slate-200 rounded-2xl bg-white shadow-sm">
                                @if(isset($settings['app_foto_kepsek']) && $settings['app_foto_kepsek'])
                                    <div
                                        class="w-20 h-20 rounded-full bg-slate-100 overflow-hidden shadow-inner flex items-center justify-center shrink-0 border border-slate-200">
                                        <img src="{{ asset('storage/' . $settings['app_foto_kepsek']) }}" alt="Kepsek"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="w-20 h-20 rounded-full bg-slate-50 border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-400 shrink-0">
                                        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1 text-center sm:text-left w-full">
                                    <h4 class="text-[13px] font-semibold text-slate-800 mb-1">Foto Kepala Sekolah</h4>
                                    <p class="text-[11px] text-slate-500 mb-3 leading-tight hidden sm:block">Foto resmi
                                        pimpinan yang akan ditampilkan proporsional di beranda website (Maks 2MB).</p>
                                    <input type="file" name="app_foto_kepsek" accept=".png, .jpg, .jpeg, .webp"
                                        class="block w-full text-[11px] text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                </div>
                            </div>

                            <!-- Foto Sekda -->
                            <div
                                class="flex flex-col sm:flex-row items-center sm:items-start gap-4 p-5 border border-slate-200 rounded-2xl bg-white shadow-sm">
                                @if(isset($settings['app_foto_sekda']) && $settings['app_foto_sekda'])
                                    <div
                                        class="w-20 h-20 rounded-full bg-slate-100 overflow-hidden shadow-inner flex items-center justify-center shrink-0 border border-slate-200">
                                        <img src="{{ asset('storage/' . $settings['app_foto_sekda']) }}" alt="Sekda"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="w-20 h-20 rounded-full bg-slate-50 border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-400 shrink-0">
                                        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1 text-center sm:text-left w-full">
                                    <h4 class="text-[13px] font-semibold text-slate-800 mb-1">Foto Sekda / Pejabat PPID
                                    </h4>
                                    <p class="text-[11px] text-slate-500 mb-3 leading-tight hidden sm:block">Foto resmi
                                        pejabat yang mendampingi di halaman beranda (Maks 2MB).</p>
                                    <input type="file" name="app_foto_sekda" accept=".png, .jpg, .jpeg, .webp"
                                        class="block w-full text-[11px] text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 text-right">
                            <button type="submit"
                                class="px-6 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl text-[13px] hover:bg-indigo-700 transition shadow-md shadow-indigo-200 inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Simpan Media
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Template Surat -->
                <div x-show="tab === 'surat'" x-cloak x-transition.opacity.duration.200ms>
                    <h2 class="text-xl font-bold text-slate-800 brand-font mb-6 border-b border-slate-100 pb-3">
                        Template Surat</h2>
                    <div class="bg-indigo-50 border border-indigo-100 p-4 rounded-xl mb-6 flex gap-3">
                        <svg class="w-5 h-5 text-indigo-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-[13px] text-indigo-800">Atur kop surat, struktur, dan tanda tangan digital untuk
                            dokumen cetak (PDF) permohonan informasi.</p>
                    </div>
                    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-5 max-w-2xl">
                        @csrf
                        <div>
                            <label class="block text-[13px] font-semibold text-slate-700 mb-1">Teks Kop Surat (Baris
                                1)</label>
                            <input type="text" name="kop_baris_1"
                                class="w-full rounded-lg border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3"
                                value="{{ $settings['kop_baris_1'] ?? 'PEMERINTAH PROVINSI JAWA TENGAH' }}">
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-slate-700 mb-1">Teks Kop Surat (Baris
                                2)</label>
                            <input type="text" name="kop_baris_2"
                                class="w-full rounded-lg border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3"
                                value="{{ $settings['kop_baris_2'] ?? 'DINAS PENDIDIKAN DAN KEBUDAYAAN' }}">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[13px] font-semibold text-slate-700 mb-1">Nama Penanda
                                    Tangan</label>
                                <input type="text" name="pejabat_nama"
                                    class="w-full rounded-lg border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3"
                                    value="{{ $settings['pejabat_nama'] ?? 'Dr. Budi Santoso, M.Si' }}">
                            </div>
                            <div>
                                <label class="block text-[13px] font-semibold text-slate-700 mb-1">NIP</label>
                                <input type="text" name="pejabat_nip"
                                    class="w-full rounded-lg border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3"
                                    value="{{ $settings['pejabat_nip'] ?? '19700101 199503 1 001' }}">
                            </div>
                        </div>
                        <button type="submit"
                            class="px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg text-[13px] hover:bg-indigo-700 transition">Simpan
                            Template</button>
                    </form>
                </div>

                <!-- Email Notifikasi -->
                <div x-show="tab === 'email'" x-cloak x-transition.opacity.duration.200ms>
                    <h2 class="text-xl font-bold text-slate-800 brand-font mb-6 border-b border-slate-100 pb-3">
                        Konfigurasi Email Notifikasi</h2>
                    <form class="space-y-4 max-w-xl">
                        <div>
                            <label class="block text-[13px] font-semibold text-slate-700 mb-1">SMTP Host</label>
                            <input type="text"
                                class="w-full rounded-lg border-slate-200 bg-slate-50 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3"
                                value="smtp.mailtrap.io">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[13px] font-semibold text-slate-700 mb-1">SMTP Port</label>
                                <input type="text"
                                    class="w-full rounded-lg border-slate-200 bg-slate-50 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3"
                                    value="2525">
                            </div>
                            <div>
                                <label class="block text-[13px] font-semibold text-slate-700 mb-1">Enkripsi</label>
                                <select
                                    class="w-full rounded-lg border-slate-200 bg-slate-50 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3">
                                    <option>TLS</option>
                                    <option>SSL</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-slate-700 mb-1">Email Pengirim
                                (From)</label>
                            <input type="email"
                                class="w-full rounded-lg border-slate-200 bg-slate-50 focus:ring-indigo-500 focus:border-indigo-500 text-[13px] py-2 px-3"
                                value="noreply@ppid.example.com">
                        </div>
                        <div class="pt-2">
                            <button type="button"
                                class="px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg text-[13px] hover:bg-indigo-700 transition">Update
                                SMTP</button>
                            <button type="button"
                                class="ml-2 px-5 py-2.5 bg-slate-200 text-slate-700 font-semibold rounded-lg text-[13px] hover:bg-slate-300 transition">Test
                                Kirim</button>
                        </div>
                    </form>
                </div>

                <!-- Backup Database -->
                <div x-show="tab === 'backup'" x-cloak x-transition.opacity.duration.200ms>
                    <h2 class="text-xl font-bold text-slate-800 brand-font mb-6 border-b border-slate-100 pb-3">Backup &
                        Restore System</h2>
                    <div class="flex flex-col gap-6 max-w-xl">
                        <div
                            class="p-6 border border-slate-200 rounded-2xl bg-slate-50 flex items-center justify-between">
                            <div>
                                <h4 class="text-[13px] font-bold text-slate-800">Manual Backup</h4>
                                <p class="text-xs text-slate-500 mt-1">Unduh keseluruhan SQL file dari database aplikasi
                                    saat ini.</p>
                            </div>
                            <button type="button"
                                class="px-4 py-2 bg-slate-800 text-white font-semibold rounded-lg text-xs hover:bg-slate-700 transition shadow-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download SQL
                            </button>
                        </div>

                        <div>
                            <h4 class="text-[13px] font-bold text-slate-800 mb-3">Daftar Backup Terakhir</h4>
                            <table class="w-full text-left text-[11px] text-slate-600">
                                <thead>
                                    <tr class="uppercase text-slate-400 border-b border-slate-200">
                                        <th class="py-2">Nama File</th>
                                        <th class="py-2">Ukuran</th>
                                        <th class="py-2 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-slate-100">
                                        <td class="py-3 font-semibold text-slate-700">backup-2026-08-10.sql</td>
                                        <td class="py-3">1.2 MB</td>
                                        <td class="py-3 text-right">
                                            <a href="#" class="text-indigo-600 hover:underline">Download</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Log Aktivitas -->
                <div x-show="tab === 'log'" x-cloak x-transition.opacity.duration.200ms>
                    <h2 class="text-xl font-bold text-slate-800 brand-font mb-6 border-b border-slate-100 pb-3">Log
                        Aktivitas</h2>
                    <div class="overflow-hidden border border-slate-200 rounded-xl">
                        <table class="w-full text-left text-[11px] text-slate-600">
                            <thead class="bg-slate-50">
                                <tr class="uppercase text-slate-500 font-semibold border-b border-slate-200">
                                    <th class="py-3 px-4">Waktu</th>
                                    <th class="py-3 px-4">Pengguna</th>
                                    <th class="py-3 px-4">Aktivitas</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                <tr>
                                    <td class="py-3 px-4 whitespace-nowrap">Hari ini, 09:30</td>
                                    <td class="py-3 px-4 font-semibold text-slate-800">Atasan PPID</td>
                                    <td class="py-3 px-4"><span
                                            class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded mr-2">Login</span>
                                        Berhasil masuk ke dalam sistem</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 whitespace-nowrap">Kemarin, 14:15</td>
                                    <td class="py-3 px-4 font-semibold text-slate-800">Admin PPID</td>
                                    <td class="py-3 px-4"><span
                                            class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded mr-2">Update</span>
                                        Mengubah status permohonan #112</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 whitespace-nowrap">10 Ags 2026, 11:00</td>
                                    <td class="py-3 px-4 font-semibold text-slate-800">System</td>
                                    <td class="py-3 px-4"><span
                                            class="px-2 py-0.5 bg-slate-100 text-slate-700 rounded mr-2">Cron</span>
                                        Auto backup database berhasil dilakukan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
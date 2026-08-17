<x-app-layout>
    <div id="userManagementApp" class="p-6 sm:p-8 max-w-7xl mx-auto space-y-6" x-data="userManagement()">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 brand-font">Manajemen Pengguna</h1>
                <p class="text-slate-500 text-sm mt-1">Daftar akun pemohon dan staf manajemen informasi.</p>
            </div>
            <button type="button" @click="showAddModal = true" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-xl shadow-sm hover:bg-indigo-700 hover:shadow-indigo-200 transition-all focus:ring-2 focus:ring-indigo-100 flex items-center gap-2 outline-none relative z-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Pengguna
            </button>
        </div>

        <!-- Custom Search Bar -->
        <div class="flex gap-3 max-w-md">
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0" />
                </svg>
                <input type="text" id="customSearchInput" placeholder="Cari nama atau email..."
                    class="w-full pl-9 pr-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all" />
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden p-4">
            <div class="overflow-x-auto">
                <table id="usersTable" class="w-full text-sm text-left whitespace-nowrap">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 font-semibold text-slate-600 text-xs uppercase tracking-wide">#</th>
                            <th class="px-6 py-4 font-semibold text-slate-600 text-xs uppercase tracking-wide">Pemohon
                            </th>
                            <th class="px-6 py-4 font-semibold text-slate-600 text-xs uppercase tracking-wide">Tipe</th>
                            <th class="px-6 py-4 font-semibold text-slate-600 text-xs uppercase tracking-wide">No.
                                Identitas</th>
                            <th class="px-6 py-4 font-semibold text-slate-600 text-xs uppercase tracking-wide">Telepon
                            </th>
                            <th class="px-6 py-4 font-semibold text-slate-600 text-xs uppercase tracking-wide">Pekerjaan
                            </th>
                            <th class="px-6 py-4 font-semibold text-slate-600 text-xs uppercase tracking-wide">Terdaftar
                            </th>
                            <th
                                class="text-right px-6 py-4 font-semibold text-slate-600 text-xs uppercase tracking-wide">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Detail User Modal -->
        <div x-show="showDetail" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">

                <div x-show="showDetail" @click="showDetail = false" x-transition.opacity
                    class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-sm"></div>

                <div x-show="showDetail" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-3xl overflow-hidden text-left align-middle transition-all transform bg-white rounded-2xl shadow-xl z-50">

                    <!-- Modal Header -->
                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 brand-font">Detail Profil Pemohon</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Tinjau kelengkapan identitas dan domisili.</p>
                        </div>
                        <button @click="showDetail = false"
                            class="text-slate-400 hover:text-slate-600 transition-colors p-1 rounded-lg hover:bg-slate-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 md:p-8">
                        <template x-if="activeUser">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Left Col -->
                                <div class="space-y-5">
                                    <div class="bg-indigo-50 rounded-xl p-4 flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white text-indigo-600 rounded-full flex items-center justify-center font-bold text-xl uppercase shadow-sm"
                                            x-text="activeUser.name.substring(0,2)"></div>
                                        <div>
                                            <div class="font-bold text-slate-800" x-text="activeUser.name"></div>
                                            <div class="text-sm text-slate-500" x-text="activeUser.email"></div>
                                        </div>
                                    </div>

                                    <div>
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Tipe
                                            Pemohon</span>
                                        <div class="text-sm font-semibold text-slate-700"
                                            x-text="activeUser.user_type === 'lembaga' ? 'Lembaga / Instansi' : (activeUser.user_type === 'organisasi' ? 'Organisasi Bukan Lembaga' : 'Perorangan')">
                                        </div>
                                    </div>
                                    <hr class="border-slate-100">
                                    <div>
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">NIK
                                            / No. Identitas</span>
                                        <div class="text-sm font-medium text-slate-700 font-mono"
                                            x-text="activeUser.identification_number"></div>
                                    </div>
                                    <div>
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Pekerjaan</span>
                                        <div class="text-sm font-medium text-slate-700" x-text="activeUser.job_title">
                                        </div>
                                    </div>
                                    <div>
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Kontak
                                            Telepon/Wa</span>
                                        <div class="text-sm font-medium text-slate-700" x-text="activeUser.phone"></div>
                                    </div>
                                </div>

                                <!-- Right Col -->
                                <div class="space-y-5">
                                    <h4
                                        class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-2 brand-font">
                                        Informasi Domisili</h4>
                                    <div>
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Alamat
                                            Lengkap</span>
                                        <div class="text-sm font-medium text-slate-700 leading-relaxed"
                                            x-text="activeUser.address"></div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Provinsi</span>
                                            <div class="text-sm font-medium text-slate-700"
                                                x-text="activeUser.province">
                                            </div>
                                        </div>
                                        <div>
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Kabupaten/Kota</span>
                                            <div class="text-sm font-medium text-slate-700" x-text="activeUser.city">
                                            </div>
                                        </div>
                                        <div>
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Kecamatan</span>
                                            <div class="text-sm font-medium text-slate-700"
                                                x-text="activeUser.district">
                                            </div>
                                        </div>
                                        <div>
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Kel/Desa</span>
                                            <div class="text-sm font-medium text-slate-700" x-text="activeUser.village">
                                            </div>
                                        </div>
                                        <div>
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Kode
                                                Pos</span>
                                            <div class="text-sm font-medium text-slate-700"
                                                x-text="activeUser.postal_code">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-4 border-t border-slate-100">
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-2">Lampiran
                                            File Identitas</span>
                                        <template x-if="activeUser.identity_file_path">
                                            <div class="space-y-3">
                                                <!-- KTP 1 -->
                                                <div class="flex items-center gap-3">
                                                    <a :href="activeUser.identity_file_path" target="_blank"
                                                        class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-medium hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                            </path>
                                                        </svg>
                                                        Dokumen Utama
                                                    </a>
                                                    <span class="text-[11px] text-slate-400"
                                                        x-text="activeUser.identity_file_type === 'pdf' ? 'Format: PDF' : 'Format: Gambar'"></span>
                                                </div>

                                                <!-- KTP 2 -->
                                                <template x-if="activeUser.identity_file_path_2">
                                                    <div class="flex items-center gap-3">
                                                        <a :href="activeUser.identity_file_path_2" target="_blank"
                                                            class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-medium hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                </path>
                                                            </svg>
                                                            KTP Anggota 1
                                                        </a>
                                                    </div>
                                                </template>

                                                <!-- KTP 3 -->
                                                <template x-if="activeUser.identity_file_path_3">
                                                    <div class="flex items-center gap-3">
                                                        <a :href="activeUser.identity_file_path_3" target="_blank"
                                                            class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-medium hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                </path>
                                                            </svg> KTP Anggota 2
                                                        </a>
                                                    </div>
                                                </template>

                                                <!-- KTP 4 -->
                                                <template x-if="activeUser.identity_file_path_4">
                                                    <div class="flex items-center gap-3">
                                                        <a :href="activeUser.identity_file_path_4" target="_blank"
                                                            class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-medium hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                </path>
                                                            </svg> KTP Anggota 3
                                                        </a>
                                                    </div>
                                                </template>

                                                <!-- KTP 5 -->
                                                <template x-if="activeUser.identity_file_path_5">
                                                    <div class="flex items-center gap-3">
                                                        <a :href="activeUser.identity_file_path_5" target="_blank"
                                                            class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-medium hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                </path>
                                                            </svg> KTP Anggota 4
                                                        </a>
                                                    </div>
                                                </template>

                                            </div>
                                        </template>
                                        <template x-if="!activeUser.identity_file_path">
                                            <div class="text-xs text-rose-500 font-semibold flex items-center gap-1.5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                    </path>
                                                </svg>
                                                Pemohon belum melengkapi identitas!
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create User Modal -->
        <div x-show="showAddModal" style="display: none;" class="relative z-[100]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="showAddModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
            
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div x-show="showAddModal" @click.away="showAddModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-slate-100">
                            <div class="flex items-center justify-between mb-5">
                                <h3 class="text-lg font-bold text-slate-800 brand-font" id="modal-title">Tambah Akun Pengguna</h3>
                                <button type="button" @click="showAddModal = false" class="text-slate-400 hover:bg-slate-100 hover:text-slate-600 rounded-lg p-1.5 transition-colors">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>

                            <form action="{{ route('admin.users.store') }}" method="POST" id="createUserForm">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                                        <input type="text" name="name" required class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm px-4 py-2.5 shadow-sm" placeholder="Masukkan nama pengguna">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                                        <input type="email" name="email" required class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm px-4 py-2.5 shadow-sm" placeholder="email@contoh.com">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                                        <input type="password" name="password" required minlength="8" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm px-4 py-2.5 shadow-sm" placeholder="Minimal 8 karakter">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">Peran Akses (Role)</label>
                                        <select name="role" required class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm px-4 py-2.5 shadow-sm">
                                            <option value="user">User Biasa / Pemohon</option>
                                            <option value="kurikulum">Kurikulum</option>
                                            <option value="kesiswaan">Kesiswaan</option>
                                            <option value="sarpras">Sarpras</option>
                                            <option value="humas">Humas</option>
                                            <option value="tata_usaha">Tata Usaha</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="bg-slate-50 px-6 py-4 flex flex-col-reverse sm:flex-row justify-end gap-3">
                            <button type="button" @click="showAddModal = false"
                                class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-semibold hover:bg-slate-50 transition-colors">
                                Batal
                            </button>
                            <button type="submit" form="createUserForm"
                                class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">
                                Simpan Akun
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- SweetAlert2 Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Modernize Datatables Pagination & LengthMenu */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.3rem 0.8rem !important;
            margin: 0 0.2rem;
            border-radius: 0.5rem !important;
            border: 1px solid #e2e8f0 !important;
            background: white !important;
            font-size: 0.875rem;
            font-weight: 500;
            color: #64748b !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: #334155 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4f46e5 !important;
            color: white !important;
            border-color: #4f46e5 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.next,
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous {
            background: white !important;
        }

        .dataTables_wrapper .dataTables_filter {
            display: none;
            /* Disembunyikan karena sudah ada Custom Search */
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            padding: 0.25rem 1.5rem 0.25rem 0.5rem;
            outline: none;
            font-size: 0.875rem;
            background-color: #f8fafc;
        }

        .dataTables_wrapper .dataTables_info {
            font-size: 0.875rem;
            color: #64748b;
            padding-top: 1rem;
        }

        .dataTables_wrapper .dataTables_length {
            margin-bottom: 1rem;
            color: #64748b;
            font-size: 0.875rem;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        function initUsersTable() {
            var csrfToken = '{{ csrf_token() }}';
            var destroyUrl = '{{ route("admin.users.destroy", ":id") }}';

            if ($.fn.DataTable.isDataTable('#usersTable')) {
                $('#usersTable').DataTable().destroy();
            }

            var table = $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.users.data") }}',
                dom: '<"flex flex-col md:flex-row justify-between items-center"<"mb-4 md:mb-0"l>>rt<"flex flex-col md:flex-row justify-between items-center mt-4"ip>',
                language: {
                    lengthMenu: "Tampilkan _MENU_ baris",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "→",
                        previous: "←"
                    },
                    processing: '<div class="text-indigo-600 font-bold my-4">Memuat data...</div>'
                }, columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'px-6 py-4 text-slate-400 text-xs' },
                    {
                        data: 'name', name: 'name', render: function (data, type, row) {
                            var initial = data.charAt(0).toUpperCase();
                            return `<div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm flex-shrink-0 uppercase select-none">
                                        ${initial}
                                    </div>
                                    <div class="whitespace-normal">
                                        <p class="font-semibold text-slate-800">${data}</p>
                                        <p class="text-slate-400 text-xs">${row.email}</p>
                                    </div>
                                </div>`;
                        }, className: 'px-6 py-4'
                    },
                    {
                        data: 'user_type', name: 'user_type', render: function (data) {
                            if (data === 'lembaga') return `<span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">Lembaga</span>`;
                            if (data === 'organisasi') return `<span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">Organisasi</span>`;
                            return `<span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">Perorangan</span>`;
                        }, className: 'px-6 py-4'
                    },
                    { data: 'identification_number', name: 'identification_number', render: data => data ? data : '-', className: 'px-6 py-4 text-slate-600 font-mono text-xs' },
                    { data: 'phone', name: 'phone', render: data => data ? data : '-', className: 'px-6 py-4 text-slate-600 text-xs' },
                    { data: 'job_title', name: 'job_title', render: data => data ? data : '-', className: 'px-6 py-4 text-slate-600 text-xs' },
                    { data: 'created_at', name: 'created_at', className: 'px-6 py-4 text-slate-400 text-xs whitespace-nowrap' },
                    {
                        data: 'action', name: 'action', orderable: false, searchable: false, render: function (data, type, row) {
                            var _destroyUtl = destroyUrl.replace(':id', row.id);

                            // Save user info to global object mapped by ID to avoid escaping issues
                            window.usersData = window.usersData || {};
                            window.usersData[row.id] = row.info;

                            return `
                            <button type="button" onclick="showUserDetail(${row.id})"
                                class="inline-flex items-center gap-1 text-xs text-indigo-500 hover:text-indigo-700 hover:bg-indigo-50 px-2.5 py-1.5 rounded-lg transition-colors font-medium mr-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                Detail
                            </button>
                            <form method="POST" action="${_destroyUtl}" onsubmit="return confirmDelete(event, this)" class="inline">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="inline-flex items-center gap-1 text-xs text-red-500 hover:text-red-700 hover:bg-red-50 px-2.5 py-1.5 rounded-lg transition-colors font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    Hapus
                                </button>
                            </form>
                        `;
                        }, className: 'px-6 py-4 text-right whitespace-nowrap'
                    }
                ]
            });

            // Bind Custom Search Input to DataTable Search
            $('#customSearchInput').off('keyup').on('keyup', function () {
                table.search(this.value).draw();
            });
        }

        // Execute immediately
        initUsersTable();

        function showUserDetail(userId) {
            if (window.usersData && window.usersData[userId]) {
                document.getElementById('userManagementApp').dispatchEvent(
                    new CustomEvent('open-modal', { detail: window.usersData[userId] })
                );
            } else {
                console.error("Data pengguna tidak ditemukan di memori JS.");
            }
        }

        // Alpine Component State Manager
        function userManagement() {
            return {
                showDetail: false,
                showAddModal: false,
                activeUser: null,
                init() {
                    // Listen from global datatables row element
                    this.$el.addEventListener('open-modal', (e) => {
                        this.activeUser = e.detail;
                        this.showDetail = true;
                    });
                }
            }
        }

        function confirmDelete(e, formParam) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus pengguna?',
                text: 'Semua informasi milik pengguna ini akan ikut terhapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-2xl border border-slate-100 shadow-xl !font-sans'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    formParam.submit();
                }
            });
            return false;
        }
    </script>
</x-app-layout>
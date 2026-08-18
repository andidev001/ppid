<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-800 brand-font">Kelola Halaman Profil</h1>
                <p class="text-slate-500 mt-1">Ubah konten dinamis pada menu Profil Umum, berlaku secara langsung pada
                    situs publik.</p>
            </div>
            <a href="{{ route('home') }}" target="_blank"
                class="px-4 py-2 bg-white text-indigo-600 border border-indigo-200 rounded-lg shadow-sm hover:bg-indigo-50 font-medium text-sm transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                Lihat Web
            </a>
        </div>

        <form action="{{ route('admin.pages.update') }}" method="POST" data-turbo="false"
            enctype="multipart/form-data" onsubmit="tinymce.triggerSave();">
            @csrf

            <div x-data="{ activeTab: localStorage.getItem('pagesActiveTab') || 'ppid' }"
                x-init="$watch('activeTab', value => localStorage.setItem('pagesActiveTab', value))"
                class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col md:flex-row h-auto min-h-[600px]">

                <!-- Sidebar Tabs -->
                <div
                    class="w-full md:w-64 bg-slate-50 border-b md:border-b-0 md:border-r border-slate-200 p-4 shrink-0 overflow-y-auto">
                    <nav class="flex flex-row md:flex-col gap-1 overflow-x-auto md:overflow-x-visible pb-2 md:pb-0">

                        <button type="button" @click="activeTab = 'ppid'"
                            :class="activeTab === 'ppid' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Profil PPID
                        </button>
                        <button type="button" @click="activeTab = 'pimpinan'"
                            :class="activeTab === 'pimpinan' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Profil Pimpinan
                        </button>
                        <button type="button" @click="activeTab = 'struktur'"
                            :class="activeTab === 'struktur' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Struktur Organisasi
                        </button>

                        <button type="button" @click="activeTab = 'maklumat'"
                            :class="activeTab === 'maklumat' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Maklumat Pelayanan
                        </button>
                        <button type="button" @click="activeTab = 'dasar_hukum'"
                            :class="activeTab === 'dasar_hukum' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Dasar Hukum
                        </button>
                        <button type="button" @click="activeTab = 'tugas_fungsi'"
                            :class="activeTab === 'tugas_fungsi' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Tugas dan Fungsi
                        </button>
                        <button type="button" @click="activeTab = 'visi_misi'"
                            :class="activeTab === 'visi_misi' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Visi Misi
                        </button>

                        <div class="mt-3 pt-3 border-t border-slate-200">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1 px-1">Standar
                                Pelayanan</p>
                        </div>
                        <button type="button" @click="activeTab = 'sop'"
                            :class="activeTab === 'sop' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            SOP Layanan
                        </button>
                        <button type="button" @click="activeTab = 'prosedur_pelayanan'"
                            :class="activeTab === 'prosedur_pelayanan' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Prosedur Pelayanan
                        </button>
                        <button type="button" @click="activeTab = 'prosedur_keberatan'"
                            :class="activeTab === 'prosedur_keberatan' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Prosedur Keberatan
                        </button>
                        <button type="button" @click="activeTab = 'prosedur_sengketa'"
                            :class="activeTab === 'prosedur_sengketa' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Prosedur Sengketa
                        </button>
                        <button type="button" @click="activeTab = 'penanganan_sengketa'"
                            :class="activeTab === 'penanganan_sengketa' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Penanganan Sengketa
                        </button>
                        <button type="button" @click="activeTab = 'kanal_layanan'"
                            :class="activeTab === 'kanal_layanan' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Kanal Layanan
                        </button>
                        <button type="button" @click="activeTab = 'waktu_biaya'"
                            :class="activeTab === 'waktu_biaya' ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'"
                            class="flex flex-col md:flex-row text-left px-3 py-2.5 rounded-lg font-medium text-sm transition-colors whitespace-nowrap md:whitespace-normal">
                            Waktu &amp; Biaya
                        </button>
                    </nav>
                </div>

                <!-- Main Content Panel -->
                <div class="flex-1 p-6 overflow-hidden flex flex-col">



                    <div class="flex-1 flex flex-col h-full w-full"
                        x-bind:style="activeTab === 'ppid' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Profil PPID</label>
                        <div class="flex-1 relative">
                            <textarea name="page_profil_ppid"
                                class="tinymce">{!! $settings['page_profil_ppid'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full"
                        x-bind:style="activeTab === 'pimpinan' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Profil Pimpinan</label>
                        <div class="flex-1 relative">
                            <textarea name="page_profil_pimpinan"
                                class="tinymce">{!! $settings['page_profil_pimpinan'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full"
                        x-bind:style="activeTab === 'struktur' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Struktur
                            Organisasi</label>
                        <div class="flex-1 relative">
                            <textarea name="page_struktur"
                                class="tinymce">{!! $settings['page_struktur'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full overflow-y-auto"
                        x-bind:style="activeTab === 'sop' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten SOP Layanan</label>
                        <div class="relative w-full mb-6">
                            <textarea name="page_sop" class="tinymce">{!! $settings['page_sop'] ?? '' !!}</textarea>
                        </div>
                        
                        <div class="mt-6 border-t border-slate-200 pt-6">
                            <h3 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                Lampiran File SOP (Maksimal 7 File)
                            </h3>
                            <p class="text-xs text-slate-500 mb-6">Anda dapat menambahkan hingga 7 file PDF/Dokumen sebagai lampiran pendukung SOP Layanan.</p>

                            @php
                                $sopAttachments = json_decode($settings['sop_attachments'] ?? '[]', true);
                            @endphp

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @for($i = 1; $i <= 7; $i++)
                                    @php $file = $sopAttachments[$i] ?? null; @endphp
                                    <div class="p-4 rounded-xl border {{ $file ? 'border-indigo-200 bg-indigo-50/30' : 'border-slate-200 bg-slate-50' }} flex flex-col gap-3">
                                        <div class="font-bold text-sm text-slate-700 border-b border-slate-200 pb-2">File {{ $i }}</div>
                                        
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1">Keterangan File</label>
                                            <input type="text" name="sop_file_titles[{{ $i }}]" value="{{ $file['title'] ?? '' }}" placeholder="Contoh: SOP Permohonan" class="w-full text-sm border-slate-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                        </div>

                                        <div>
                                            <label class="block text-xs font-semibold text-slate-600 mb-1">Upload File (PDF/Docx)</label>
                                            <input type="file" name="sop_files[{{ $i }}]" accept=".pdf,.doc,.docx" class="w-full text-sm text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200 transition-colors">
                                        </div>

                                        @if($file)
                                        <div class="mt-2 text-xs flex items-center justify-between bg-white px-3 py-2 rounded-lg border border-indigo-100">
                                            <a href="{{ asset('storage/' . $file['path']) }}" target="_blank" class="text-indigo-600 hover:underline flex items-center gap-1 font-medium truncate max-w-[150px]">
                                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                Lihat File
                                            </a>
                                            <label class="inline-flex items-center gap-1.5 text-rose-500 cursor-pointer hover:text-rose-600">
                                                <input type="checkbox" name="remove_sop_files[{{ $i }}]" value="1" class="rounded text-rose-500 border-rose-300 focus:ring-rose-500 w-3.5 h-3.5">
                                                <span class="font-medium">Hapus</span>
                                            </label>
                                        </div>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full"
                        x-bind:style="activeTab === 'maklumat' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Maklumat Pelayanan</label>
                        <div class="flex-1 relative">
                            <textarea name="page_maklumat"
                                class="tinymce">{!! $settings['page_maklumat'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full"
                        x-bind:style="activeTab === 'dasar_hukum' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Dasar Hukum</label>
                        <div class="flex-1 relative">
                            <textarea name="page_dasar_hukum"
                                class="tinymce">{!! $settings['page_dasar_hukum'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full"
                        x-bind:style="activeTab === 'tugas_fungsi' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Tugas dan Fungsi</label>
                        <div class="flex-1 relative">
                            <textarea name="page_tugas_fungsi"
                                class="tinymce">{!! $settings['page_tugas_fungsi'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full"
                        x-bind:style="activeTab === 'visi_misi' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Visi Misi</label>
                        <div class="flex-1 relative">
                            <textarea name="page_visi_misi"
                                class="tinymce">{!! $settings['page_visi_misi'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full"
                        x-bind:style="activeTab === 'prosedur_pelayanan' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Prosedur Pelayanan
                            Publik</label>
                        <div class="flex-1 relative">
                            <textarea name="page_prosedur_pelayanan"
                                class="tinymce">{!! $settings['page_prosedur_pelayanan'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full"
                        x-bind:style="activeTab === 'prosedur_keberatan' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Prosedur Pengajuan
                            Keberatan</label>
                        <div class="flex-1 relative">
                            <textarea name="page_prosedur_keberatan"
                                class="tinymce">{!! $settings['page_prosedur_keberatan'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full"
                        x-bind:style="activeTab === 'prosedur_sengketa' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Prosedur Permohonan
                            Sengketa</label>
                        <div class="flex-1 relative">
                            <textarea name="page_prosedur_sengketa"
                                class="tinymce">{!! $settings['page_prosedur_sengketa'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full"
                        x-bind:style="activeTab === 'penanganan_sengketa' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Prosedur Penanganan
                            Sengketa</label>
                        <div class="flex-1 relative">
                            <textarea name="page_penanganan_sengketa"
                                class="tinymce">{!! $settings['page_penanganan_sengketa'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full"
                        x-bind:style="activeTab === 'kanal_layanan' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Kanal Layanan PPID</label>
                        <div class="flex-1 relative">
                            <textarea name="page_kanal_layanan"
                                class="tinymce">{!! $settings['page_kanal_layanan'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="flex-1 flex flex-col h-full w-full gap-6"
                        x-bind:style="activeTab === 'waktu_biaya' ? 'position: relative; display: flex;' : 'position: absolute; transform: translateX(-9999px); visibility: hidden; opacity: 0;'">
                        
                        <div class="flex-1 relative flex flex-col">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Waktu Pelayanan</label>
                            <div class="flex-1 min-h-[300px]">
                                <textarea name="page_waktu" class="tinymce">{!! $settings['page_waktu'] ?? $settings['page_waktu_biaya'] ?? '' !!}</textarea>
                            </div>
                        </div>

                        <div class="flex-1 relative flex flex-col">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Konten Biaya Pelayanan</label>
                            <div class="flex-1 min-h-[300px]">
                                <textarea name="page_biaya" class="tinymce">{!! $settings['page_biaya'] ?? '' !!}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Note on visual update -->
                    <div class="mt-4 pt-4 border-t border-slate-100 flex justify-end items-center">
                        <button type="submit"
                            class="px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition shadow-md shadow-indigo-200">
                            Simpan Semua Perubahan
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <!-- Include TinyMCE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        /* Sembunyikan notifikasi API Key dan branding TinyMCE */
        .tox-notifications-container,
        .tox-statusbar__branding,
        .tox-notification,
        .tox-promotion,
        .tox-promotion-link,
        div[role="alert"] {
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
        }
    </style>
    <script>
        var editorImageUploadUrl = "{{ route('admin.editor.upload-image') }}";
        var editorCsrfToken = "{{ csrf_token() }}";

        function initTinyMCE() {
            if (typeof tinymce === 'undefined') return;
            // Remove existing instances first so Turbo can re-init cleanly
            tinymce.remove('textarea.tinymce');
            tinymce.init({
                selector: 'textarea.tinymce',
                height: 500,
                menubar: 'edit view insert format table tools',
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic underline strikethrough | forecolor backcolor | ' +
                    'alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | ' +
                    'table image link media | removeformat | code fullscreen',

                // ─── Table settings ───────────────────────────────────────────
                table_toolbar: 'tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
                table_appearance_options: true,
                table_advtab: true,
                table_cell_advtab: true,
                table_row_advtab: true,

                // ─── Image upload settings ────────────────────────────────────
                automatic_uploads: true,
                images_upload_url: editorImageUploadUrl,
                // Custom handler to add CSRF token header (Laravel requirement)
                images_upload_handler: function (blobInfo, progress) {
                    return new Promise(function (resolve, reject) {
                        var formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        formData.append('_token', editorCsrfToken);

                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', editorImageUploadUrl, true);

                        xhr.upload.onprogress = function (e) {
                            if (e.lengthComputable) {
                                progress(e.loaded / e.total * 100);
                            }
                        };

                        xhr.onload = function () {
                            if (xhr.status === 403) {
                                reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                                return;
                            }
                            if (xhr.status < 200 || xhr.status >= 300) {
                                reject('HTTP Error: ' + xhr.status);
                                return;
                            }
                            var json = JSON.parse(xhr.responseText);
                            if (!json || typeof json.location !== 'string') {
                                reject('Invalid JSON: ' + xhr.responseText);
                                return;
                            }
                            resolve(json.location);
                        };

                        xhr.onerror = function () {
                            reject('Upload failed. Code: ' + xhr.status);
                        };

                        xhr.send(formData);
                    });
                },
                // Prevent pasted base64 images from being stored inline
                images_dataimg_filter: function (img) {
                    return img.hasAttribute('internal-blob');
                },

                content_style: 'body { font-family:Inter,Helvetica,Arial,sans-serif; font-size:16px; color:#334155; } h1, h2, h3, h4, h5, h6 { font-family: Outfit, sans-serif; color:#0f172a; } table { border-collapse: collapse; width: 100%; } table th, table td { border: 1px solid #cbd5e1; padding: 8px 12px; } table th { background: #f1f5f9; font-weight: 600; }'
            });
        }

        // turbo:load fires on every Turbo navigation AND on first page load
        document.addEventListener('turbo:load', initTinyMCE);
    </script>
</x-app-layout>
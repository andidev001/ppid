<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-slate-800 brand-font">Konten Beranda (Galeri & Tautan)</h1>
            <p class="text-slate-500 mt-1">Kelola daftar tautan wilayah dan galeri video yang akan tampil di Halaman Utama.</p>
        </div>
    <div class="space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Kelola Link Terkait --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-slate-800 text-lg">Link Terkait</h3>
                        <p class="text-xs text-slate-500">Kelola tautan Instansi terkait</p>
                    </div>
                    <button onclick="document.getElementById('modalAddLink').classList.remove('hidden')"
                        class="px-3 py-1.5 bg-indigo-600 font-medium text-white text-sm rounded-lg hover:bg-indigo-700 transition">
                        + Tambah Tautan
                    </button>
                </div>

                <div class="p-0">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-slate-200 text-xs text-slate-500">
                                <th class="px-4 py-3 font-semibold w-12">Logo</th>
                                <th class="px-4 py-3 font-semibold">Tautan</th>
                                <th class="px-4 py-3 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($links as $link)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div
                                            class="w-10 h-10 rounded shadow-sm overflow-hidden bg-slate-100 flex items-center justify-center p-1 border border-slate-200">
                                            @if($link->logo_path)
                                                <img src="{{ asset('storage/' . $link->logo_path) }}"
                                                    class="w-full h-full object-contain">
                                            @else
                                                <span class="text-xs text-slate-400">N/A</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-bold text-slate-800 text-sm">{{ $link->title }}</p>
                                        <a href="{{ $link->url }}" target="_blank"
                                            class="text-xs text-blue-500 hover:underline flex items-center gap-1 mt-0.5"
                                            title="{{ $link->url }}">
                                            {{ Str::limit($link->url, 30) }}
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                </path>
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <button type="button" onclick="editLink({{ $link->toJson() }})" class="text-indigo-500 hover:bg-indigo-50 p-1.5 rounded-lg transition-colors mr-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    
                                    <form action="{{ route('admin.home_content.destroy_link', $link->id) }}" method="POST" class="inline-block delete-form">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this.closest('form'))" class="text-rose-500 hover:bg-rose-50 p-1.5 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-8 text-center text-slate-400 text-sm">Belum ada tautan
                                        ditambahkan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Kelola Galeri Video --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-slate-800 text-lg">Galeri Podcast/Video</h3>
                        <p class="text-xs text-slate-500">Kelola embed video YouTube</p>
                    </div>
                    <button onclick="document.getElementById('modalAddVideo').classList.remove('hidden')"
                        class="px-3 py-1.5 bg-red-600 font-medium text-white text-sm rounded-lg hover:bg-red-700 transition flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                        </svg>
                        Tambah Video
                    </button>
                </div>

                <div class="p-0">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white border-b border-slate-200 text-xs text-slate-500">
                                <th class="px-4 py-3 font-semibold w-24">Thumbnail</th>
                                <th class="px-4 py-3 font-semibold">Video</th>
                                <th class="px-4 py-3 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($videos as $video)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div
                                            class="w-20 rounded shadow-sm border border-slate-200 aspect-video bg-slate-900 overflow-hidden flex items-center justify-center relative">
                                            @if($video->youtube_id)
                                                <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/mqdefault.jpg"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-5 h-5 text-slate-500" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z" />
                                                </svg>
                                            @endif
                                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                                <div
                                                    class="w-5 h-5 bg-red-600/90 rounded text-white flex items-center justify-center">
                                                    <svg class="w-3 h-3 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M8 5v14l11-7z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="font-bold text-slate-800 text-sm leading-tight">{{ $video->title }}</p>
                                        <a href="{{ $video->youtube_url }}" target="_blank"
                                            class="text-[11px] text-blue-500 hover:underline inline-flex mt-1">Lihat Video di
                                            Youtube</a>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <button type="button" onclick="editVideo({{ $video->toJson() }})" class="text-indigo-500 hover:bg-indigo-50 p-1.5 rounded-lg transition-colors mr-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    
                                    <form action="{{ route('admin.home_content.destroy_video', $video->id) }}" method="POST" class="inline-block delete-form">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this.closest('form'))" class="text-rose-500 hover:bg-rose-50 p-1.5 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-8 text-center text-slate-400 text-sm">Belum ada video galeri
                                        tersimpan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH LINK --}}
    <div id="modalAddLink"
        class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl">
            <form action="{{ route('admin.home_content.store_link') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800 text-lg">Tambah Link Terkait</h3>
                    <button type="button" onclick="document.getElementById('modalAddLink').classList.add('hidden')"
                        class="text-slate-400 hover:text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nama / Judul Tautan <span
                                class="text-rose-500">*</span></label>
                        <input type="text" name="title"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            required placeholder="Contoh: Jakarta Pusat">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">URL / Link Lengkap <span
                                class="text-rose-500">*</span></label>
                        <input type="url" name="url"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            required placeholder="https://pusat.jakarta.go.id">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Logo Instansi (Opsional)</label>
                        <input type="file" name="logo"
                            class="w-full rounded-xl border border-slate-300 px-4 py-1.5 text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200"
                            accept="image/*">
                    </div>
                </div>
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 rounded-b-2xl flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modalAddLink').classList.add('hidden')"
                        class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-bold shadow-md shadow-indigo-200 hover:bg-indigo-700">Simpan
                        Tautan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL TAMBAH VIDEO --}}
    <div id="modalAddVideo"
        class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl">
            <form action="{{ route('admin.home_content.store_video') }}" method="POST">
                @csrf
                <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800 text-lg flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                        </svg>
                        Tambah Video
                    </h3>
                    <button type="button" onclick="document.getElementById('modalAddVideo').classList.add('hidden')"
                        class="text-slate-400 hover:text-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Judul Video Singkat <span
                                class="text-rose-500">*</span></label>
                        <input type="text" name="title"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            required placeholder="Contoh: Podcast OKE SIP Jilid 25">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Link URL YouTube <span
                                class="text-rose-500">*</span></label>
                        <input type="url" name="youtube_url"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500"
                            required placeholder="https://www.youtube.com/watch?v=...">
                        <p class="text-[11px] text-slate-500 mt-1">Thumbnail gambar akan diambil otomatis dari YouTube.</p>
                    </div>
                </div>
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 rounded-b-2xl flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modalAddVideo').classList.add('hidden')"
                        class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-bold shadow-md shadow-red-200 hover:bg-red-700">Simpan
                        Video</button>
                </div>
            </form>
        </div>
    </div>

{{-- MODAL EDIT LINK --}}
<div id="modalEditLink" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl">
        <form id="formEditLink" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50 rounded-t-2xl">
                <h3 class="font-bold text-slate-800 text-lg">Edit Link Terkait</h3>
                <button type="button" onclick="document.getElementById('modalEditLink').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nama / Judul Tautan <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="edit_link_title" class="w-full rounded-xl border border-slate-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">URL / Link Lengkap <span class="text-rose-500">*</span></label>
                    <input type="url" name="url" id="edit_link_url" class="w-full rounded-xl border border-slate-300 px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Update Logo Instansi (Opsional)</label>
                    <input type="file" name="logo" class="w-full rounded-xl border border-slate-300 px-4 py-1.5 text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200" accept="image/*">
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 rounded-b-2xl flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('modalEditLink').classList.add('hidden')" class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50">Batal</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-bold shadow-md shadow-indigo-200 hover:bg-indigo-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT VIDEO --}}
<div id="modalEditVideo" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl">
        <form id="formEditVideo" method="POST">
            @csrf @method('PUT')
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50 rounded-t-2xl">
                <h3 class="font-bold text-slate-800 text-lg flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                    Edit Video
                </h3>
                <button type="button" onclick="document.getElementById('modalEditVideo').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Judul Video Singkat <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="edit_video_title" class="w-full rounded-xl border border-slate-300 px-4 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Link URL YouTube <span class="text-rose-500">*</span></label>
                    <input type="url" name="youtube_url" id="edit_video_url" class="w-full rounded-xl border border-slate-300 px-4 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500" required>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 rounded-b-2xl flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('modalEditVideo').classList.add('hidden')" class="px-4 py-2 bg-white border border-slate-300 text-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-bold shadow-md shadow-red-200 hover:bg-red-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function editLink(link) {
        document.getElementById('edit_link_title').value = link.title;
        document.getElementById('edit_link_url').value = link.url;
        document.getElementById('formEditLink').action = '/admin/home-content/link/' + link.id;
        document.getElementById('modalEditLink').classList.remove('hidden');
    }

    function editVideo(video) {
        document.getElementById('edit_video_title').value = video.title;
        document.getElementById('edit_video_url').value = video.youtube_url;
        document.getElementById('formEditVideo').action = '/admin/home-content/video/' + video.id;
        document.getElementById('modalEditVideo').classList.remove('hidden');
    }

    function confirmDelete(formElement) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                formElement.submit();
            }
        });
    }
</script>

    </div>
</x-app-layout>
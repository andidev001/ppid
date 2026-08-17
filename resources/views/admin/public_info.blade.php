<x-app-layout>
    <x-slot name="header">
        Manajemen {{ ucwords(str_replace('_', ' ', $category)) }}
    </x-slot>

    <div x-data="publicInfoManager()" class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-800 brand-font">Dokumen
                    {{ ucwords(str_replace('_', ' ', $category)) }}
                </h1>
                <p class="text-sm text-slate-500 mt-2">Kelola dan rapikan dokumen informasi publik yang telah diunggah.
                </p>
            </div>
            <form method="GET" action="{{ route('admin.public-info.index') }}" class="relative w-full sm:w-72">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl leading-5 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors"
                    placeholder="Cari dokumen...">
            </form>
            <button @click="openCreate()"
                class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 shrink-0">
                + Tambah Dokumen
            </button>
        </div>

        <div class="bg-white shadow-xl shadow-slate-200/40 rounded-2xl border border-slate-200 overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Judul
                                Dokumen</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Akses
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tgl Diunggah
                            </th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($informations as $index => $info)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm text-slate-500">{{ $informations->firstItem() + $index }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-slate-800">{{ $info->title }}</div>
                                    <div class="text-xs text-slate-500 mt-1 max-w-xs truncate"
                                        title="{{ $info->description }}">{{ $info->description ?: '-' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($info->visibility === 'public')
                                        <span
                                            class="px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Publik
                                            (Terbuka)</span>
                                    @else
                                        <span
                                            class="px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">Tertutup
                                            (Harus Mohon)</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">
                                    {{ $info->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <button @click="openPdf('{{ asset('storage/' . $info->file_path) }}')"
                                        class="inline-block p-2 text-indigo-500 hover:bg-indigo-50 rounded-lg transition-colors mr-1"
                                        title="Lihat PDF">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button
                                        data-info="{{ json_encode([
                                            'id' => $info->id,
                                            'title' => $info->title,
                                            'description' => $info->description,
                                            'visibility' => $info->visibility
                                        ]) }}"
                                        @click="let d = JSON.parse($event.currentTarget.dataset.info); openEdit(d.id, d.title, d.description, d.visibility)"
                                        class="inline-block p-2 text-amber-500 hover:bg-amber-50 rounded-lg transition-colors mr-1"
                                        title="Edit Dokumen">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.public-info.destroy', $info->id) }}" method="POST"
                                        class="inline-block form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition-colors"
                                            title="Hapus Dokumen">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div
                                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 text-slate-400 mb-4">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                            </path>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-semibold text-slate-800 mb-1">Tidak ada dokumen</h3>
                                    <p class="text-sm text-slate-500">Belum ada dokumen atau tidak ditemukan data yang
                                        cocok.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            {{ $informations->links() }}
        </div>

        <!-- PDF Viewer Modal -->
        <div x-show="showPdfModal"
            class="fixed inset-0 z-[100] flex items-center justify-center overflow-hidden bg-slate-900/80 backdrop-blur-sm"
            x-cloak style="display: none;">
            <div x-show="showPdfModal" @click.away="showPdfModal = false"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl h-[85vh] flex flex-col mx-4 sm:mx-auto">
                <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-slate-800 brand-font">Pratinjau Dokumen</h3>
                    <button @click="showPdfModal = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex-1 bg-slate-100 p-0 overflow-hidden rounded-b-2xl">
                    <iframe :src="currentPdfUrl" class="w-full h-full border-0"></iframe>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div x-show="showEditModal"
            class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto bg-slate-900/80 backdrop-blur-sm p-4 sm:p-0"
            x-cloak style="display: none;">
            <div x-show="showEditModal" @click.away="showEditModal = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-auto overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center bg-slate-50">
                    <h3 class="text-lg font-bold text-slate-800 brand-font flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        <span
                            x-text="editFormAction === '{{ route('admin.public-info.store') }}' ? 'Tambah Dokumen Baru' : 'Edit Dokumen Publik'"></span>
                    </h3>
                    <button @click="showEditModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form :action="editFormAction" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    <input type="hidden" name="_method" value="PUT" x-bind:disabled="!isEditMode">
                    <input type="hidden" name="category" value="{{ $category }}">

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Judul Informasi</label>
                            <input type="text" name="title" x-model="editData.title" required
                                class="w-full border border-slate-300 rounded-lg px-4 py-2 text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi &amp;
                                Ringkasan</label>
                            <textarea name="description" x-model="editData.description" rows="3"
                                class="w-full border border-slate-300 rounded-lg px-4 py-2 text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Hak Akses Publikasi</label>
                            <select name="visibility" x-model="editData.visibility"
                                class="w-full border border-slate-300 rounded-lg px-4 py-2 text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50 transition-all font-medium">
                                <option value="public">Publik (Dokumen Bisa Diunduh Langsung)</option>
                                <option value="restricted">Tertutup / Dikecualikan (Harus Mengajukan Permohonan)
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">
                                Dokumen PDF/File
                                <span class="text-slate-400 text-xs font-normal" x-show="isEditMode">(Biarkan kosong
                                    jika tidak ingin mengubah)</span>
                            </label>
                            <input type="file" name="info_file" accept=".pdf,.doc,.docx,.xls,.xlsx"
                                :required="!isEditMode"
                                class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end gap-3">
                        <button type="button" @click="showEditModal = false"
                            class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 transition-colors">Batal</button>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const deleteForms = document.querySelectorAll('.form-delete');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Dokumen dan file ini akan dihapus permanen dari server!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        customClass: {
                            popup: 'rounded-2xl shadow-xl'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        })();

        function publicInfoManager() {
            return {
                showPdfModal: false,
                currentPdfUrl: '',
                openPdf(url) {
                    this.currentPdfUrl = url;
                    this.showPdfModal = true;
                },

                showEditModal: false,
                isEditMode: false,
                editFormAction: '',
                editData: {
                    id: '',
                    title: '',
                    description: '',
                    visibility: 'public'
                },
                openCreate() {
                    this.isEditMode = false;
                    this.editData.id = '';
                    this.editData.title = '';
                    this.editData.description = '';
                    this.editData.visibility = 'public';
                    this.editFormAction = '{{ route('admin.public-info.store') }}';
                    this.showEditModal = true;
                },
                openEdit(id, title, description, visibility) {
                    this.isEditMode = true;
                    this.editData.id = id;
                    this.editData.title = title;
                    this.editData.description = description;
                    this.editData.visibility = visibility;
                    this.editFormAction = `{{ url('admin/public-info') }}/${id}`;
                    this.showEditModal = true;
                }
            }
        }
    </script>
</x-app-layout>
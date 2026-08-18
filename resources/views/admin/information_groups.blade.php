<x-app-layout>
    <x-slot name="header">
        Kelola Kelompok Informasi
    </x-slot>

    <div x-data="groupManager()">

        <!-- Validation Errors Header -->
        @if ($errors->any())
            <div class="mb-4 bg-rose-50 border border-rose-200 rounded-xl p-4 flex gap-3">
                <svg class="w-5 h-5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
                <div>
                    <h3 class="text-sm font-bold text-rose-800">Terdapat kesalahan pada input:</h3>
                    <ul class="text-sm text-rose-600 mt-1 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif


        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div
                class="p-4 sm:p-6 border-b border-slate-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50/50">
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Daftar Kelompok Informasi</h2>
                    <p class="text-sm text-slate-500 mt-1">Kelola data grup akordion untuk kategori informasi.</p>
                </div>
                <button @click="openCreate()" type="button"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold transition-all shadow-sm shadow-indigo-200 hover:shadow-md hover:-translate-y-0.5 whitespace-nowrap">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Kelompok
                </button>
            </div>

            <div class="p-6">
                <!-- Wrapper for horizontal scrolling -->
                <div class="overflow-x-auto rounded-xl border border-slate-200 pb-1">
                    <table class="w-full text-left border-collapse min-w-[800px] whitespace-nowrap" id="groupTable">
                        <thead>
                            <tr
                                class="bg-indigo-50/50 text-indigo-700 text-sm font-semibold brand-font border-b border-indigo-100/50">
                                <th class="px-6 py-4 w-16 text-center">No</th>
                                <th class="px-6 py-4">Nama Kelompok</th>
                                <th class="px-6 py-4 w-48 text-center">Kategori Induk</th>
                                <th class="px-6 py-4 w-48 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            @foreach($groups as $index => $group)
                                <tr class="hover:bg-slate-50 transition-colors group">
                                    <td class="px-6 py-4 text-center font-mono text-slate-400">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">{{ $group->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-indigo-50 text-indigo-600 border border-indigo-200">
                                            {{ str_replace('_', ' ', $group->category) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button @click="openEdit({{ json_encode($group) }})"
                                                class="p-2 text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors"
                                                title="Edit Kelompok">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </button>

                                            <form action="{{ route('admin.information-groups.destroy', $group->id) }}"
                                                method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete(this.closest('form'))"
                                                    class="p-2 text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors"
                                                    title="Hapus Kelompok">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah/Edit -->
        <div x-show="isModalOpen" style="display: none" class="fixed inset-0 z-50 overflow-y-auto"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>

            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="relative bg-white rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden transform transition-all"
                    @click.stop>

                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="text-lg font-bold text-slate-800"
                            x-text="isEdit ? 'Edit Kelompok Informasi' : 'Tambah Kelompok Informasi'"></h3>
                        <button @click="closeModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form :action="formAction" method="POST">
                        @csrf
                        <!-- Hidden variable inside standard form -->
                        <div x-show="isEdit" style="display: none">
                            @method('PUT')
                        </div>

                        <div class="p-6 space-y-4">
                            <!-- Nama Kelompok -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Kelompok Informasi
                                    <span class="text-rose-500">*</span></label>
                                <input type="text" name="name" x-model="formData.name" required
                                    class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm p-3 shadow-sm"
                                    placeholder="Contoh: A. Informasi Profil Sekolah">
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori Induk <span
                                        class="text-rose-500">*</span></label>
                                <select name="category" x-model="formData.category" required
                                    class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm p-3 shadow-sm bg-slate-50">
                                    <option value="berkala">Berkala</option>
                                    <option value="serta_merta">Serta Merta</option>
                                    <option value="setiap_saat">Setiap Saat</option>
                                    <option value="dikecualikan">Dikecualikan</option>
                                    <option value="pengadaan">Pengadaan Barang dan Jasa</option>
                                </select>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div
                            class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-3 rounded-b-2xl">
                            <button type="button" @click="closeModal()"
                                class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-semibold hover:bg-slate-50 transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold transition-all shadow-sm shadow-indigo-200">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    @section('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('groupManager', () => ({
                    isModalOpen: false,
                    isEdit: false,
                    formAction: '{{ route('admin.information-groups.store') }}',
                    formData: {
                        id: null,
                        name: '',
                        category: 'berkala'
                    },

                    openCreate() {
                        this.isEdit = false;
                        this.formAction = '{{ route('admin.information-groups.store') }}';
                        this.formData = { id: null, name: '', category: 'berkala' };
                        this.isModalOpen = true;
                    },

                    openEdit(data) {
                        this.isEdit = true;
                        // Because PUT method in laravel needs a specific route including ID
                        this.formAction = `/admin/information-groups/${data.id}`;
                        this.formData = {
                            id: data.id,
                            name: data.name,
                            category: data.category
                        };
                        this.isModalOpen = true;
                    },

                    closeModal() {
                        this.isModalOpen = false;
                    }
                }));
            });

            function confirmDelete(form) {
                Swal.fire({
                    title: 'Hapus Kelompok?',
                    text: "Data kelompok referensi ini akan dihapus permanen! Namun dokumen yang sudah dibuat tidak akan ikut terhapus.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#94a3b8',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        container: 'font-sans'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        </script>
    @endsection
</x-app-layout>
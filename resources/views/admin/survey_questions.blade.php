<x-app-layout>
    <x-slot name="header">
        Kelola Pertanyaan Survei
    </x-slot>

    <div>

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
                class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
                <div>
                    <h3 class="text-lg font-bold text-slate-800 brand-font flex items-center gap-2">
                        <span class="w-7 h-7 rounded flex items-center justify-center bg-indigo-100 text-indigo-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </span>
                        Tabel Pertanyaan Survei
                    </h3>
                    <p class="text-[13px] text-slate-500 mt-1 ml-9">Kelola daftar pertanyaan pada survei kepuasan
                        masyarakat.</p>
                </div>
                <button onclick="openAddModal()"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm shadow-indigo-200">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Pertanyaan
                </button>
            </div>

            <div class="overflow-x-auto p-5">
                <table id="questionsTable" class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr
                            class="border-b border-slate-200 bg-slate-50/50 text-[13px] font-bold text-slate-600 uppercase tracking-wider">
                            <th class="px-6 py-4 rounded-tl-xl text-center w-16">ID</th>
                            <th class="px-6 py-4">Pertanyaan</th>
                            <th class="px-6 py-4">Tipe</th>
                            <th class="px-6 py-4 text-center">Urutan</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 rounded-tr-xl text-center w-28">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- Modal Form -->
        <div id="questionModal"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm hidden"
            style="display: none;">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden transform transition-all">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-800 brand-font" id="modalTitle">Tambah Pertanyaan</h3>
                    <button onclick="closeModal()"
                        class="text-slate-400 hover:text-rose-500 transition-colors p-1 bg-white rounded-lg hover:bg-rose-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <!-- Native Form via AJAX -->
                <form id="questionForm" onsubmit="saveQuestion(event)">
                    <input type="hidden" id="question_id" name="id">
                    <div class="p-6 space-y-4">
                        <div>
                            <x-input-label for="question" value="Pertanyaan Lengkap" class="font-bold" />
                            <textarea id="question" name="question" required rows="3"
                                class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm text-sm"
                                placeholder="Contoh: Bagaimana kepuasan Anda terhadap layanan kami?"></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="type" value="Tipe Jawaban" class="font-bold" />
                                <select id="type" name="type" required
                                    class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm text-sm">
                                    <option value="rating">Rating (Skala 1-5)</option>
                                    <option value="yes_no">Ya / Tidak</option>
                                    <option value="text">Teks Bebas</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="order_num" value="Nomor Urut" class="font-bold" />
                                <x-text-input id="order_num" name="order_num" type="number" required
                                    class="mt-1 block w-full" value="0" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="is_active" value="Status Aktif" class="font-bold mb-2" />
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="is_active" name="is_active" value="1" class="sr-only peer"
                                    checked>
                                <div
                                    class="relative w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-success">
                                </div>
                                <span class="ms-3 text-sm font-medium text-slate-700">Tampilkan ke Publik</span>
                            </label>
                        </div>
                    </div>
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3 rounded-b-2xl">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 text-sm font-bold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">Batal</button>
                        <button type="submit"
                            class="px-5 py-2 text-sm font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-200">Simpan
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        var surveyTable;

        function initSurveyTable() {
            if (typeof $ === 'undefined') return;
            if ($.fn.DataTable.isDataTable('#questionsTable')) {
                $('#questionsTable').DataTable().destroy();
            }

            surveyTable = $('#questionsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.survey.data') }}",
                order: [[3, 'asc']], // Order by order_num
                columns: [
                    { data: 'id', name: 'id', className: 'text-center text-slate-500' },
                    { data: 'question', name: 'question', className: 'font-medium text-slate-800 whitespace-normal' },
                    {
                        data: 'type',
                        name: 'type',
                        render: function (data) {
                            if (data === 'rating') {
                                return '<span class="px-2.5 py-1 bg-blue-50 text-blue-600 font-bold text-[11px] rounded-lg border border-blue-100">Rating</span>';
                            } else if (data === 'yes_no') {
                                return '<span class="px-2.5 py-1 bg-purple-50 text-purple-600 font-bold text-[11px] rounded-lg border border-purple-100">Ya / Tidak</span>';
                            } else {
                                return '<span class="px-2.5 py-1 bg-amber-50 text-amber-600 font-bold text-[11px] rounded-lg border border-amber-100">Teks Bebas</span>';
                            }
                        }
                    },
                    { data: 'order_num', name: 'order_num', className: 'text-center font-bold text-slate-600' },
                    {
                        data: 'is_active',
                        name: 'is_active',
                        className: 'text-center',
                        render: function (data) {
                            return data ?
                                '<span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 font-bold text-[11px] rounded-lg border border-emerald-100">Aktif</span>' :
                                '<span class="px-2.5 py-1 bg-rose-50 text-rose-600 font-bold text-[11px] rounded-lg border border-rose-100">Tidak Aktif</span>';
                        }
                    },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
                ],
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
                }
            });
        }

        function openAddModal() {
            document.getElementById('questionForm').reset();
            document.getElementById('question_id').value = '';
            document.getElementById('modalTitle').innerText = 'Tambah Pertanyaan';
            document.getElementById('is_active').checked = true;
            document.getElementById('questionModal').classList.remove('hidden');
            document.getElementById('questionModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('questionModal').classList.add('hidden');
            document.getElementById('questionModal').style.display = 'none';
        }

        window.editQuestion = function (id) {
            Swal.fire({ title: 'Loading...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
            $.get(`/admin/survey/${id}/edit`, function (data) {
                Swal.close();
                document.getElementById('question_id').value = data.id;
                document.getElementById('question').value = data.question;
                document.getElementById('type').value = data.type;
                document.getElementById('order_num').value = data.order_num;
                document.getElementById('is_active').checked = data.is_active === 1 || data.is_active === true;

                document.getElementById('modalTitle').innerText = 'Edit Pertanyaan';
                document.getElementById('questionModal').classList.remove('hidden');
                document.getElementById('questionModal').style.display = 'flex';
            }).fail(function () {
                Swal.fire('Error', 'Data tidak ditemukan.', 'error');
            });
        };

        function saveQuestion(e) {
            e.preventDefault();

            const id = document.getElementById('question_id').value;
            const url = id ? `/admin/survey/${id}` : '/admin/survey';
            const method = id ? 'PUT' : 'POST';

            let formData = {
                _token: '{{ csrf_token() }}',
                question: document.getElementById('question').value,
                type: document.getElementById('type').value,
                order_num: document.getElementById('order_num').value,
                is_active: document.getElementById('is_active').checked ? 1 : 0
            };

            Swal.fire({
                title: 'Menyimpan...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: url,
                type: method,
                data: formData,
                success: function (response) {
                    closeModal();
                    surveyTable.ajax.reload(null, false);
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success'
                    });
                },
                error: function (xhr) {
                    let text = 'Terjadi kesalahan sistem.';
                    if (xhr.status === 419) {
                        text = 'Sesi form Anda telah berakhir, silakan refresh halaman (F5).';
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        text = Object.values(xhr.responseJSON.errors)[0][0];
                    }
                    Swal.fire({
                        title: 'Gagal!',
                        text: text,
                        icon: 'error'
                    });
                }
            });
        }

        window.deleteQuestion = function (id) {
            Swal.fire({
                title: 'Hapus Pertanyaan?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/survey/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            surveyTable.ajax.reload(null, false);
                            Swal.fire({
                                title: 'Terhapus!',
                                text: response.message,
                                icon: 'success'
                            });
                        },
                        error: function (xhr) {
                            Swal.fire('Error!', 'Gagal menghapus data.', 'error');
                        }
                    });
                }
            });
        };

        // Initialize table
        setTimeout(initSurveyTable, 100);
    </script>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        Riwayat Permohonan
    </x-slot>

    @if(session('registration_success'))
        <div
            class="mb-6 bg-indigo-50 border-2 border-indigo-200 rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm">
            <div class="flex items-center gap-5">
                <div
                    class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 shrink-0 shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-indigo-900 brand-font mb-1">Permohonan Berhasil Dikirim!</h3>
                    <p class="text-indigo-700 text-sm">Simpan **Nomor Pendaftaran** ini untuk melacak status permohonan
                        publik atau referensi Anda.</p>
                </div>
            </div>
            <div class="bg-white px-6 py-4 rounded-xl border border-indigo-100 shadow-sm text-center min-w-[200px]">
                <span class="block text-[11px] font-bold text-indigo-400 uppercase tracking-wider mb-1">No. Registrasi /
                    Pendaftaran</span>
                <span
                    class="block text-2xl font-black text-slate-800 font-mono tracking-tight">{{ session('registration_success') }}</span>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">
        <div
            class="p-6 sm:p-8 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <h3 class="text-xl font-bold text-slate-800 brand-font flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </span>
                    Informasi Yang Anda Minta
                </h3>
                <p class="text-sm text-slate-500 mt-1">Pantau status seluruh permintaan informasi publik yang telah Anda
                    ajukan.</p>
            </div>

            <a href="{{ route('requests.create') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 brand-font shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Permohonan Baru
            </a>
        </div>

        <div class="overflow-x-auto">
            <table id="userRequestsTable" class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                        <th class="p-4 pl-6 sm:pl-8 border-b border-slate-200">No. Pendaftaran & Subjek</th>
                        <th class="p-4 border-b border-slate-200">Status</th>
                        <th class="p-4 pr-6 sm:pr-8 border-b border-slate-200 text-right">Hasil / Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="animate-pulse">
                        <td class="p-4" colspan="3">
                            <div class="h-4 bg-slate-200 rounded w-1/4 mb-2"></div>
                            <div class="h-4 bg-slate-200 rounded w-1/2"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <!-- Load jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <style>
        .dataTables_wrapper .dataTables_length select {
            border-radius: 0.5rem;
            border-color: #cbd5e1;
            padding: 0.25rem 2rem 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 0.5rem;
            border-color: #cbd5e1;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            margin-left: 0.5rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4f46e5 !important;
            color: white !important;
            border: none;
            border-radius: 0.5rem;
        }

        table.dataTable tbody tr {
            background-color: transparent;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #f1f5f9;
        }
    </style>

    <script>
        function initializeRequestsTable() {
            if ($.fn.DataTable.isDataTable('#userRequestsTable')) {
                $('#userRequestsTable').DataTable().destroy();
            }

            $('#userRequestsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('requests.data') }}',
                columns: [
                    { data: 'subject_info', name: 'subject', className: 'p-4 pl-6 sm:pl-8 align-top' },
                    { data: 'status_badge', name: 'status', className: 'p-4 align-top' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'p-4 pr-6 sm:pr-8 text-right align-top' }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                    search: "Cari Pendaftaran:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    emptyTable: `
                        <div class="py-12 text-center text-slate-400">
                            <svg class="w-16 h-16 mx-auto text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path></svg>
                            <h4 class="text-lg font-bold text-slate-800 brand-font mb-1">Anda Belum Memiliki Permohonan</h4>
                            <p class="mb-6 max-w-sm mx-auto text-sm">Jika Anda membutuhkan dokumen dari lembaga publik, silakan buat permohonan baru.</p>
                            <a href="{{ route('requests.create') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-900 text-white rounded-xl text-sm font-bold hover:bg-slate-800 transition">
                                Ajukan Permohonan Sekarang
                            </a>
                        </div>
                    `
                },
                pageLength: 10,
                order: [[0, 'desc']],
                drawCallback: function () {
                    $(this.api().table().container()).find('.dataTables_empty').css('padding', '0');
                }
            });
        }

        // Initialize immediately without event listeners to prevent double-execution in Turbo forms
        initializeRequestsTable();
    </script>
</x-app-layout>
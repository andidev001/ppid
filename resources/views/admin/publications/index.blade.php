<x-app-layout>
    <x-slot name="header">
        Kelola Publikasi - {{ ucfirst(request('type', 'berita')) }}
    </x-slot>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div
            class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
            <div>
                <h3 class="text-lg font-bold text-slate-800 brand-font flex items-center gap-2">
                    <span class="w-7 h-7 rounded flex items-center justify-center bg-indigo-100 text-indigo-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                    </span>
                    Daftar {{ ucfirst(request('type', 'berita')) }}
                </h3>
                <p class="text-[13px] text-slate-500 mt-1 ml-9">Kelola konten {{ request('type', 'berita') }} untuk
                    ditampilkan ke publik.</p>
            </div>

            <a href="{{ route('admin.publications.create', ['type' => request('type', 'berita')]) }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-bold hover:bg-indigo-700 transition shadow-sm whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah {{ ucfirst(request('type', 'berita')) }}
            </a>
        </div>

        <div class="overflow-x-auto p-5">
            <table class="w-full text-left border-collapse" id="publicationsTable">
                <thead>
                    <tr
                        class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-wider font-semibold border-b border-slate-200">
                        <th class="px-5 py-3 rounded-tl-lg">Informasi Judul</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-right rounded-tr-lg">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <!-- Data AJAX -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- DataTables Scripts -->
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.25rem 2rem 0.25rem 0.5rem;
            font-size: 0.875rem;
            color: #475569;
            outline: none;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.35rem 0.75rem;
            font-size: 0.875rem;
            color: #475569;
            outline: none;
            transition: all 0.2s;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 0.85rem;
            color: #64748b;
            padding-top: 1rem;
        }

        table.dataTable tbody tr:hover {
            background-color: #f8fafc !important;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #f1f5f9;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function initializeTable() {
            if ($.fn.DataTable.isDataTable('#publicationsTable')) {
                $('#publicationsTable').DataTable().destroy();
            }

            $('#publicationsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.publications.data', ['type' => request('type', 'berita')]) }}',
                columns: [
                    { data: 'title_info', name: 'title' },
                    { data: 'status', name: 'is_published' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-right' }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                    search: "Cari Judul:",
                    lengthMenu: "Tampilkan _MENU_ baris",
                },
                pageLength: 10,
                order: [[1, 'desc']] // Sort terbaru if possible format allowed
            });

            // Handle SweetAlert Delete
            $('#publicationsTable').on('click', '.delete-btn', function (e) {
                e.preventDefault();
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Hapus data ini?',
                    text: 'Data yang dihapus tidak dapat dipulihkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#94a3b8',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: { popup: 'rounded-2xl shadow-xl' }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        }

        initializeTable();
    </script>
</x-app-layout>
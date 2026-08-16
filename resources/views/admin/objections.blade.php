<x-app-layout>
    <x-slot name="header">
        Manajemen Keberatan -
        @if(request('status') == 'reviewed') Diproses
        @elseif(request('status') == 'resolved') Selesai
        @elseif(request('status') == 'rejected') Ditolak
        @else Pengajuan Baru @endif
    </x-slot>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div
            class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
            <div>
                <h3 class="text-lg font-bold text-slate-800 brand-font flex items-center gap-2">
                    <span class="w-7 h-7 rounded flex items-center justify-center bg-rose-100 text-rose-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </span>
                    Tabel Data Keberatan
                </h3>
                <p class="text-[13px] text-slate-500 mt-1 ml-9">Kelola pengajuan keberatan dari pemohon beserta proses
                    dan penyelesaiannya.</p>
            </div>
        </div>

        <div class="overflow-x-auto p-5">
            <table class="w-full text-left border-collapse" id="requestsTable">
                <thead>
                    <tr
                        class="bg-slate-50 text-slate-500 text-[11px] uppercase tracking-wider font-semibold border-b border-slate-200">
                        <th class="px-5 py-3 rounded-tl-lg">Pemohon / No. Tiket</th>
                        <th class="px-5 py-3">Alasan Keberatan</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-right rounded-tr-lg">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <!-- Data diload melalui AJAX DataTables -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Preview Frame -->
    <div x-data="{ open: false, fileUrl: '', isPdf: false }"
        @open-preview.window="fileUrl = $event.detail.url; isPdf = fileUrl.toLowerCase().endsWith('.pdf'); open = true;"
        x-show="open"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak
        x-transition.opacity>

        <div @click.away="open = false; fileUrl = ''"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl h-[85vh] flex flex-col overflow-hidden relative"
            x-show="open" x-transition.scale.95>
            <div class="px-5 py-3.5 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <h3 class="font-bold text-slate-800 brand-font flex items-center gap-2">
                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    Pratinjau Dokumen
                </h3>
                <div class="flex items-center gap-2">
                    <a :href="fileUrl" target="_blank"
                        class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors border border-transparent hover:border-indigo-200"
                        title="Buka di tab baru">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                    <button @click="open = false; fileUrl = ''"
                        class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors border border-transparent hover:border-rose-200"
                        title="Tutup">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex-1 bg-slate-100/50 p-3 relative h-full w-full">
                <!-- Tampilan PDF via Iframe -->
                <template x-if="isPdf && fileUrl">
                    <iframe :src="fileUrl"
                        class="w-full h-full rounded-xl shadow-inner border border-slate-200 bg-white"
                        frameborder="0"></iframe>
                </template>

                <!-- Tampilan Gambar -->
                <template x-if="!isPdf && fileUrl">
                    <div class="w-full h-full flex items-center justify-center overflow-auto p-4 bg-slate-100/30">
                        <img :src="fileUrl" class="max-w-full max-h-full object-contain rounded-lg drop-shadow-md">
                    </div>
                </template>
            </div>
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

        .dataTables_wrapper .dataTables_info {
            font-size: 0.85rem;
            color: #64748b;
            padding-top: 1rem;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 1rem;
            font-size: 0.85rem;
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

    <script>
        function initializeRequestsTable() {
            if ($.fn.DataTable.isDataTable('#requestsTable')) {
                $('#requestsTable').DataTable().destroy();
            }

            $('#requestsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.objections.data', ['status' => request('status', 'pending')]) }}',
                columns: [
                    { data: 'applicant', name: 'user.name' },
                    { data: 'reason_info', name: 'reason' },
                    { data: 'status_badge', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-right' }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                },
                pageLength: 10,
                order: [[2, 'asc']] // Sort status as default
            });

            // Event Delegation untuk tombol Pratinjau Surat
            $('#requestsTable tbody').off('click', '.view-pdf-btn').on('click', '.view-pdf-btn', function () {
                let docUrl = $(this).data('url');
                window.dispatchEvent(new CustomEvent('open-preview', { detail: { url: docUrl } }));
            });
        }

        // Initialize immediately without event listeners to prevent double-execution in Turbo forms
        initializeRequestsTable();
    </script>
</x-app-layout>
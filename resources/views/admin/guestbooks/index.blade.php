<x-app-layout>
    <x-slot name="header">
        Manajemen Buku Tamu
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <p class="text-slate-500 mt-1">Daftar pengunjung portal yang mengisi formulir buku tamu publik.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">
            <div class="p-6">
                <table class="w-full text-left" id="guestbooks-table">
                    <thead>
                        <tr class="text-slate-500 border-b border-slate-200">
                            <th class="font-semibold text-sm pb-3">No</th>
                            <th class="font-semibold text-sm pb-3">Tanggal Isi</th>
                            <th class="font-semibold text-sm pb-3">Nama</th>
                            <th class="font-semibold text-sm pb-3">Pesan / Tujuan</th>
                            <th class="font-semibold text-sm pb-3">Instansi</th>
                            <th class="font-semibold text-sm pb-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTables Scripts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <style>
        .dataTables_wrapper .dataTables_length select {
            border-radius: 0.5rem;
            border-color: #cbd5e1;
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 0.5rem;
            border-color: #cbd5e1;
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
            margin-left: 0.5rem;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;
        }

        table.dataTable tbody tr {
            border-bottom: 1px solid #f1f5f9;
        }
    </style>
    <script>
        document.addEventListener('turbo:load', function () {
            if (!$.fn.DataTable.isDataTable('#guestbooks-table')) {
                $('#guestbooks-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.guestbooks.index') }}",
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'created_at', name: 'created_at' },
                        {
                            data: 'name', name: 'name', render: function (data, type, row) {
                                let contactInfo = '';
                                if (row.email) contactInfo += `<br><span class="text-xs text-slate-400">${row.email}</span>`;
                                if (row.phone) contactInfo += `<br><span class="text-xs text-slate-400">${row.phone}</span>`;
                                return `<div class="font-medium text-slate-800">${data}</div>${contactInfo}`;
                            }
                        },
                        {
                            data: 'purpose', name: 'purpose', render: function (data) {
                                return `<div class="max-w-xs whitespace-normal">${data}</div>`;
                            }
                        },
                        {
                            data: 'institution', name: 'institution', render: function (data) {
                                return data ? data : '-';
                            }
                        },
                        { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-right' }
                    ],
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
                    }
                });
            }
        });

        window.deleteGuestbook = function (id) {
            Swal.fire({
                title: 'Hapus Pesan?',
                text: "Pesan buku tamu ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const url = `{{ url('admin/guestbooks') }}/${id}`;
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                $('#guestbooks-table').DataTable().ajax.reload();
                                Swal.fire('Terhapus!', data.success, 'success');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error!', 'Terjadi kesalahan sistem.', 'error');
                        });
                }
            });
        }
    </script>
</x-app-layout>
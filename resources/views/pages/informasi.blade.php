@extends('layouts.public')

@section('content')
    <div x-data="{ 
                                        showPreview: false, 
                                        previewUrl: '', 
                                        showVideo: false, 
                                        currentVideo: '',
                                        openVideo(base64Content) {
                                            let content = atob(base64Content);
                                            if (content.includes('youtube.com/watch') || content.includes('youtu.be/')) {
                                                let videoId = '';
                                                if (content.includes('youtube.com/watch')) {
                                                    videoId = content.split('v=')[1].split('&')[0];
                                                } else {
                                                    videoId = content.split('youtu.be/')[1].split('?')[0];
                                                }
                                                content = `<iframe class=\'w-full h-full rounded-b-lg\' src=\'https://www.youtube.com/embed/${videoId}\' frameborder=\'0\' allow=\'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\' allowfullscreen></iframe>`;
                                            } else if (!content.includes('<iframe')) {
                                                content = `<iframe class=\'w-full h-full rounded-b-lg\' src=\'${content}\' frameborder=\'0\' allowfullscreen></iframe>`;
                                            }
                                            this.currentVideo = content;
                                            this.showVideo = true;
                                        }
                                    }">
        <div class="bg-slate-900 pb-32 pt-16 relative overflow-hidden">
            <div class="absolute inset-0 opacity-[0.05] text-white">
                <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="pattern-informasi" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                            <path
                                d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                                fill="currentColor"></path>
                        </pattern>
                    </defs>
                    <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-informasi)"></rect>
                </svg>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <h1 class="text-2xl md:text-4xl font-extrabold text-white brand-font tracking-tight mb-4">
                    {{ $kategoriLabel }}
                </h1>
                <p class="text-indigo-100 max-w-2xl mx-auto text-base">Daftar lengkap seluruh dokumen publik pada kategori
                    ini.</p>
            </div>
        </div>

        <!-- Main Content Area with Table -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 mb-16">
            <div
                class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden transform transition-all group">

                <div
                    class="p-6 md:p-8 bg-slate-50/50 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <div
                            class="w-12 h-12 rounded-2xl bg-[#f8f5ff] text-[#9333ea] flex items-center justify-center shrink-0 shadow-sm border border-[#f3e8ff]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-black text-[#0f172a] brand-font tracking-tight">{{ $kategoriLabel }}</h2>
                    </div>


                </div>

                <div class="overflow-x-auto p-4 sm:px-6 sm:pb-6 sm:pt-4">
                    <table id="informasiTable" class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr
                                class="bg-indigo-50/50 text-indigo-700 text-sm font-semibold brand-font border-b border-indigo-100/50">
                                <th class="hidden">Group</th>
                                <th class="px-6 py-4 w-16 text-center">No</th>
                                <th class="px-6 py-4 w-4/12">Judul Informasi</th>
                                <th class="px-6 py-4 w-2/12">Penanggung Jawab</th>
                                <th class="px-6 py-4 w-3/12">Keterangan Singkat</th>
                                @if($kategori === 'semua')
                                    <th class="px-6 py-4 text-center w-2/12">Kategori</th>
                                @endif
                                <th class="px-6 py-4 text-center w-48">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-100">
                            <!-- DataTables Body -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PDF Preview Modal -->
            @include('components.pdf-viewer-modal')

            <!-- Video Preview Modal -->
            @include('components.video-viewer-modal')
        </div>
    </div>


@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        /* Styling adjustments for datatables in public view */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.3em 0.8em;
            border-radius: 0.5rem;
            border: none;
            background: transparent;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4f46e5;
            border: none;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #e0e7ff;
            border: none;
            color: #4f46e5 !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            padding: 0.5rem 1rem;
            outline: none;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #818cf8;
            box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.2);
        }

        .dataTables_wrapper {
            margin-top: -0.5rem;
        }

        @if(in_array($kategori, ['berkala', 'setiap_saat']))
            /* Sembunyikan thead jika kategori berkala atau setiap saat (tampilan akordion) */
            #informasiTable thead {
                display: none;
            }

            #informasiTable.dataTable.no-footer {
                border-bottom: none;
            }

            #informasiTable tbody tr {
                border-bottom: 1px solid #f1f5f9;
            }

            #informasiTable tbody tr:hover {
                background-color: #f8fafc;
            }

        @endif .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1.5rem;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label {
            font-weight: 500;
            color: #475569;
        }

        @media (max-width: 768px) {

            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_length {
                margin-top: 0.5rem;
            }

            .dataTables_wrapper {
                margin-top: 0;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        (function () {
            const initDataTable = function () {
                if (typeof $ === 'undefined' || typeof $.fn.DataTable === 'undefined') return;

                if ($.fn.DataTable.isDataTable('#informasiTable')) {
                    $('#informasiTable').DataTable().destroy();
                }

                $('#informasiTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: {{ in_array($kategori, ['berkala', 'setiap_saat']) ? 'false' : 'true' }},
                    ajax: "{{ route('informasi.kategori', ['kategori' => $kategori]) }}",
                    columns: [
                        { data: 'group_name', name: 'group_name', visible: false },
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center font-mono text-slate-800 font-bold px-6 py-5 align-middle', width: '50px' },
                        { data: 'title', name: 'title', orderable: {{ in_array($kategori, ['berkala', 'setiap_saat']) ? 'false' : 'true' }}, className: 'px-6 py-5 align-middle text-slate-700' },
                        { data: 'penanggung_jawab', name: 'penanggung_jawab', orderable: {{ in_array($kategori, ['berkala', 'setiap_saat']) ? 'false' : 'true' }}, className: 'px-6 py-5 text-indigo-500 font-medium whitespace-nowrap align-middle' },
                        { data: 'description', name: 'description', orderable: {{ in_array($kategori, ['berkala', 'setiap_saat']) ? 'false' : 'true' }}, className: 'px-6 py-5 text-slate-500 leading-relaxed align-middle hidden md:table-cell' },
                        @if($kategori === 'semua')
                            { data: 'category_badge', name: 'category', orderable: false, className: 'text-center px-6 py-5 align-middle' },
                        @endif
                        { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-right px-6 py-5 align-middle' }
                    ],
                    drawCallback: function (settings) {
                        var api = this.api();
                        var rows = api.rows({ page: 'current' }).nodes();
                        var last = null;
                        var rowNum = 1;

                        api.column(0, { page: 'current' }).data().each(function (group, i) {
                            if (last !== group) {
                                if (group) {
                                    @if($kategori === 'semua')
                                        var colspan = 6;
                                    @else
                                        var colspan = 5;
                                    @endif
                                    $(rows).eq(i).before(
                                        '<tr class="group-header"><td colspan="' + colspan + '" class="text-white font-bold p-4 text-sm sm:text-base tracking-wide" style="background-color: #0f172a; border-left: 6px solid #f59e0b; color: white;">' + group + '</td></tr>'
                                    );
                                }
                                last = group;
                                rowNum = 1;
                            }

                            if (group) {
                                $(rows).eq(i).find('td:eq(0)').html(rowNum + '.');
                                rowNum++;
                            }
                        });
                    },
                    language: {
                        search: "Cari Informasi:",
                        lengthMenu: "Tampilkan _MENU_ entri",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ dokumen",
                        infoEmpty: "Tidak ada dokumen",
                        paginate: {
                            first: "Awal",
                            last: "Akhir",
                            next: "Lanjut",
                            previous: "Kembali"
                        }
                    }
                });
            };

            setTimeout(initDataTable, 100);

            if (!window.dtInformasiTurboInterceptor) {
                document.addEventListener('turbo:load', () => {
                    setTimeout(() => { if (window.dtInformasiInitActive) window.dtInformasiInitActive(); }, 150);
                });
                window.dtInformasiTurboInterceptor = true;
            }
            window.dtInformasiInitActive = initDataTable;
        })();
    </script>
@endsection
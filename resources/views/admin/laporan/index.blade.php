<x-app-layout>
    <x-slot name="header">
        {{ $titleMap[$type] }}
    </x-slot>

    <!-- Alpine Data for PDF Modal -->
    <div x-data="{ showPdfModal: false, pdfUrl: '' }" class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold brand-font">{{ $titleMap[$type] }}</h1>
                <p class="text-slate-500 mt-1">Saring data berdasarkan tanggal lalu ekspor ke Excel atau cetak PDF.</p>
            </div>

            @if(isset($data) && count($data) > 0)
                <div class="flex gap-2">
                    <!-- PDF Modal Trigger -->
                    <button
                        @click="pdfUrl = '{{ route('admin.reports.generate', ['type' => $type, 'start_date' => request('start_date'), 'end_date' => request('end_date'), 'format' => 'pdf']) }}'; showPdfModal = true;"
                        class="btn bg-rose-50 border-rose-200 text-rose-600 hover:bg-rose-100 flex items-center gap-2 py-2 px-4 rounded-lg text-sm font-medium transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg> Cetak PDF
                    </button>

                    <a href="{{ route('admin.reports.generate', ['type' => $type, 'start_date' => request('start_date'), 'end_date' => request('end_date'), 'format' => 'excel']) }}"
                        class="btn bg-emerald-600 border-emerald-600 text-white hover:bg-emerald-700 flex items-center gap-2 py-2 px-4 rounded-lg text-sm font-medium transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg> Unduh File Excel (.xls)
                    </a>
                </div>
            @endif
        </div>

        <!-- Filter Form -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 mb-8">
            <form action="{{ route('admin.reports.index') }}" method="GET"
                class="flex flex-col md:flex-row gap-4 items-end">
                <input type="hidden" name="type" value="{{ $type }}">
                <div class="flex-1 w-full relative">
                    <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wide">Mulai
                        Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" required
                        class="w-full text-sm rounded-lg border-slate-200 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="flex-1 w-full relative">
                    <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wide">Sampai
                        Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" required
                        class="w-full text-sm rounded-lg border-slate-200 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="w-full md:w-auto">
                    <button type="submit"
                        class="w-full md:w-auto btn bg-indigo-600 text-white hover:bg-indigo-700 py-2.5 px-6 rounded-lg text-sm font-medium transition shadow-md shadow-indigo-200 flex items-center justify-center gap-2 block">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg> Tari Data
                    </button>
                </div>
            </form>
        </div>

        <!-- Data Tabel -->
        @if(request()->has('start_date') && request()->has('end_date'))
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 overflow-x-auto">
                    <table class="w-full text-left border-collapse" id="report-table">
                        <thead>
                            <tr class="text-slate-500 border-b border-slate-200 bg-slate-50">
                                @if($type === 'permohonan')
                                    <th class="font-semibold text-sm py-3 px-4">No</th>
                                    <th class="font-semibold text-sm py-3 px-4">ID Register</th>
                                    <th class="font-semibold text-sm py-3 px-4">Tanggal</th>
                                    <th class="font-semibold text-sm py-3 px-4">Nama Pemohon</th>
                                    <th class="font-semibold text-sm py-3 px-4">Kategori</th>
                                    <th class="font-semibold text-sm py-3 px-4">Status</th>
                                @elseif($type === 'keberatan')
                                    <th class="font-semibold text-sm py-3 px-4">No</th>
                                    <th class="font-semibold text-sm py-3 px-4">ID Keberatan</th>
                                    <th class="font-semibold text-sm py-3 px-4">Tanggal</th>
                                    <th class="font-semibold text-sm py-3 px-4">Nama Pemohon</th>
                                    <th class="font-semibold text-sm py-3 px-4">ID Permohonan</th>
                                    <th class="font-semibold text-sm py-3 px-4">Status</th>
                                @elseif($type === 'bukutamu')
                                    <th class="font-semibold text-sm py-3 px-4">No</th>
                                    <th class="font-semibold text-sm py-3 px-4">Tanggal</th>
                                    <th class="font-semibold text-sm py-3 px-4">Nama</th>
                                    <th class="font-semibold text-sm py-3 px-4">Instansi</th>
                                    <th class="font-semibold text-sm py-3 px-4">Tujuan</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($data as $index => $row)
                                <tr class="border-b border-slate-100 hover:bg-slate-50">
                                    @if($type === 'permohonan')
                                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4 font-medium">{{ $row->tracking_code }}</td>
                                        <td class="py-3 px-4">{{ $row->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="py-3 px-4">{{ $row->user->name ?? 'Anonim' }}</td>
                                        <td class="py-3 px-4">{{ $row->category }}</td>
                                        <td class="py-3 px-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $row->status == 'approved' ? 'bg-emerald-100 text-emerald-800' : ($row->status == 'rejected' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800') }}">
                                                {{ strtoupper($row->status) }}
                                            </span>
                                        </td>
                                    @elseif($type === 'keberatan')
                                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4 font-medium">{{ $row->tracking_code }}</td>
                                        <td class="py-3 px-4">{{ $row->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="py-3 px-4">{{ $row->user->name ?? '-' }}</td>
                                        <td class="py-3 px-4">{{ $row->request->tracking_code ?? '-' }}</td>
                                        <td class="py-3 px-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $row->status == 'resolved' ? 'bg-emerald-100 text-emerald-800' : ($row->status == 'rejected' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800') }}">
                                                {{ strtoupper($row->status) }}
                                            </span>
                                        </td>
                                    @elseif($type === 'bukutamu')
                                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4">{{ $row->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="py-3 px-4 font-medium">{{ $row->name }}</td>
                                        <td class="py-3 px-4">{{ $row->institution ?? '-' }}</td>
                                        <td class="py-3 px-4">{{ \Illuminate\Support\Str::limit($row->purpose, 40) }}</td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-slate-500">
                                        <svg class="mx-auto h-12 w-12 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Tidak ada data pada periode tersebut.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-200 border-dashed p-12 text-center flex flex-col items-center justify-center">
                <svg class="mx-auto h-16 w-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-sm font-medium text-slate-900">Belum Ada Data</h3>
                <p class="mt-1 text-sm text-slate-500">Silakan tentukan "Mulai Tanggal" dan "Sampai Tanggal" lalu klik
                    tombol Cari Data.</p>
            </div>
        @endif

        <!-- PDF Iframe Modal -->
        <div x-show="showPdfModal" class="fixed inset-0 flex items-center justify-center overflow-hidden"
            style="z-index: 9999;" x-cloak>
            <div x-show="showPdfModal" x-transition.opacity class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"
                @click="showPdfModal = false"></div>

            <div x-show="showPdfModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                class="relative bg-white rounded-2xl shadow-2xl w-full max-w-6xl mx-4 z-10 flex flex-col overflow-hidden"
                style="height: 85vh;">

                <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center bg-slate-50 shrink-0">
                    <h3 class="text-lg font-bold text-slate-800 brand-font flex items-center gap-2">
                        <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Pratinjau PDF
                    </h3>
                    <button @click="showPdfModal = false"
                        class="text-slate-400 hover:text-slate-600 transition p-2 rounded-lg hover:bg-slate-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="flex-1 bg-slate-300 relative w-full h-full p-2">
                    <iframe :src="pdfUrl" class="w-full h-full rounded shadow bg-white border-0"
                        title="PDF Preview"></iframe>
                </div>

            </div>
        </div>

    </div>

    @if(request()->has('start_date') && request()->has('end_date') && count($data) > 0)
        <!-- DataTables Script for internal search -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script>
            document.addEventListener('turbo:load', function () {
                if (!$.fn.DataTable.isDataTable('#report-table')) {
                    $('#report-table').DataTable({
                        language: {
                            url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
                        },
                        pageLength: 25,
                        ordering: false,
                        dom: '<"top"f>rt<"bottom"ilp><"clear">'
                    });
                }
            });
        </script>
    @endif
</x-app-layout>
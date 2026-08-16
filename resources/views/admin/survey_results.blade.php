<x-app-layout>
    <x-slot name="header">
        Laporan Hasil Survei
    </x-slot>

    <!-- Summary Widgets -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Total Responden -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Total Responden</p>
                <h3 class="text-3xl font-black text-slate-800">{{ number_format($totalResponses) }}</h3>
                <p class="text-[13px] text-slate-400 mt-1">Masyarakat berpartisipasi</p>
            </div>
            <div
                class="w-14 h-14 rounded-2xl border-2 border-indigo-100 bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
        </div>

        <!-- Download Reports Options -->
        <div
            class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-lg border border-indigo-500 p-6 flex items-center justify-between relative overflow-hidden">
            <svg class="absolute right-0 bottom-0 text-white/10 w-32 h-32 transform translate-x-8 translate-y-8"
                fill="currentColor" viewBox="0 0 24 24">
                <path d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <div class="relative z-10">
                <p class="text-sm font-bold text-indigo-100 uppercase tracking-wider mb-1">Eksport Laporan</p>
                <h3 class="text-2xl font-black text-white">Unduh Data</h3>
                <p class="text-[13px] text-indigo-200 mt-1">Cetak rekapitulasi data survei</p>
            </div>
            <div class="relative z-10 flex gap-2">
                <button onclick="window.print()"
                    class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-xl font-bold text-sm backdrop-blur-md transition-colors flex items-center border border-white/30">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                        </path>
                    </svg>
                    Print Dashboard
                </button>
            </div>
        </div>
    </div>

    @if($questions->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-10 text-center">
            <h3 class="text-xl font-bold text-slate-800">Tidak ada pertanyaan survei yang aktif.</h3>
            <p class="text-slate-500 mt-2">Tambahkan pertanyaan melalui menu Kelola Pertanyaan Survei.</p>
        </div>
    @else
        <!-- Questions Dynamic Dashboard -->
        <div class="space-y-6 mb-8">
            <h2 class="text-xl font-bold text-slate-800 brand-font flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                Statistik Tiap Pertanyaan
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($questions as $q)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
                        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                            <span
                                class="inline-block px-2.5 py-1 bg-slate-200 text-slate-600 font-bold text-[10px] uppercase tracking-wider rounded-lg mb-2">Pertanyaan
                                #{{ $q->order_num }}</span>
                            <h3 class="text-base font-bold text-slate-800 min-h-[3rem]">{{ $q->question }}</h3>
                        </div>
                        <div class="p-6 flex-1 flex flex-col justify-center relative">
                            @if($q->type === 'rating')
                                <div class="text-center mb-6">
                                    <div class="inline-flex items-end justify-center">
                                        <span class="text-4xl font-black text-amber-500">{{ $averageRatings[$q->id] ?? 0 }}</span>
                                        <span class="text-lg font-bold text-slate-400 mb-1 ml-1">/ 5.0</span>
                                    </div>
                                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Rata-rata Penilaian
                                    </p>
                                </div>
                                <div class="space-y-3 w-full max-w-sm mx-auto">
                                    @php $stats = $chartData[$q->id] ?? []; @endphp
                                    @foreach([5 => 'Sangat Baik', 4 => 'Baik', 3 => 'Cukup', 2 => 'Buruk', 1 => 'Sg. Buruk'] as $star => $label)
                                        @php 
                                                                        $cnt = $stats[$star] ?? 0;
                                            $total = array_sum($stats);
                                            $pct = $total > 0 ? round(($cnt / $total) * 100) : 0;
                                        @endphp
                                        <div class="flex items-center text-sm">
                                            <div class="w-20 font-bold text-slate-600">{{ $label }}</div>
                                            <div class="flex-1 ml-2 mr-4 bg-slate-100 h-2 rounded-full overflow-hidden">
                                                <div class="bg-amber-400 h-full rounded-full" style="width: {{ $pct }}%"></div>
                                            </div>
                                            <div class="w-8 text-right font-bold text-slate-800">{{ $cnt }}</div>
                                        </div>
                                    @endforeach
                                </div>

                            @elseif($q->type === 'yes_no')
                                @php 
                                                            $stats = $chartData[$q->id] ?? [];
                                    $ya = $stats['Ya'] ?? 0;
                                    $tidak = $stats['Tidak'] ?? 0;
                                    $totalYN = $ya + $tidak;
                                    $pctYa = $totalYN > 0 ? round(($ya / $totalYN) * 100) : 0;
                                    $pctTidak = $totalYN > 0 ? round(($tidak / $totalYN) * 100) : 0;
                                @endphp
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-full flex items-center justify-center gap-8 mb-6">
                                        <div class="text-center">
                                            <div
                                                class="w-20 h-20 rounded-full border-4 border-emerald-50 bg-emerald-100 flex items-center justify-center text-emerald-600 shadow-inner mb-3">
                                                <span class="text-2xl font-black">{{ $pctYa }}%</span>
                                            </div>
                                            <div class="font-bold text-slate-800 text-lg">{{ $ya }}</div>
                                            <div class="text-xs font-bold text-emerald-600 uppercase">Menjawab Ya</div>
                                        </div>
                                        <div class="text-center">
                                            <div
                                                class="w-20 h-20 rounded-full border-4 border-rose-50 bg-rose-100 flex items-center justify-center text-rose-600 shadow-inner mb-3">
                                                <span class="text-2xl font-black">{{ $pctTidak }}%</span>
                                            </div>
                                            <div class="font-bold text-slate-800 text-lg">{{ $tidak }}</div>
                                            <div class="text-xs font-bold text-rose-600 uppercase">Menjawab Tidak</div>
                                        </div>
                                    </div>
                                    <div class="w-full bg-rose-500 h-3 rounded-full flex overflow-hidden">
                                        <div class="bg-emerald-500 h-full transition-all" style="width: {{ $pctYa }}%"></div>
                                    </div>
                                </div>

                            @else
                                @php $texts = $chartData[$q->id] ?? []; @endphp
                                @if(count($texts) > 0)
                                    <div class="space-y-3 h-48 overflow-y-auto pr-2 custom-scrollbar">
                                        @foreach($texts as $t)
                                            <div class="p-3 bg-slate-50 border border-slate-100 rounded-xl relative">
                                                <svg class="absolute top-3 left-3 text-slate-300 w-4 h-4" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                                </svg>
                                                <p class="text-sm text-slate-700 italic pl-6">"{{ $t->answer_text }}"</p>
                                                <p class="text-[10px] text-slate-400 mt-2 text-right">{{ $t->created_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center text-center text-slate-400 pt-8 pb-4">
                                        <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-medium">Belum ada tanggapan berupa teks.</p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Respondents List Table -->
        <h2 class="text-xl font-bold text-slate-800 brand-font flex items-center gap-2 mb-4">
            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
            Daftar Individu Responden
        </h2>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto p-5">
                <table id="responsesTable" class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr
                            class="border-b border-slate-200 bg-slate-50/50 text-[13px] font-bold text-slate-600 uppercase tracking-wider">
                            <th class="px-6 py-4 rounded-tl-xl w-16">ID</th>
                            <th class="px-6 py-4">Waktu Isi</th>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Pekerjaan</th>
                            <th class="px-6 py-4">Usia</th>
                            <th class="px-6 py-4 rounded-tr-xl text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    @endif

    <!-- Detail Modal -->
    <div id="detailModal"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm hidden"
        style="display: none;">
        <div
            class="bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden transform transition-all max-h-[90vh] flex flex-col">
            <div
                class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-slate-50/50 sticky top-0 z-10">
                <div>
                    <h3 class="text-lg font-bold text-slate-800 brand-font">Jawaban Responden</h3>
                    <p class="text-xs font-bold text-slate-500 mt-1 uppercase tracking-wider" id="detailName">Nama</p>
                </div>
                <button onclick="closeDetailModal()"
                    class="text-slate-400 hover:text-rose-500 transition-colors p-1 bg-white rounded-lg hover:bg-rose-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="p-6 overflow-y-auto" id="detailContent">
                <!-- Content injected via JS -->
                <div class="flex justify-center py-10">
                    <div class="w-8 h-8 rounded-full border-4 border-indigo-200 border-t-indigo-600 animate-spin"></div>
                </div>
            </div>

            <div
                class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-3 rounded-b-2xl sticky bottom-0 z-10">
                <button type="button" onclick="closeDetailModal()"
                    class="px-5 py-2 text-sm font-bold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">Tutup
                    Jendela</button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f8fafc;
            border-radius: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .grid,
            .grid * {
                visibility: visible;
            }

            .grid {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                gap: 20px;
            }

            button,
            .fixed {
                display: none !important;
            }
        }
    </style>

    <script>
        $(document).ready(function () {
            if ($('#responsesTable').length) {
                $('#responsesTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.survey.results.data') }}",
                    order: [[1, 'desc']],
                    columns: [
                        { data: 'id', name: 'id', className: 'text-slate-500 font-bold' },
                        { data: 'created_at_fmt', name: 'created_at_fmt', className: 'text-sm text-slate-600' },
                        {
                            data: 'name',
                            name: 'name',
                            className: 'font-bold text-slate-800',
                            render: function (data, type, row) {
                                let label = data ? data : '<span class="text-slate-400 italic">Anonim</span>';
                                let email = row.email ? `<br><span class="text-xs font-normal text-slate-500">${row.email}</span>` : '';
                                return label + email;
                            }
                        },
                        {
                            data: 'job',
                            name: 'job',
                            render: function (data) { return data ? `<span class="bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-lg text-xs font-bold">${data}</span>` : '-'; }
                        },
                        {
                            data: 'age_group',
                            name: 'age_group',
                            render: function (data) { return data ? data + ' thn' : '-'; }
                        },
                        { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
                    ],
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
                    }
                });
            }
        });

        function viewDetails(id) {
            document.getElementById('detailContent').innerHTML = '<div class="flex justify-center py-10"><div class="w-8 h-8 rounded-full border-4 border-indigo-200 border-t-indigo-600 animate-spin"></div></div>';
            document.getElementById('detailName').innerText = "Memuat...";
            document.getElementById('detailModal').classList.remove('hidden');
            document.getElementById('detailModal').style.display = 'flex';

            $.get(`/admin/survey-results/${id}`, function (data) {
                let resp = data.response;
                let namaOutput = resp.name ? resp.name : 'Anonim';
                document.getElementById('detailName').innerText = `${namaOutput} - Dikirim ${new Date(resp.created_at).toLocaleDateString()}`;

                let html = '<div class="space-y-6">';
                data.answers.forEach((ans, index) => {
                    let ansClass = "bg-white";
                    let val = ans.answer;

                    if (val === 'Ya') ansClass = "bg-emerald-50 text-emerald-800 border-emerald-200 font-bold";
                    else if (val === 'Tidak') ansClass = "bg-rose-50 text-rose-800 border-rose-200 font-bold";
                    else if (["1", "2", "3", "4", "5"].includes(val)) {
                        let stars = '⭐'.repeat(parseInt(val));
                        val = `<span class="text-lg mr-2">${stars}</span> <span class="font-bold opacity-50">(${val}/5)</span>`;
                    }

                    html += `
                        <div class="border-l-4 border-indigo-500 pl-4 py-2">
                            <p class="text-sm font-bold text-slate-800 mb-2">${index + 1}. ${ans.question}</p>
                            <div class="p-3 rounded-xl border border-slate-200 ${ansClass} shadow-sm inline-block min-w-[200px]">
                                ${val}
                            </div>
                        </div>
                    `;
                });
                html += '</div>';

                document.getElementById('detailContent').innerHTML = html;
            }).fail(function () {
                document.getElementById('detailContent').innerHTML = '<div class="text-center text-rose-500 p-5 font-bold">Gagal memuat data.</div>';
            });
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.getElementById('detailModal').style.display = 'none';
        }
    </script>
</x-app-layout>
@extends('layouts.public')

@section('content')
    <div class="bg-slate-900 pb-32 pt-16 relative overflow-hidden">
        <!-- Abstract pattern -->
        <div class="absolute inset-0 opacity-[0.05] text-white">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pattern-statistik" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path
                            d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                            fill="currentColor"></path>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-statistik)"></rect>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white brand-font tracking-tight mb-4">Statistik Layanan PPID
            </h1>
            <p class="text-indigo-100 max-w-2xl mx-auto text-lg">Pusat Data dan Informasi Publik secara rill-time (Langsung)
                berbasis sistem digital.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Total -->
            <div
                class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-6 border border-slate-100 flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
                <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-slate-500 text-sm font-medium">Total Permohonan</p>
                    <h3 class="text-3xl font-bold text-slate-800 brand-font leading-tight">{{ $total }}</h3>
                </div>
            </div>

            <!-- Diproses -->
            <div
                class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-6 border border-slate-100 flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
                <div class="w-14 h-14 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-slate-500 text-sm font-medium">Sedang Diproses</p>
                    <h3 class="text-3xl font-bold text-slate-800 brand-font leading-tight">{{ $proses }}</h3>
                </div>
            </div>

            <!-- Selesai -->
            <div
                class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-6 border border-slate-100 flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
                <div
                    class="w-14 h-14 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-slate-500 text-sm font-medium">Selesai / Diterima</p>
                    <h3 class="text-3xl font-bold text-slate-800 brand-font leading-tight">{{ $selesai }}</h3>
                </div>
            </div>

            <!-- Ditolak -->
            <div
                class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-6 border border-slate-100 flex items-center gap-5 hover:-translate-y-1 transition-transform duration-300">
                <div class="w-14 h-14 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-slate-500 text-sm font-medium">Permohonan Ditolak</p>
                    <h3 class="text-3xl font-bold text-slate-800 brand-font leading-tight">{{ $ditolak }}</h3>
                </div>
            </div>
        </div>

        <!-- Rata-rata penyelesaian permohonan -->
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden mb-8">
            <div class="px-8 py-6 border-b border-slate-100">
                <h2 class="text-xl font-bold text-slate-800 brand-font">Rata-rata penyelesaian permohonan</h2>
                <p class="text-sm text-slate-500 mt-1">Perbandingan rata-rata hari kerja menurut periode</p>
            </div>
            <div class="p-8">
                <div class="relative h-96 w-full">
                    <canvas id="avgDaysChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">
            <!-- Pie Chart: Status Permohonan -->
            <div class="bg-white rounded-3xl shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-slate-100 overflow-hidden flex flex-col pt-1">
                <div class="w-full h-0.5 bg-gradient-to-r from-blue-600 to-indigo-600 mb-5 mx-6 w-auto block"></div>
                <div class="px-6 pb-2">
                    <h2 class="text-[15px] font-bold text-slate-800 brand-font">Persentase permohonan selesai</h2>
                </div>
                <div class="px-6 py-4 flex-grow flex items-center justify-center">
                    <div class="relative h-64 w-full flex items-center justify-center">
                        <canvas id="permohonanPie"></canvas>
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none mt-2">
                            <span class="text-2xl font-bold text-slate-800 brand-font" id="persentaseSelesaiText">0%</span>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-5 bg-slate-50/50 border-t border-slate-100 text-sm space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded bg-[#16a34a]"></span>
                        <span class="text-slate-500">Selesai ({{ $selesai }})</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded bg-[#94a3b8]"></span>
                        <span class="text-slate-500">Dalam proses ({{ $proses + $pending }})</span>
                    </div>
                </div>
            </div>

            <!-- Pie Chart: Informasi Kategori -->
            <div class="bg-white rounded-3xl shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-slate-100 overflow-hidden flex flex-col pt-1">
                <div class="w-full h-0.5 bg-gradient-to-r from-orange-500 to-orange-400 mb-5 mx-6 w-auto block"></div>
                <div class="px-6 pb-2">
                    <h2 class="text-[15px] font-bold text-slate-800 brand-font">Informasi publik berdasarkan kategori</h2>
                </div>
                <div class="px-6 py-4 flex-grow flex items-center justify-center">
                    <div class="relative h-64 w-full flex items-center justify-center">
                        <canvas id="kategoriPie"></canvas>
                    </div>
                </div>
                <div class="px-6 py-5 bg-slate-50/50 border-t border-slate-100 text-sm space-y-2">
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2"><span class="w-3 h-3 rounded bg-[#1e293b]"></span> <span class="text-slate-500">Tersedia setiap saat</span></div>
                        <span class="text-slate-400">({{ $cat_setiap_saat }})</span>
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2"><span class="w-3 h-3 rounded bg-[#253b70]"></span> <span class="text-slate-500">Berkala</span></div>
                        <span class="text-slate-400">({{ $cat_berkala }})</span>
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2"><span class="w-3 h-3 rounded bg-[#f59e0b]"></span> <span class="text-slate-500">Serta merta</span></div>
                        <span class="text-slate-400">({{ $cat_serta_merta }})</span>
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2"><span class="w-3 h-3 rounded bg-[#ef4444]"></span> <span class="text-slate-500">Dikecualikan</span></div>
                        <span class="text-slate-400">({{ $cat_dikecualikan }})</span>
                    </div>
                </div>
            </div>

            <!-- Pie Chart: Alasan Keberatan -->
            <div class="bg-white rounded-3xl shadow-[0_4px_24px_rgba(0,0,0,0.06)] border border-slate-100 overflow-hidden flex flex-col pt-1">
                <div class="w-full h-0.5 bg-gradient-to-r from-orange-400 to-amber-400 mb-5 mx-6 w-auto block"></div>
                <div class="px-6 pb-2">
                    <h2 class="text-[15px] font-bold text-slate-800 brand-font">Alasan permohonan keberatan</h2>
                </div>
                <div class="px-6 py-4 flex-grow flex items-center justify-center">
                    <div class="relative h-64 w-full flex items-center justify-center">
                        <canvas id="keberatanPie"></canvas>
                    </div>
                </div>
                <div class="px-6 py-5 bg-slate-50/50 border-t border-slate-100 text-[11px] space-y-1.5 h-40 overflow-y-auto w-full custom-scroll">
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded shrink-0 bg-[#0f172a]"></span> <span class="text-slate-500 truncate">Pengecualian</span></div>
                        <span class="text-slate-400">({{ $obj_reasons['pengecualian'] }})</span>
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded shrink-0 bg-[#1e293b]"></span> <span class="text-slate-500 truncate">Tidak disediakannya informasi berkala</span></div>
                        <span class="text-slate-400">({{ $obj_reasons['tidak_disediakan'] }})</span>
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded shrink-0 bg-[#253b70]"></span> <span class="text-slate-500 truncate">Tidak ditanggapi</span></div>
                        <span class="text-slate-400">({{ $obj_reasons['tidak_ditanggapi'] }})</span>
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded shrink-0 bg-[#f59e0b]"></span> <span class="text-slate-500 truncate text-wrap leading-tight">Tidak ditanggapi sebagaimana yang diminta</span></div>
                        <span class="text-slate-400 shrink-0">({{ $obj_reasons['tidak_sesuai'] }})</span>
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded shrink-0 bg-[#fbcfe8]"></span> <span class="text-slate-500 truncate">Tidak dipenuhi</span></div>
                        <span class="text-slate-400">({{ $obj_reasons['tidak_dipenuhi'] }})</span>
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded shrink-0 bg-[#cbd5e1]"></span> <span class="text-slate-500 truncate">Pengenaan biaya yang tidak wajar</span></div>
                        <span class="text-slate-400">({{ $obj_reasons['biaya_tidak_wajar'] }})</span>
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded shrink-0 bg-[#e2e8f0]"></span> <span class="text-slate-500 truncate">Melebihi jangka waktu</span></div>
                        <span class="text-slate-400">({{ $obj_reasons['melebihi_waktu'] }})</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Tren Permohonan Selesai - 7 Bulan Terakhir -->
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden mb-8 mt-5">
            <div class="px-8 py-6 border-b border-slate-100 bg-white">
                <h2 class="text-[16px] font-bold text-slate-800 brand-font">Permohonan selesai — Tahun {{ $currentYear ?? date('Y') }}</h2>
                <p class="text-[13px] text-slate-400 mt-1">Grafik garis menunjukkan volume permohonan yang telah diselesaikan per bulan sepanjang tahun ini.</p>
            </div>
            <div class="p-8">
                <div class="relative h-80 sm:h-96 w-full">
                    <canvas id="trend7BulanChart"></canvas>
                </div>
            </div>
        </div>

    </div>

<!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
.custom-scroll::-webkit-scrollbar { width: 4px; }
.custom-scroll::-webkit-scrollbar-track { background: transparent; }
.custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
</style>
<script>
        (function () {
            const initCharts = () => {
                
                // Set Global Font
                Chart.defaults.font.family = "'Inter', 'Plus Jakarta Sans', sans-serif";

                /* Wiping old charts */
                if (window.chartSatu) window.chartSatu.destroy();
                if (window.chartDua) window.chartDua.destroy();
                if (window.chartTiga) window.chartTiga.destroy();
                if (window.chartEmpat) window.chartEmpat.destroy();
                if (window.chartLima) window.chartLima.destroy();

                /* Horizontal Bar Chart: Rata-rata penyelesaian */
                const canvasBar = document.getElementById('avgDaysChart');
                if (canvasBar) {
                    const ctxBar = canvasBar.getContext('2d');
                    window.chartSatu = new Chart(ctxBar, {
                        type: 'bar',
                        data: {
                            labels: ['Tahun 2026', 'Tahun 2025', 'Tahun 2024', 'Tahun 2021 s/d 2026'],
                            datasets: [{
                                data: [{{ $avgDays['2026'] }}, {{ $avgDays['2025'] }}, {{ $avgDays['2024'] }}, {{ $avgDays['2021_2026'] }}],
                                backgroundColor: ['#1e40af', '#312e81', '#8b5cf6', '#c2410c'],
                                barThickness: 50,
                                borderRadius: 0
                            }]
                        },
                        options: {
                            indexAxis: 'y', // Makes it horizontal
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: { label: function(c) { return c.raw + ' Hari Kerja'; } }
                                }
                            },
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    grid: { color: '#f1f5f9' },
                                    ticks: {
                                        stepSize: 1,
                                        callback: function(value) { return value + ' Hari Kerja'; }
                                    }
                                },
                                y: {
                                    grid: { display: false }
                                }
                            }
                        }
                    });
                }

                /* Donut Chart: Persentase permohonan selesai */
                const totalPermohonan = {{ $selesai }} + {{ $proses + $pending }};
                const percentage = totalPermohonan > 0 ? ({{ $selesai }} / totalPermohonan * 100).toFixed(1) : 0;
                
                const pt = document.getElementById('persentaseSelesaiText');
                if(pt) pt.innerText = `${percentage}%`;

                const ctxPie1 = document.getElementById('permohonanPie');
                if (ctxPie1) {
                    window.chartDua = new Chart(ctxPie1.getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: ['Selesai', 'Dalam Proses'],
                            datasets: [{
                                data: [{{ $selesai }}, {{ $proses + $pending }}],
                                backgroundColor: ['#16a34a', '#94a3b8'],
                                borderWidth: 0,
                                cutout: '65%',
                                hoverOffset: 4
                            }]
                        },
                        options: { 
                            responsive: true, maintainAspectRatio: false,
                            plugins: { legend: { display: false } }
                        }
                    });
                }

                /* Pie Chart: Informasi publik berdasarkan kategori */
                const ctxPie2 = document.getElementById('kategoriPie');
                if (ctxPie2) {
                    window.chartTiga = new Chart(ctxPie2.getContext('2d'), {
                        type: 'pie',
                        data: {
                            labels: ['Tersedia setiap saat', 'Berkala', 'Serta merta', 'Dikecualikan'],
                            datasets: [{
                                data: [{{ $cat_setiap_saat }}, {{ $cat_berkala }}, {{ $cat_serta_merta }}, {{ $cat_dikecualikan }}],
                                backgroundColor: ['#1e293b', '#253b70', '#f59e0b', '#ef4444'],
                                borderWidth: 1,
                                borderColor: '#ffffff',
                                hoverOffset: 5
                            }]
                        },
                        options: { 
                            responsive: true, maintainAspectRatio: false,
                            plugins: { 
                                legend: { display: false },
                                tooltip: { callbacks: { label: function(context) {
                                    let sum = context.dataset.data.reduce((a, b) => a + b, 0);
                                    let percentage = sum > 0 ? (context.raw * 100 / sum).toFixed(2) + "%" : "0%";
                                    return context.label + ': ' + percentage;
                                }}}
                            }
                        }
                    });
                }

                /* Pie Chart: Alasan permohonan keberatan */
                const ctxPie3 = document.getElementById('keberatanPie');
                if (ctxPie3) {
                    window.chartEmpat = new Chart(ctxPie3.getContext('2d'), {
                        type: 'pie',
                        data: {
                            labels: ['Pengecualian', 'Tidak disediakannya informasi berkala', 'Tidak ditanggapi', 'Tidak ditanggapi sebagaimana...', 'Tidak dipenuhi', 'Biaya tidak wajar', 'Melebihi waktu'],
                            datasets: [{
                                data: [{{ $obj_reasons['pengecualian'] }}, {{ $obj_reasons['tidak_disediakan'] }}, {{ $obj_reasons['tidak_ditanggapi'] }}, {{ $obj_reasons['tidak_sesuai'] }}, {{ $obj_reasons['tidak_dipenuhi'] }}, {{ $obj_reasons['biaya_tidak_wajar'] }}, {{ $obj_reasons['melebihi_waktu'] }}],
                                backgroundColor: ['#0f172a', '#1e293b', '#253b70', '#f59e0b', '#fbcfe8', '#cbd5e1', '#e2e8f0'],
                                borderWidth: 1,
                                borderColor: '#ffffff',
                                hoverOffset: 5
                            }]
                        },
                        options: { 
                            responsive: true, maintainAspectRatio: false,
                            plugins: { 
                                legend: { display: false },
                                tooltip: { callbacks: { label: function(context) {
                                    let sum = context.dataset.data.reduce((a, b) => a + b, 0);
                                    let percentage = sum > 0 ? (context.raw * 100 / sum).toFixed(2) + "%" : "0%";
                                    return percentage;
                                }}}
                            }
                        }
                    });
                }
            };

                /* Line Chart: Tren Permohonan Selesai 7 Bulan */
                const canvasTrend = document.getElementById('trend7BulanChart');
                if (canvasTrend) {
                    const ctxTrend = canvasTrend.getContext('2d');
                    
                    let gradientTrend = ctxTrend.createLinearGradient(0, 0, 0, 400);
                    gradientTrend.addColorStop(0, 'rgba(56, 94, 189, 0.2)');
                    gradientTrend.addColorStop(1, 'rgba(56, 94, 189, 0.0)');

                    const dataCounts7 = {!! $trend7Counts !!};
                    const labels7 = {!! $trend7Months !!};

                    window.chartLima = new Chart(ctxTrend, {
                        type: 'line',
                        data: {
                            labels: labels7,
                            datasets: [{
                                label: 'Jumlah Permohonan Selesai',
                                data: dataCounts7,
                                borderColor: '#2f5bbb', // dark blue line
                                backgroundColor: gradientTrend,
                                borderWidth: 2,
                                pointBackgroundColor: '#f59e0b', // orange dots
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointRadius: 5,
                                pointHoverRadius: 7,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { 
                                    display: true,
                                    position: 'top',
                                    labels: {
                                        usePointStyle: false,
                                        boxWidth: 40,
                                        boxHeight: 12,
                                        color: '#64748b',
                                        font: { size: 12 }
                                    }
                                },
                            },
                            scales: {
                                y: { 
                                    beginAtZero: false, 
                                    border: { display: false }, 
                                    grid: { color: '#f1f5f9', drawBorder: false },
                                    title: {
                                        display: true,
                                        text: 'Permohonan Selesai',
                                        color: '#64748b'
                                    }
                                },
                                x: { 
                                    border: { display: false }, 
                                    grid: { color: '#f1f5f9', drawBorder: false },
                                    title: {
                                        display: true,
                                        text: 'Bulan',
                                        color: '#64748b'
                                    }
                                }
                            }
                        }
                    });
                }

            setTimeout(initCharts, 100);

            if (!window.chartTurboInterceptor) {
                document.addEventListener('turbo:load', () => {
                    setTimeout(() => { if (window.chartInitActive) window.chartInitActive(); }, 150);
                });
                window.chartTurboInterceptor = true;
            }
            window.chartInitActive = initCharts;
        })();
</script>
@endsection

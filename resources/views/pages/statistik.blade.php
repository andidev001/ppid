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

        <!-- Chart Configuration -->
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden mb-8">
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <div>
                    <h2 class="text-xl font-bold text-slate-800 brand-font">Tren Permohonan (6 Bulan Terakhir)</h2>
                    <p class="text-sm text-slate-500 mt-1">Laporan grafik volume permintaan informasi publik yang masuk ke
                        sistem.</p>
                </div>
            </div>
            <div class="p-8">
                <div class="relative h-72 sm:h-96 w-full">
                    <canvas id="statistikChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Pie Chart: Status Permohonan -->
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h2 class="text-lg font-bold text-slate-800 brand-font">Proporsi Status Permohonan</h2>
                </div>
                <div class="p-6">
                    <div class="relative h-64 w-full">
                        <canvas id="permohonanPie"></canvas>
                    </div>
                </div>
            </div>

            <!-- Pie Chart: Status Keberatan -->
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-100 bg-slate-50/50">
                    <h2 class="text-lg font-bold text-slate-800 brand-font">Statistik Jumlah Keberatan</h2>
                </div>
                <div class="p-6">
                    <div class="relative h-64 w-full">
                        <canvas id="keberatanPie"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        (function () {
            const initCharts = () => {
                const canvasStat = document.getElementById('statistikChart');
                if (!canvasStat) return;

                /* Destroy existing instances */
                if (window.chartSatu) window.chartSatu.destroy();
                if (window.chartDua) window.chartDua.destroy();
                if (window.chartTiga) window.chartTiga.destroy();

                const ctx = canvasStat.getContext('2d');

                /* Parsing data from Controller */
                const labels = {!! $chartMonths !!};
                const data = {!! $chartCounts !!};

                /* Gradient */
                let gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
                gradient.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

                window.chartSatu = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Permohonan',
                            data: data,
                            borderColor: '#6366f1',
                            backgroundColor: gradient,
                            borderWidth: 3,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#6366f1',
                            pointBorderWidth: 2,
                            pointRadius: 6,
                            pointHoverRadius: 8,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                        },
                        scales: {
                            y: { beginAtZero: true, border: { display: false }, grid: { color: '#f1f5f9', drawBorder: false } },
                            x: { border: { display: false }, grid: { display: false, drawBorder: false } }
                        }
                    }
                });

                /* Pie Chart 1 */
                const ctxPie1 = document.getElementById('permohonanPie').getContext('2d');
                window.chartDua = new Chart(ctxPie1, {
                    type: 'doughnut',
                    data: {
                        labels: ['Menunggu', 'Diproses', 'Selesai', 'Ditolak'],
                        datasets: [{
                            data: [{{ $pending }}, {{ $proses }}, {{ $selesai }}, {{ $ditolak }}],
                            backgroundColor: ['#fbbf24', '#60a5fa', '#34d399', '#fb7185'],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });

                /* Pie Chart 2 */
                const ctxPie2 = document.getElementById('keberatanPie').getContext('2d');
                window.chartTiga = new Chart(ctxPie2, {
                    type: 'doughnut',
                    data: {
                        labels: ['Menunggu', 'Direview', 'Diselesaikan'],
                        datasets: [{
                            data: [{{ $obj_pending }}, {{ $obj_reviewed }}, {{ $obj_resolved }}],
                            backgroundColor: ['#fbbf24', '#a78bfa', '#34d399'],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });
            };

            setTimeout(initCharts, 100);

            if (!window.chartTurboInterceptor) {
                document.addEventListener('turbo:load', () => {
                    setTimeout(() => { if (window.chartInitActive) window.chartInitActive(); }, 150);
                });
                window.chartTurboInterceptor = true;
            }
            window.chartInitActive = initCharts;
        })();</script>
@endsection

{{--
Reusable layout partial for all Standar Pelayanan pages.
Required variables:
$pageTitle – e.g. 'Prosedur Pelayanan Publik'
$pageSubtitle – short description
$settingKey – e.g. 'page_prosedur_pelayanan'
$settings – full settings array from controller
$publications – latest publications (passed from PageController::getCommonData)
--}}

@extends('layouts.public')

@section('content')

    {{-- ── Hero Banner ─────────────────────────────────────────────── --}}
    <div class="bg-slate-900 pb-36 pt-16 relative overflow-hidden">
        {{-- dot pattern --}}
        <div class="absolute inset-0 opacity-[0.05] text-white pointer-events-none">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="dot-pattern" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path
                            d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                            fill="currentColor"></path>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#dot-pattern)"></rect>
            </svg>
        </div>
        {{-- gradient blobs --}}
        <div class="absolute -top-32 -left-24 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            {{-- breadcrumb --}}
            <div class="flex items-center justify-center gap-2 text-indigo-300/70 text-xs mb-5">
                <a href="{{ url('/') }}" class="hover:text-indigo-200 transition-colors">Beranda</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-indigo-200">Standar Pelayanan</span>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white font-medium">{{ $pageTitle }}</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-white brand-font tracking-tight mb-4">{{ $pageTitle }}</h1>
            <p class="text-indigo-100/80 max-w-2xl mx-auto text-lg">{{ $pageSubtitle }}</p>
        </div>
    </div>

    {{-- ── Two-Column Content ───────────────────────────────────────── --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-20 pb-24">
        <div class="flex flex-col lg:flex-row gap-6 items-start">

            {{-- Main Article --}}
            <div class="flex-1 min-w-0">
                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                    {{-- colored top accent --}}
                    <div class="h-1.5 bg-gradient-to-r from-indigo-500 via-blue-500 to-purple-500"></div>

                    {{-- article header strip --}}
                    <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100">
                        <div class="p-2 bg-indigo-50 rounded-xl">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-indigo-500">Standar Pelayanan
                            </p>
                            <h2 class="text-base font-bold text-slate-800 brand-font leading-tight">{{ $pageTitle }}</h2>
                        </div>
                    </div>

                    {{-- prose content --}}
                    <div class="p-6 sm:p-10">
                        <div class="prose prose-slate max-w-none
                                    prose-headings:brand-font prose-headings:text-slate-800
                                    prose-h2:text-xl prose-h3:text-lg
                                    prose-a:text-indigo-600 prose-a:no-underline hover:prose-a:underline
                                    prose-img:rounded-2xl prose-img:shadow-md
                                    prose-table:text-sm
                                    prose-th:bg-indigo-50 prose-th:text-indigo-700">
                            @if(!empty($settings[$settingKey] ?? ''))
                                {!! $settings[$settingKey] !!}
                            @else
                                {{-- Beautiful empty state --}}
                                <div class="flex flex-col items-center justify-center py-16 text-center">
                                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-9 h-9 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-slate-600 font-semibold brand-font text-lg mb-1">Konten Belum Tersedia</h3>
                                    <p class="text-slate-400 text-sm max-w-xs">Halaman ini sedang disiapkan oleh Administrator
                                        dan akan diperbarui segera.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Sidebar ─────────────────────────────────────────────── --}}
            <aside class="w-full lg:w-80 shrink-0 space-y-5">

                {{-- Navigasi Standar Pelayanan --}}
                <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/40 border border-slate-100 overflow-hidden">
                    <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-100 bg-slate-50/70">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        <h3 class="text-sm font-bold text-slate-700 brand-font">Menu Standar Pelayanan</h3>
                    </div>
                    <nav class="py-2">
                        @php
                            $standarMenu = [
                                ['label' => 'Prosedur Pelayanan Publik', 'route' => 'standar.prosedur_pelayanan'],
                                ['label' => 'Prosedur Pengajuan Keberatan', 'route' => 'standar.prosedur_keberatan'],
                                ['label' => 'Prosedur Permohonan Sengketa', 'route' => 'standar.prosedur_sengketa'],
                                ['label' => 'Prosedur Penanganan Sengketa', 'route' => 'standar.penanganan_sengketa'],
                                ['label' => 'SOP PPID', 'route' => 'profil.sop'],
                                ['label' => 'Kanal Layanan PPID', 'route' => 'standar.kanal_layanan'],
                                ['label' => 'Waktu dan Biaya Layanan', 'route' => 'standar.waktu_biaya'],
                            ];
                            $currentUrl = request()->url();
                        @endphp
                        @foreach($standarMenu as $menu)
                                        @php $isActive = $currentUrl === route($menu['route']); @endphp
                                        <a href="{{ route($menu['route']) }}" class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors
                                                      {{ $isActive
                            ? 'bg-indigo-50 text-indigo-700 font-semibold border-r-2 border-indigo-500'
                            : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }}">
                                            <span
                                                class="w-1.5 h-1.5 rounded-full shrink-0 {{ $isActive ? 'bg-indigo-500' : 'bg-slate-300' }}"></span>
                                            {{ $menu['label'] }}
                                        </a>
                        @endforeach
                    </nav>
                </div>

                {{-- Artikel / Berita Terbaru --}}
                @if(isset($publications) && $publications->count() > 0)
                    <div class="bg-white rounded-2xl shadow-lg shadow-slate-200/40 border border-slate-100 overflow-hidden">
                        <div class="flex items-center gap-2.5 px-5 py-4 border-b border-slate-100 bg-slate-50/70">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 8h6v4H7V8z" />
                            </svg>
                            <h3 class="text-sm font-bold text-slate-700 brand-font">Artikel Lainnya</h3>
                        </div>
                        <div class="divide-y divide-slate-100">
                            @foreach($publications->take(4) as $pub)
                                <a href="{{ route('publikasi.show', $pub->slug) }}"
                                    class="flex items-start gap-3 px-4 py-3.5 hover:bg-slate-50 transition-colors group">
                                    {{-- thumbnail --}}
                                    <div class="w-16 h-14 rounded-xl overflow-hidden shrink-0 bg-slate-100">
                                        @if($pub->thumbnail)
                                            <img src="{{ asset('storage/' . $pub->thumbnail) }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                                alt="">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    {{-- info --}}
                                    <div class="flex-1 min-w-0">
                                        <p
                                            class="text-xs font-medium text-slate-800 leading-snug line-clamp-2 group-hover:text-indigo-600 transition-colors">
                                            {{ $pub->title }}
                                        </p>
                                        <p class="text-[10px] text-slate-400 mt-1">
                                            {{ \Carbon\Carbon::parse($pub->published_at)->translatedFormat('d M Y') }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="px-4 py-3 border-t border-slate-100">
                            <a href="{{ route('publikasi.index', 'berita') }}"
                                class="flex items-center justify-center gap-1.5 text-xs font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">
                                Lihat Semua Artikel
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif

                {{-- CTA Card --}}
                <div
                    class="bg-gradient-to-br from-indigo-600 to-blue-700 rounded-2xl p-5 text-white shadow-lg shadow-indigo-200">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="p-2 bg-white/10 rounded-xl shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm brand-font leading-tight">Butuh Informasi Lebih?</p>
                            <p class="text-white/70 text-xs mt-0.5">Ajukan permohonan informasi publik kepada kami.</p>
                        </div>
                    </div>
                    <a href="{{ route('pilih_permohonan') }}"
                        class="flex items-center justify-center gap-1.5 bg-white text-indigo-700 font-semibold text-xs rounded-xl py-2.5 hover:bg-indigo-50 transition-colors">
                        Ajukan Permohonan
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

            </aside>
        </div>
    </div>

@endsection
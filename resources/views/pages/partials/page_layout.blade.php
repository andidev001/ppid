{{--
Reusable layout partial for all Standar Pelayanan pages.
Required variables:
$pageTitle – e.g. 'Prosedur Pelayanan Publik'
$pageSubtitle – short description
$settingKey – e.g. 'page_prosedur_pelayanan'
$settings – full settings array from controller
$publications – latest publications
--}}

@extends('layouts.public')

@section('content')

    <div class="bg-slate-900 pb-32 pt-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05] text-white">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pattern-pubshow" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path
                            d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                            fill="currentColor"></path>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-pubshow)"></rect>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white brand-font tracking-tight mb-4">
                {{ $pageTitle }}
            </h1>
            <p class="text-indigo-100 max-w-2xl mx-auto text-lg">{{ $pageSubtitle }}</p>
        </div>
    </div>

    <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 pb-20 w-full grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">

        {{-- Left Column: Article --}}
        <div class="lg:col-span-8 xl:col-span-9 flex flex-col gap-6">
            <article class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 sm:p-10 lg:p-12">

                    <h1
                        class="text-2xl sm:text-3xl font-semibold text-slate-800 brand-font mb-6 leading-relaxed border-b border-slate-100 pb-4">
                        {{ $pageTitle }}
                    </h1>

                    <div
                        class="prose max-w-none text-base text-slate-600 leading-loose prose-headings:brand-font prose-headings:text-slate-800 prose-a:text-indigo-600 prose-img:rounded-2xl">
                        @if(!empty($settings[$settingKey] ?? ''))
                            {!! $settings[$settingKey] !!}
                        @else
                            {{-- Empty state --}}
                            <div
                                class="flex flex-col items-center justify-center py-12 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                <div
                                    class="w-16 h-16 bg-white rounded-full flex items-center justify-center border border-slate-200 mb-4 shadow-sm">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                                <h3 class="text-slate-600 font-semibold brand-font text-base mb-1">Konten Belum Tersedia</h3>
                                <p class="text-slate-500 text-sm max-w-xs">Halaman ini sedang disiapkan oleh Administrator.</p>
                            </div>
                        @endif
                    </div>

                </div>

                {{-- Quick Nav: Standar Pelayanan --}}
                <div class="bg-slate-50/80 border-t border-slate-100 p-6 sm:p-10">
                    <div class="flex items-center gap-2 mb-5">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <h3 class="text-sm font-extrabold text-slate-800 brand-font uppercase tracking-wider">Navigasi Cepat
                        </h3>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
                        @php
                            $standarMenu = [
                                ['label' => 'Pelayanan', 'title' => 'Prosedur Pelayanan Publik', 'route' => 'standar.prosedur_pelayanan', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                                ['label' => 'Keberatan', 'title' => 'Prosedur Keberatan', 'route' => 'standar.prosedur_keberatan', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                                ['label' => 'Sengketa', 'title' => 'Permohonan Sengketa', 'route' => 'standar.prosedur_sengketa', 'icon' => 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3'],
                                ['label' => 'Penanganan', 'title' => 'Penanganan Sengketa', 'route' => 'standar.penanganan_sengketa', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                                ['label' => 'SOP PPID', 'title' => 'SOP Layanan', 'route' => 'profil.sop', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                                ['label' => 'Kanal Layanan', 'title' => 'Kanal Layanan PPID', 'route' => 'standar.kanal_layanan', 'icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
                                ['label' => 'Waktu/Biaya', 'title' => 'Waktu dan Biaya Layanan', 'route' => 'standar.waktu_biaya', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ];
                            $currentRoute = request()->route()->getName();
                        @endphp
                        @foreach($standarMenu as $menu)
                            @php $isActive = $currentRoute === $menu['route']; @endphp
                            <a href="{{ route($menu['route']) }}" title="{{ $menu['title'] }}"
                                class="group flex items-center gap-3 p-3 rounded-2xl border transition-all duration-300 {{ $isActive ? 'bg-indigo-600 border-indigo-600 text-white shadow-md shadow-indigo-200 cursor-default' : 'bg-white border-slate-200 hover:border-indigo-300 hover:shadow-md hover:shadow-indigo-100/50' }}"
                                {{ $isActive ? 'aria-disabled="true" tabindex="-1" onclick="return false;"' : '' }}>
                                <div
                                    class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0 transition-colors {{ $isActive ? 'bg-white/20 text-white' : 'bg-indigo-50 text-indigo-600 group-hover:bg-indigo-100 group-hover:scale-110' }} duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $menu['icon'] }}"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p
                                        class="text-xs font-bold brand-font truncate {{ $isActive ? 'text-white' : 'text-slate-700 group-hover:text-indigo-700' }}">
                                        {{ $menu['label'] }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

            </article>
        </div>

        {{-- Right Column: Sidebar --}}
        <aside class="lg:col-span-4 xl:col-span-3 space-y-6">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 sticky top-24">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-900 brand-font text-lg">Artikel Lainnya</h3>
                </div>

                <div class="space-y-5">
                    @forelse($publications as $article)
                        <a href="{{ route('publikasi.show', $article->slug) }}" class="group flex gap-4 items-start">
                            <div class="w-20 h-20 rounded-xl bg-slate-100 flex-shrink-0 overflow-hidden relative">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-100">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4
                                    class="text-sm font-bold text-slate-800 brand-font line-clamp-2 leading-snug group-hover:text-indigo-600 transition-colors mb-2">
                                    {{ $article->title }}
                                </h4>
                                <div class="flex items-center text-[11px] text-slate-400 font-medium">
                                    {{ $article->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500">Belum ada artikel lainnya.</p>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>

@endsection
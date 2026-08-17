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
                Waktu dan Biaya Pelayanan
            </h1>
            <p class="text-indigo-100 max-w-2xl mx-auto text-lg">Informasi mengenai standar waktu penyediaan dan estimasi biaya layanan.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 mb-16 grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- Left Column: Cards --}}
        <div class="lg:col-span-8 xl:col-span-9 space-y-6">
            
            {{-- Card 1: Waktu Pelayanan --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden transform transition-all hover:shadow-2xl hover:shadow-slate-200/60 duration-300">
                <div class="p-6 md:p-8 bg-slate-50 border-b border-slate-100 flex flex-col md:flex-row items-start md:items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 shadow-lg border border-slate-800" style="background-color: #0f172a; color: #ffffff;">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-[#0f172a] brand-font tracking-tight">Waktu Pelayanan</h2>
                        <p class="text-sm text-slate-400 mt-1">Jadwal layanan informasi publik</p>
                    </div>
                </div>
                
                <div class="p-6 md:p-8 prose prose-slate max-w-none prose-headings:brand-font prose-headings:font-bold prose-headings:text-[#0f172a] prose-a:text-indigo-600 hover:prose-a:text-indigo-500 prose-img:rounded-xl">
                    {!! $settings['page_waktu'] ?? '<p class="text-slate-500 italic">Informasi waktu pelayanan belum tersedia.</p>' !!}
                </div>
            </div>

            {{-- Card 2: Biaya Pelayanan --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden transform transition-all hover:shadow-2xl hover:shadow-slate-200/60 duration-300">
                <div class="p-6 md:p-8 bg-slate-50 border-b border-slate-100 flex flex-col md:flex-row items-start md:items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0 shadow-lg border border-slate-800" style="background-color: #0f172a; color: #ffffff;">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-[#0f172a] brand-font tracking-tight">Biaya Pelayanan</h2>
                        <p class="text-sm text-slate-400 mt-1">Informasi biaya perolehan salinan informasi publik</p>
                    </div>
                </div>
                
                <div class="p-6 md:p-8 prose prose-slate max-w-none prose-headings:brand-font prose-headings:font-bold prose-headings:text-[#0f172a] prose-a:text-indigo-600 hover:prose-a:text-indigo-500 prose-img:rounded-xl">
                    {!! $settings['page_biaya'] ?? '<p class="text-slate-500 italic">Informasi biaya pelayanan belum tersedia.</p>' !!}
                </div>
            </div>

            <!-- Other Standar Pelayanan Menus -->
            <div class="pt-8">
                <h3 class="text-lg font-bold text-slate-800 brand-font mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Standar Pelayanan Lainnya
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @php
                        $menus = [
                                ['url' => route('profil.ppid'), 'label' => 'Profil PPID'],
                                ['url' => route('profil.tugas_fungsi'), 'label' => 'Tugas & Fungsi'],
                                ['url' => route('profil.struktur'), 'label' => 'Struktur Organisasi'],
                                ['url' => route('standar.prosedur_pelayanan'), 'label' => 'Prosedur Pelayanan'],
                                ['url' => route('standar.waktu_biaya'), 'label' => 'Waktu & Biaya Layanan'],
                                ['url' => route('standar.prosedur_keberatan'), 'label' => 'Prosedur Keberatan'],
                        ];
                    @endphp
                    @foreach($menus as $menu)
                        <a href="{{ $menu['url'] }}" class="group bg-white border border-slate-200 rounded-xl p-4 flex items-center justify-between hover:border-indigo-300 hover:shadow-md hover:shadow-indigo-100/50 transition-all {{ request()->url() == $menu['url'] ? 'ring-2 ring-indigo-500 border-indigo-500 shadow-md shadow-indigo-100' : '' }}">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg {{ request()->url() == $menu['url'] ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-500 group-hover:bg-indigo-50 group-hover:text-indigo-600' }} flex items-center justify-center transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                                <p class="text-sm font-bold {{ request()->url() == $menu['url'] ? 'text-indigo-700' : 'text-slate-700 group-hover:text-indigo-700' }} transition-colors">{{ $menu['label'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- Right Column: Sidebar --}}
        <aside class="lg:col-span-4 xl:col-span-3 space-y-6">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 sticky top-24">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 brand-font text-lg">Artikel Lainnya</h3>
                </div>

                <div class="space-y-5">
                    @forelse($publications as $article)
                        <a href="{{ route('publikasi.show', $article->slug) }}" class="group flex gap-4 items-start">
                            <div class="w-20 h-20 rounded-xl bg-slate-100 flex-shrink-0 overflow-hidden relative">
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-100">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 brand-font line-clamp-2 leading-snug group-hover:text-indigo-600 transition-colors mb-2">
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
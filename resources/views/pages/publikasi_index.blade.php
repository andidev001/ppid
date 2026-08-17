@extends('layouts.public')

@section('content')
    <div class="bg-slate-900 pb-32 pt-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05] text-white">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pattern-publikasi" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path
                            d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                            fill="currentColor"></path>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-publikasi)"></rect>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-2xl md:text-4xl font-extrabold text-white brand-font tracking-tight mb-4">
                Publikasi {{ ucfirst($type) }}
            </h1>
            <p class="text-indigo-100 max-w-2xl mx-auto text-base">Kumpulan informasi dan publikasi terkini seputar
                {{ $type }} dari PPID.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 lg:-mt-24 relative z-20 pb-20">
        @if($publications->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($publications as $item)
                    <div onclick="window.location.href='{{ route('publikasi.show', $item->slug) }}'"
                        class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 overflow-hidden flex flex-col group cursor-pointer relative">
                        <div class="h-48 lg:h-56 overflow-hidden relative bg-slate-100">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 flex gap-2">
                                <span
                                    class="px-3 py-1 bg-indigo-600/90 backdrop-blur text-white text-[10px] font-bold uppercase tracking-wider rounded-lg shadow-sm">
                                    {{ $item->type }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex flex-wrap items-center gap-4 text-xs text-slate-400 mb-3 font-medium">
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-indigo-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $item->created_at->format('d M Y') }}</span>
                                <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-indigo-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    {{ $item->views }} views</span>
                            </div>
                            <h3
                                class="text-lg font-bold text-slate-800 brand-font mb-3 leading-snug group-hover:text-indigo-600 transition-colors line-clamp-2">
                                {{ $item->title }}
                            </h3>
                            <p class="text-slate-500 text-sm line-clamp-3 mb-6 flex-grow">
                                {{ strip_tags($item->content) }}
                            </p>
                            <a href="{{ route('publikasi.show', $item->slug) }}"
                                class="inline-flex items-center text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors mt-auto group/link brand-font">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $publications->links() }}
            </div>
        @else
            <div class="bg-white rounded-3xl border border-slate-200 border-dashed p-16 text-center shadow-sm">
                <div class="mx-auto w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6 shadow-inner">
                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-800 brand-font mb-2">Belum Ada {{ ucfirst($type) }}</h3>
                <p class="text-slate-500 max-w-sm mx-auto text-sm">Saat ini belum ada publikasi {{ $type }} yang ditayangkan ke
                    publik.</p>
            </div>
        @endif
    </div>
@endsection
@extends('layouts.public')

@section('content')

{{-- Header Section --}}
<div class="bg-slate-900 pb-20 pt-28 relative overflow-hidden">
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
        <span class="text-orange-400 font-bold tracking-wider uppercase text-sm mb-4 block">Kumpulan Visual & Podcast</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-white brand-font tracking-tight mb-4">Galeri Video</h1>
        <p class="text-indigo-100 max-w-2xl mx-auto text-lg">
            Saksikan berbagai dokumentasi, informasi publik, podcast, dan edukasi dari PPID kami.
        </p>
    </div>
</div>

<div class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($videos as $vid)
                <a href="{{ $vid->youtube_url }}" target="_blank" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 block translate-y-0 hover:-translate-y-1">
                    <div class="relative w-full aspect-video overflow-hidden bg-slate-900">
                        @if($vid->youtube_id)
                            <img src="https://img.youtube.com/vi/{{ $vid->youtube_id }}/maxresdefault.jpg" onerror="this.src='https://img.youtube.com/vi/{{ $vid->youtube_id }}/hqdefault.jpg'" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="Thumbnail">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-slate-700" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        @endif
                        
                        <!-- Overlay Play Info -->
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center group-hover:bg-black/10 transition-colors">
                            <div class="w-16 h-16 bg-red-600/90 backdrop-blur-sm rounded-full flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                        
                        <div class="absolute bottom-3 left-3 flex gap-2">
                            <span class="bg-black/70 backdrop-blur text-white text-[10px] font-bold px-2 py-1 rounded">YOUTUBE</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="font-bold text-slate-800 text-lg group-hover:text-indigo-600 transition-colors line-clamp-2 leading-tight">
                            {{ $vid->title }}
                        </h3>
                        <p class="text-slate-500 text-sm mt-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Diunggah {{ $vid->created_at->diffForHumans() }}
                        </p>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700">Belum ada video</h3>
                    <p class="text-slate-500 mt-2">Daftar galeri video edukasi masih kosong.</p>
                </div>
            @endforelse
        </div>
        
        @if($videos->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $videos->links() }}
            </div>
        @endif
        
    </div>
</div>

@endsection


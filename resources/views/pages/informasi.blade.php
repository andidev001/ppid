@extends('layouts.public')

@section('content')
<div x-data="{ showPreview: false, previewUrl: '' }">
    <div class="bg-slate-900 pb-32 pt-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05] text-white">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pattern-informasi" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z" fill="currentColor"></path>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-informasi)"></rect>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white brand-font tracking-tight mb-4">{{ $kategoriLabel }}</h1>
            <p class="text-indigo-100 max-w-2xl mx-auto text-lg">Daftar lengkap seluruh dokumen publik pada kategori ini.</p>
        </div>
    </div>

    <!-- Main Content Area with Table -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 mb-16">
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden transform transition-all group">
            
            <div class="p-6 md:p-8 bg-slate-50/50 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4 w-full md:w-auto">
                    <div class="w-12 h-12 rounded-2xl bg-[#f8f5ff] text-[#9333ea] flex items-center justify-center shrink-0 shadow-sm border border-[#f3e8ff]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-black text-[#0f172a] brand-font tracking-tight">{{ $kategoriLabel }}</h2>
                </div>
                
                <form action="{{ route('informasi.kategori', $kategori) }}" method="GET" class="w-full md:w-auto search-form">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari informasi..." class="w-full md:w-72 pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#9333ea] focus:border-[#9333ea] transition-all font-medium text-sm shadow-sm hover:border-slate-300">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="bg-indigo-50/50 text-indigo-700 text-sm font-semibold brand-font border-b border-indigo-100/50">
                            <th class="px-6 py-4 w-16 text-center">No</th>
                            <th class="px-6 py-4 w-5/12">Judul Dokumen</th>
                            <th class="px-6 py-4">Keterangan Singkat</th>
                            <th class="px-6 py-4 text-center w-48">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-100">
                        @forelse($informations as $index => $info)
                            @php
                                $ext = strtolower(pathinfo($info->file_path, PATHINFO_EXTENSION));
                                $isPdf = $ext === 'pdf';
                            @endphp
                            <tr class="hover:bg-slate-50 transition-colors group/row">
                                <td class="px-6 py-5 text-slate-400 text-center font-mono">{{ $informations->firstItem() + $index }}</td>
                                <td class="px-6 py-5 font-bold text-slate-800">{{ $info->title }}</td>
                                <td class="px-6 py-5 text-slate-500 leading-relaxed">{{ Str::limit($info->description, 80) }}</td>
                                <td class="px-6 py-5 text-center">
                                    @if($info->visibility === 'restricted')
                                        <a href="{{ route('pilih_permohonan') }}" class="inline-flex items-center justify-center text-xs px-4 py-2 bg-rose-50 text-rose-700 rounded-lg font-bold hover:bg-rose-100 transition-colors border border-rose-100 w-full whitespace-nowrap">
                                            Ajukan Akses
                                        </a>
                                    @else
                                        <div class="flex items-center justify-center gap-2">
                                            @if($isPdf)
                                                <button @click.prevent="showPreview = true; loadPdfViewer('{{ asset('storage/' . $info->file_path) }}')" class="px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-bold hover:bg-indigo-100 transition-colors w-full flex items-center justify-center gap-1.5 cursor-pointer"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Lihat Dokumen</button>
                                            @else
                                                <button @click.prevent="showPreview = true; loadPdfViewer('{{ asset('storage/' . $info->file_path) }}')" class="px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg text-xs font-bold hover:bg-indigo-100 transition-colors w-full flex items-center justify-center gap-1.5 cursor-pointer"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg> Lihat Dokumen</button>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 mb-4">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-slate-800 font-bold mb-1">Data Tidak Ditemukan</h3>
                                    <p class="text-slate-500 text-sm">Coba cari dengan kata kunci yang berbeda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($informations->hasPages())
                <div class="px-6 py-5 bg-slate-50/80 border-t border-slate-100">
                    {{ $informations->appends(request()->query())->links() }}
                </div>
            @endif
        </div>

        <!-- PDF Preview Modal -->
        @include('components.pdf-viewer-modal')
    </div>
</div>

    <!-- Script to maintain scroll state if search -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let form = document.querySelector('.search-form');
            if(form) {
                form.addEventListener('submit', function() {
                    let input = form.querySelector('input');
                    input.classList.add('opacity-50');
                });
            }
        });
    </script>
@endsection

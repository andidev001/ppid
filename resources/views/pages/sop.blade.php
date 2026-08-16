@extends('layouts.public')
@section('content')
    <div class="bg-slate-900 pb-32 pt-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05] text-white">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pattern-sop" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z" fill="currentColor"></path>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-sop)"></rect>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white brand-font tracking-tight mb-4">SOP Layanan</h1>
            <p class="text-indigo-100 max-w-2xl mx-auto text-lg">Pusat Informasi Data dan Dokumen Resmi Portal PPID kami.</p>
        </div>
    </div>

    <div class='max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 pb-20'>
    <div class='bg-white rounded-3xl shadow-xl shadow-slate-200/50 p-8 sm:p-12 border border-slate-100'>
        
        <div class='prose prose-slate max-w-none prose-headings:brand-font prose-headings:text-slate-800'>
            @if(isset($settings['page_sop']) && !empty($settings['page_sop']))
                {!! $settings['page_sop'] !!}
            @else
                <p class='lead text-lg text-slate-600 mb-6'>Bagian ini berisi informasi mengenai SOP Layanan.</p>
                <p>Halaman ini sedang dalam tahap pengembangan dan belum diisi oleh Administrator. Konten akan diperbarui segera.</p>
            @endif
        </div>
    </div>
</div>
@endsection
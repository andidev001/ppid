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
                Detail Publikasi
            </h1>
            <p class="text-indigo-100 max-w-2xl mx-auto text-lg">Membaca arsip berita dan dokumentasi terperinci.</p>
        </div>
    </div>

    <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 pb-20 w-full grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10">
        {{-- Left Column: Article + Comments --}}
        <div class="lg:col-span-8 xl:col-span-9 flex flex-col gap-6">
            <!-- Main Article -->
            <article class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                @if($publication->image)
                    <div class="w-full h-72 sm:h-80 md:h-[400px] bg-slate-100 relative overflow-hidden">
                        <img src="{{ asset('storage/' . $publication->image) }}" alt="{{ $publication->title }}"
                            class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="p-6 sm:p-10 lg:p-12">
                    <div class="flex flex-wrap items-center gap-4 mb-6">
                        <span
                            class="inline-flex items-center px-4 py-1.5 rounded-full bg-indigo-50 text-indigo-700 font-bold text-sm tracking-wide border border-indigo-100">
                            {{ ucfirst($publication->type) }}
                        </span>
                        <span class="flex items-center text-sm text-slate-500 font-medium">
                            <svg class="w-5 h-5 mr-1.5 text-slate-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            {{ $publication->created_at->format('d M Y') }}
                        </span>
                        <span class="flex items-center text-sm text-slate-500 font-medium">
                            <svg class="w-5 h-5 mr-1.5 text-slate-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            {{ $publication->views }}x dilihat
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-semibold text-slate-800 brand-font mb-6 leading-relaxed">
                        {{ $publication->title }}
                    </h1>

                    <div class="prose max-w-none text-base text-slate-600 leading-loose">
                        {!! $publication->content !!}
                    </div>

                                    <!-- Bagikan Artikel -->
                <div class="bg-indigo-50/50 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-6 border border-indigo-100/50 mt-12 mb-2">
                    <div>
                        <h4 class="text-indigo-950 font-bold mb-1 text-sm uppercase tracking-wider">Bagikan Publikasi Ini</h4>
                        <p class="text-xs font-semibold text-slate-500">Sebarkan informasi ini ke jejaring sosial Anda.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($publication->title . ' - ' . request()->url()) }}" target="_blank"
                            class="w-10 h-10 rounded-xl bg-white border border-[#25D366]/20 text-[#25D366] hover:bg-[#25D366] hover:text-white flex items-center justify-center transition-all shadow-sm hover:shadow-[#25D366]/30 group" title="Bagikan ke WhatsApp">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 21.488a10.021 10.021 0 01-5.111-1.39l-5.69 1.492 1.517-5.545a10.016 10.016 0 119.284 5.443z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/><path d="M16 14.5c-.26-.13-1.54-.76-1.78-.85-.24-.09-.42-.13-.6.13-.18.26-.68.85-.83 1.02-.15.17-.31.19-.57.06-.26-.13-1.1-.41-2.1-1.3-3.1-2.73-3.41-3.26-3.41-3.26s-.04-.08 0-.16c.03-.06.13-.15.19-.23.06-.08.08-.13.13-.22.04-.09.02-.17-.02-.23-.04-.06-.6-1.44-.82-1.97-.21-.52-.43-.45-.6-.46-.15-.01-.33-.01-.51-.01-.18 0-.48.06-.72.33-.24.26-.92.9-.92 2.19s.94 2.54 1.07 2.72c.13.18 1.86 2.84 4.5 3.98.63.27 1.12.43 1.5.55.63.2 1.2.17 1.65.1.51-.08 1.54-.63 1.76-1.24.22-.61.22-1.13.15-1.24-.06-.09-.23-.15-.49-.28z"/></svg>
                        </a>
                        <!-- FB -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"
                            class="w-10 h-10 rounded-xl bg-white border border-[#1877F2]/20 text-[#1877F2] hover:bg-[#1877F2] hover:text-white flex items-center justify-center transition-all shadow-sm hover:shadow-[#1877F2]/30 group" title="Bagikan ke Facebook">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/></svg>
                        </a>
                        <!-- Twitter/X -->
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($publication->title) }}" target="_blank"
                            class="w-10 h-10 rounded-xl bg-white border border-slate-800/20 text-slate-800 hover:bg-slate-800 hover:text-white flex items-center justify-center transition-all shadow-sm hover:shadow-slate-800/30 group" title="Bagikan ke Twitter / X">
                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <!-- Native Share OS (Including Instagram Stories/Direct on Mobile) -->
                        <button onclick="navigator.share({ title: '{{ addslashes($publication->title) }}', url: '{{ request()->url() }}' }).catch(console.error);"
                            class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-400 via-rose-500 to-purple-600 text-white flex items-center justify-center transition-all shadow-md hover:shadow-rose-500/40 hover:-translate-y-0.5 group" title="Share via Device / Instagram">
                            <!-- Instagram SVG Logo here! -->
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </button>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Ditulis Oleh</p>
                                <p class="text-sm font-bold text-slate-700">Admin PPID</p>
                            </div>
                        </div>
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 text-sm font-bold rounded-xl text-slate-600 hover:bg-slate-50 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Ke Beranda
                        </a>
                    </div>
                </div>
            </article>

            {{-- ====== COMMENT SECTION (below article, full-width) ====== --}}
            <section>

                {{-- Success notification --}}
                @if(session('comment_success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <p class="text-sm font-medium text-emerald-700">{{ session('comment_success') }}</p>
                    </div>
                @endif

                {{-- Comment list --}}
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 sm:p-10 mb-6">
                    <h2 class="text-xl font-bold text-slate-800 brand-font mb-6 flex items-center gap-3">
                        <span
                            class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                                </path>
                            </svg>
                        </span>
                        Komentar
                        <span class="text-sm font-semibold text-slate-400">({{ $comments->count() }})</span>
                    </h2>

                    @if($comments->isEmpty())
                        <p class="text-sm text-slate-400 text-center py-8">Belum ada komentar. Jadilah yang pertama berkomentar!
                        </p>
                    @else
                        <div class="space-y-6">
                            @foreach($comments as $comment)
                                <div class="flex gap-4 items-start">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-400 to-indigo-600 text-white font-bold flex items-center justify-center shrink-0 uppercase text-sm">
                                        {{ substr($comment->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1 bg-slate-50 rounded-2xl p-4">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="font-bold text-slate-800 text-sm">{{ $comment->name }}</span>
                                            <span class="text-xs text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-slate-600 leading-relaxed">{{ $comment->body }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Comment Form --}}
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 sm:p-10">
                    <h3 class="text-lg font-bold text-slate-800 brand-font mb-6">Tinggalkan Komentar</h3>

                    @if($errors->any())
                        <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200">
                            <ul class="list-disc list-inside text-sm text-rose-600 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('comments.store', $publication->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama <span
                                        class="text-rose-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    class="w-full rounded-xl border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50 text-sm placeholder:text-slate-400"
                                    placeholder="Masukkan nama Anda">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1.5">Email <span
                                        class="text-slate-400 font-normal">(Opsional)</span></label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="w-full rounded-xl border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50 text-sm placeholder:text-slate-400"
                                    placeholder="nama@email.com">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Komentar <span
                                    class="text-rose-500">*</span></label>
                            <textarea name="body" rows="4" required
                                class="w-full rounded-xl border-slate-200 focus:ring-indigo-500 focus:border-indigo-500 bg-slate-50 text-sm placeholder:text-slate-400 resize-none"
                                placeholder="Tuliskan komentar atau pertanyaan Anda...">{{ old('body') }}</textarea>
                        </div>
                        <p class="text-xs text-slate-400">Komentar akan ditampilkan setelah melalui proses peninjauan oleh
                            admin.</p>
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-md shadow-indigo-200 hover:shadow-indigo-300 transition-all active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Komentar
                        </button>
                    </form>
                </div>

            </section>
        </div>{{-- /Left Column --}}

        <!-- Sidebar -->
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
                    @forelse($otherArticles as $article)
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
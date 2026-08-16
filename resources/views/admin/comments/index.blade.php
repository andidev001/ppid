<x-app-layout>
    <x-slot name="header">Kelola Komentar</x-slot>

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 brand-font">Kelola Komentar</h1>
                <p class="text-sm text-slate-500 mt-1">Moderasi komentar dari pengunjung pada halaman publikasi.</p>
            </div>
            <div class="flex gap-2 self-start">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-100 text-amber-700 text-sm font-semibold">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    {{ $pendingCount }} Menunggu
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-100 text-emerald-700 text-sm font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    {{ $approvedCount }} Disetujui
                </span>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-xl w-fit">
            <a href="{{ route('admin.comments.index', ['status' => 'pending']) }}"
                class="px-5 py-2 text-sm font-semibold rounded-lg transition-all {{ $status === 'pending' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                Menunggu Persetujuan
            </a>
            <a href="{{ route('admin.comments.index', ['status' => 'approved']) }}"
                class="px-5 py-2 text-sm font-semibold rounded-lg transition-all {{ $status === 'approved' ? 'bg-white text-slate-800 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                Sudah Disetujui
            </a>
        </div>

        {{-- Comment Cards --}}
        @if($comments->isEmpty())
            <div class="text-center py-24 bg-white rounded-2xl border border-slate-100 shadow-sm">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <p class="text-slate-500 font-medium">Belum ada komentar {{ $status === 'pending' ? 'yang menunggu persetujuan' : 'yang disetujui' }}.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($comments as $comment)
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 sm:p-6 flex flex-col sm:flex-row gap-4">
                        {{-- Avatar --}}
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 font-bold text-lg flex items-center justify-center shrink-0 uppercase">
                            {{ substr($comment->name, 0, 1) }}
                        </div>

                        {{-- Content --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mb-2">
                                <span class="font-bold text-slate-800">{{ $comment->name }}</span>
                                @if($comment->email)
                                    <span class="text-xs text-slate-400">{{ $comment->email }}</span>
                                @endif
                                <span class="text-xs text-slate-400">·</span>
                                <span class="text-xs text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>

                            <p class="text-slate-700 text-sm leading-relaxed mb-3">{{ $comment->body }}</p>

                            <div class="flex flex-wrap items-center gap-2">
                                <a href="{{ route('publikasi.show', $comment->publication->slug ?? '#') }}" target="_blank"
                                    class="inline-flex items-center gap-1.5 text-xs font-medium text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    {{ Str::limit($comment->publication->title ?? 'Publikasi', 50) }}
                                </a>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex sm:flex-col gap-2 shrink-0">
                            @if(!$comment->is_approved)
                                <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm shadow-emerald-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                        Setujui
                                    </button>
                                </form>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-emerald-50 text-emerald-700 text-sm font-semibold rounded-xl border border-emerald-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    Disetujui
                                </span>
                            @endif

                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2 bg-white hover:bg-rose-50 text-rose-500 hover:text-rose-600 border border-rose-200 text-sm font-semibold rounded-xl transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $comments->appends(request()->query())->links() }}
            </div>
        @endif

    </div>
</x-app-layout>
@extends('layouts.public')

@section('content')
    <div class="bg-slate-900 pb-32 pt-16 relative overflow-hidden">
        <!-- Abstract pattern -->
        <div class="absolute inset-0 opacity-[0.05] text-white">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pattern-cek" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path
                            d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                            fill="currentColor"></path>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-cek)"></rect>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white brand-font tracking-tight mb-4">Lacak Status
                Permohonan</h1>
            <p class="text-indigo-100 max-w-2xl mx-auto text-lg">Pantau sejauh mana proses permohonan informasi publik Anda
                dengan memasukkan Nomor Registrasi/Pendaftaran.</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 pb-20">
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-8 sm:p-10 mb-8">
            <form action="{{ route('cek_status') }}" method="GET" class="flex flex-col md:flex-row gap-4 max-w-2xl mx-auto">
                <div class="flex-1 relative">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Contoh: REQ-202611..."
                        class="block w-full pl-6 pr-14 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-mono font-bold text-sm tracking-wide uppercase"
                        required>
                    <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <button type="submit"
                    class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 brand-font flex items-center justify-center gap-2">
                    Cari Tiket
                </button>
            </form>
        </div>

        @if(request('keyword'))
            @if($requestData)
                <div
                    class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden transform transition-all">
                    <div
                        class="p-6 sm:p-8 bg-slate-50/50 border-b border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1 block">Nomor
                                Registrasi</span>
                            <h3 class="text-2xl font-black text-indigo-700 font-mono tracking-tight">
                                {{ $requestData->registration_number }}
                            </h3>
                        </div>
                        <div class="text-right flex items-center gap-3">
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider hidden md:block">Status Saat
                                Ini</span>
                            @if ($requestData->status == 'pending') <span
                                class="px-4 py-2 text-sm rounded-full bg-amber-100 text-amber-700 font-bold border border-amber-200 shadow-sm inline-flex items-center gap-1.5"><svg
                                    class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg> Menunggu</span>
                            @elseif ($requestData->status == 'verified') <span
                                class="px-4 py-2 text-sm rounded-full bg-blue-100 text-blue-700 font-bold border border-blue-200 shadow-sm inline-flex items-center gap-1.5"><svg
                                    class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg> Sedang Diverifikasi</span>
                            @elseif ($requestData->status == 'approved' || $requestData->status == 'completed') <span
                                class="px-4 py-2 text-sm rounded-full bg-emerald-100 text-emerald-700 font-bold border border-emerald-200 shadow-sm inline-flex items-center gap-1.5"><svg
                                    class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                                    </path>
                                </svg> Selesai / Disetujui</span>
                            @elseif ($requestData->status == 'rejected') <span
                                class="px-4 py-2 text-sm rounded-full bg-rose-100 text-rose-700 font-bold border border-rose-200 shadow-sm inline-flex items-center gap-1.5"><svg
                                    class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg> Ditolak</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-6 sm:p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <span
                                    class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2 block">Pemohon</span>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm uppercase">
                                        {{ substr($requestData->user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-800">{{ $requestData->user->name }}</div>
                                        <div class="text-[13px] text-slate-500">{{ $requestData->user->email }}</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2 block">Tanggal
                                    Pengajuan</span>
                                <div class="font-medium text-slate-700">
                                    {{ $requestData->created_at->translatedFormat('l, d F Y - H:i') }} WIB
                                </div>
                            </div>
                        </div>

                        <hr class="border-slate-100">

                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2 block">Rincian Informasi
                                / Subjek</span>
                            <div class="text-slate-800 font-semibold mb-2 bg-slate-50 p-4 rounded-xl border border-slate-100">
                                {{ $requestData->subject }}
                            </div>
                        </div>

                        @if($requestData->status == 'rejected' && $requestData->rejection_reason)
                            <div class="bg-rose-50 border border-rose-100 rounded-xl p-4 flex gap-4">
                                <div class="text-rose-500 shrink-0 mt-0.5"><svg class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg></div>
                                <div>
                                    <h4 class="text-sm font-bold text-rose-800 mb-1">Alasan Penolakan</h4>
                                    <p class="text-sm text-rose-700">{{ $requestData->rejection_reason }}</p>
                                </div>
                            </div>
                        @endif

                        @if($requestData->status == 'approved' || $requestData->status == 'completed')
                            @if($requestData->response_file)
                                <div class="mt-4 flex">
                                    <a href="{{ asset('storage/' . $requestData->response_file) }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 text-white rounded-xl font-bold hover:bg-emerald-600 transition shadow-lg shadow-emerald-200 w-full sm:w-auto justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        Unduh Dokumen Balasan
                                    </a>
                                </div>
                            @else
                                <div
                                    class="mt-4 bg-emerald-50 border-emerald-100 border p-4 rounded-xl text-center text-emerald-700 font-semibold text-sm">
                                    Permohonan Disetujui. Dokumen/Salinan informasi sedang disiapkan oleh petugas kami.
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-12 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 3h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 brand-font mb-2">Tiket Tidak Ditemukan!</h3>
                    <p class="text-slate-500 max-w-md mx-auto">Kami tidak dapat menemukan data permohonan dengan Nomor Registrasi
                        <b>{{ request('keyword') }}</b>. Pastikan nomor yang dimasukkan sudah benar.
                    </p>
                </div>
            @endif
        @endif
    </div>
@endsection
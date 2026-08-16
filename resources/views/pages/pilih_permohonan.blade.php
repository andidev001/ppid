@extends('layouts.public')

@section('content')
    <!-- Header Banner -->
    <div class="bg-slate-900 pb-32 pt-16 relative overflow-hidden">
        <!-- Abstract pattern -->
        <div class="absolute inset-0 opacity-[0.05] text-white">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pattern-pilih" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z" fill="currentColor"></path>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-pilih)"></rect>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white brand-font tracking-tight mb-4">Pilih Jenis Pemohon Informasi</h1>
            <p class="text-indigo-100 max-w-2xl mx-auto text-lg">Sebelum melanjutkan ke formulir permohonan informasi, silakan pilih profil pemohon yang paling sesuai dengan identitas Anda.</p>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 mb-16">
        <!-- Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 xl:gap-8">

            <!-- Perorangan -->
            @auth
            <a href="{{ route('requests.create', ['type' => 'perorangan']) }}"
            @else
            <a href="#" @click.prevent="$dispatch('open-register-modal-perorangan')"
            @endauth
                class="group flex flex-col h-full bg-white rounded-3xl p-8 sm:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 hover:border-indigo-200 hover:shadow-indigo-100/50 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 p-8 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 -translate-x-4 transition-all duration-300">
                    <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </div>

                <div
                    class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-8 border border-indigo-100/50 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>

                <h3 class="text-2xl font-bold text-slate-800 brand-font mb-3 group-hover:text-indigo-600 transition-colors">
                    Permohonan Perorangan</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6 font-medium flex-grow">Pengajuan informasi yang mengatasnamakan
                    diri sendiri secara pribadi. Syarat utama cukup melampirkan salinan Kartu Tanda Penduduk (KTP).</p>

                <span
                    class="inline-flex items-center text-indigo-600 font-semibold text-sm brand-font group-hover:text-indigo-700 mt-auto">
                    Pilih Perorangan
                    <svg class="w-4 h-4 ml-1.5 transition-transform group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </a>

            <!-- Lembaga / Instansi -->
            @auth
            <a href="{{ route('requests.create', ['type' => 'lembaga']) }}"
            @else
            <a href="#" @click.prevent="$dispatch('open-register-modal-lembaga')"
            @endauth
                class="group flex flex-col h-full bg-white rounded-3xl p-8 sm:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 hover:border-blue-200 hover:shadow-blue-100/50 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 p-8 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 -translate-x-4 transition-all duration-300">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </div>

                <div
                    class="w-20 h-20 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-8 border border-blue-100/50 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>

                <h3 class="text-2xl font-bold text-slate-800 brand-font mb-3 group-hover:text-blue-600 transition-colors">
                    Permohonan Instansi</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6 font-medium flex-grow">Pengajuan yang mewakili lembaga, LSM,
                    ormas, atau badan hukum. Membutuhkan lampiran surat pengesahan badan hukum dan surat kuasa.</p>

                <span
                    class="inline-flex items-center text-blue-600 font-semibold text-sm brand-font group-hover:text-blue-700 mt-auto">
                    Pilih Lembaga/Instansi
                    <svg class="w-4 h-4 ml-1.5 transition-transform group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </a>

            <!-- Organisasi Bukan Lembaga -->
            @auth
            <a href="{{ route('requests.create', ['type' => 'organisasi']) }}"
            @else
            <a href="#" @click.prevent="$dispatch('open-register-modal-organisasi')"
            @endauth
                class="group flex flex-col h-full bg-white rounded-3xl p-8 sm:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 hover:border-emerald-200 hover:shadow-emerald-100/50 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 p-8 opacity-0 group-hover:opacity-100 group-hover:translate-x-2 -translate-x-4 transition-all duration-300">
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </div>

                <div
                    class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-8 border border-emerald-100/50 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5V4H2v16h5m10 0v-5H7v5m10 0H7m5-10v5">
                        </path>
                    </svg>
                </div>

                <h3 class="text-xl md:text-2xl font-bold text-slate-800 brand-font mb-3 group-hover:text-emerald-600 transition-colors">
                    Permohonan Organisasi Bukan Lembaga</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6 font-medium flex-grow">Pengajuan yang mewakili komunitas atau organisasi non-badan hukum. Membutuhkan lampiran KTP 5 orang anggota.</p>

                <span
                    class="inline-flex items-center text-emerald-600 font-semibold text-sm brand-font group-hover:text-emerald-700 mt-auto">
                    Pilih Organisasi
                    <svg class="w-4 h-4 ml-1.5 transition-transform group-hover:translate-x-1" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </a>

        </div>
    </div>

    @guest
        <x-registration-modal type="perorangan" />
        <x-registration-modal type="lembaga" />
        <x-registration-modal type="organisasi" />
    @endguest
@endsection
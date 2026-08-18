@props(['settings'])

<footer class="bg-slate-900 border-t border-slate-800 mt-20 pt-16 pb-8 relative overflow-hidden">
    <!-- Background Decor -->
    <div
        class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-indigo-600/10 blur-3xl pointer-events-none">
    </div>
    <div
        class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-blue-600/10 blur-3xl pointer-events-none">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8 mb-12">

            <!-- Branding & Desc -->
            <div class="md:col-span-12 lg:col-span-5">
                <div class="flex items-center gap-3 mb-6">
                    @if (!empty($settings['app_logo']))
                        <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="Logo"
                            class="h-12 w-auto object-contain drop-shadow-md">
                    @else
                        <div
                            class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-indigo-500/30">
                            P
                        </div>
                        <span class="font-bold text-white brand-font text-xl tracking-wide">
                            {{ $settings['app_name'] ?? 'PPID Portal' }}
                        </span>
                    @endif
                </div>
                <p class="text-slate-400 text-sm leading-relaxed mb-6 max-w-md">
                    {{ $settings['app_description'] ?? 'Portal resmi Pejabat Pengelola Informasi dan Dokumentasi (PPID) untuk mewujudkan tata kelola yang transparan, mudah, dan akuntabel dalam pelayanan informasi publik.' }}
                </p>
            </div>

            <!-- Hubungi Kami -->
            <div class="md:col-span-6 lg:col-span-4">
                <h3 class="text-white font-bold brand-font mb-6 relative inline-block text-lg">
                    Hubungi Kami
                    <span class="absolute -bottom-2 left-0 w-8 h-1 bg-indigo-500 rounded-full"></span>
                </h3>
                <ul class="space-y-4">
                    <!-- Address -->
                    <li class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center shrink-0 border border-white/10 group hover:bg-indigo-500/20 hover:border-indigo-500/30 transition-colors">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="pt-1">
                            <p class="text-slate-200 text-sm font-medium mb-1">Alamat Kantor</p>
                            <p class="text-slate-400 text-sm leading-relaxed">
                                {{ $settings['app_address'] ?? 'Jl. Contoh Nomor 123, Komplek Pemerintahan, Kota Masa Depan, 12345' }}
                            </p>
                        </div>
                    </li>

                    <!-- Phone -->
                    <li class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center shrink-0 border border-white/10 group hover:bg-emerald-500/20 hover:border-emerald-500/30 transition-colors">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-200 text-sm font-medium mb-1">Telepon</p>
                            <a href="tel:{{ $settings['app_phone'] ?? '(021) 1234567' }}"
                                class="text-slate-400 text-sm hover:text-emerald-400 transition-colors">
                                {{ $settings['app_phone'] ?? '(021) 1234567' }}
                            </a>
                        </div>
                    </li>

                    <!-- Email -->
                    <li class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center shrink-0 border border-white/10 group hover:bg-blue-500/20 hover:border-blue-500/30 transition-colors">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-200 text-sm font-medium mb-1">Email Resmi</p>
                            <a href="mailto:{{ $settings['app_email'] ?? 'ppid@example.com' }}"
                                class="text-slate-400 text-sm hover:text-blue-400 transition-colors">
                                {{ $settings['app_email'] ?? 'ppid@example.com' }}
                            </a>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Tautan Cepat -->
            <div class="md:col-span-6 lg:col-span-3">
                <h3 class="text-white font-bold brand-font mb-6 relative inline-block text-lg">
                    Tautan Cepat
                    <span class="absolute -bottom-2 left-0 w-8 h-1 bg-blue-500 rounded-full"></span>
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}"
                            class="text-slate-400 text-sm hover:text-white hover:translate-x-1 inline-block transition-all flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                            Beranda Publik
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pilih_permohonan') }}"
                            class="text-slate-400 text-sm hover:text-white hover:translate-x-1 inline-block transition-all flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                            Permohonan Informasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}"
                            class="text-slate-400 text-sm hover:text-white hover:translate-x-1 inline-block transition-all flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                            Portal Admin
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profil.ppid') }}"
                            class="text-slate-400 text-sm hover:text-white hover:translate-x-1 inline-block transition-all flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                            Profil PPID
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-slate-500 text-sm font-medium">
                &copy; <?= date('Y') ?> <span
                    class="text-slate-400">{{ $settings['app_name'] ?? 'PPID Terintegrasi' }}</span>. Hak Cipta
                Dilindungi Undang-Undang.
            </p>
        </div>
    </div>
</footer>
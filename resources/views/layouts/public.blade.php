<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon"
        href="{{ isset($settings['app_logo']) && $settings['app_logo'] ? asset('storage/' . $settings['app_logo']) : asset('favicon.ico') }}">
    <title>{{ $settings['app_name'] ?? 'PPID - Portal Informasi Publik' }} - Beranda PPID</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .brand-font {
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.02em;
        }

        .glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Perbaikan styling Prose Tailwind untuk TinyMCE */
        .prose ul {
            list-style-type: disc !important;
            padding-left: 1.5rem !important;
        }

        .prose ol {
            list-style-type: decimal !important;
            padding-left: 1.5rem !important;
        }

        .prose li {
            display: list-item !important;
            margin-bottom: 0.25rem !important;
        }
    </style>
</head>

<body
    class="antialiased min-h-screen flex flex-col text-slate-800 selection:bg-indigo-500 selection:text-white relative"
    x-data="{ mobileMenuOpen: false }">
    <!-- Navbar -->
    <nav class="glass sticky top-0 z-50 border-b border-white/20 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    @if(isset($settings['app_logo']) && $settings['app_logo'])
                        <div
                            class="w-10 h-10 rounded-xl bg-white border border-slate-100 flex items-center justify-center p-1 cursor-pointer hover:scale-105 transition-transform z-10">
                            <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="Logo"
                                class="max-h-full max-w-full object-contain">
                        </div>
                    @else
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 cursor-pointer hover:scale-105 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                    @endif
                    <span
                        class="text-lg sm:text-xl font-bold brand-font bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-indigo-800 tracking-tight">
                        Portal PPID
                    </span>
                </div>

                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ url('/') }}"
                        class="px-4 py-2 text-slate-600 font-medium hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition-colors text-sm">
                        Beranda
                    </a>

                    <div class="relative group" x-data="{ open: false }" @mouseleave="open = false"
                        @mouseover="open = true">
                        <button
                            class="px-4 py-2 text-slate-600 font-medium hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition-colors flex items-center gap-1 text-sm outline-none">
                            <span>Profil PPID</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute top-full left-0 mt-1 w-64 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden py-2"
                            style="display: none;" @click.away="open = false">
                            <a href="{{ route('profil.ppid') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Profil
                                PPID</a>
                            <a href="{{ route('profil.tugas_fungsi') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Tugas
                                dan Fungsi</a>
                            <a href="{{ route('profil.visi_misi') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Visi
                                Misi</a>
                            <a href="{{ route('profil.struktur') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Struktur
                                Organisasi</a>

                            <a href="{{ route('profil.maklumat') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Maklumat
                                Pelayanan</a>
                            <a href="{{ route('profil.dasar_hukum') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Dasar
                                Hukum</a>
                        </div>
                    </div>

                    <div class="relative group" x-data="{ open: false }" @mouseleave="open = false"
                        @mouseover="open = true">
                        <button
                            class="px-4 py-2 text-slate-600 font-medium hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition-colors flex items-center gap-1 text-sm outline-none">
                            <span>Standar Pelayanan</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute top-full left-0 mt-1 w-64 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden py-2"
                            style="display: none;" @click.away="open = false">

                            <a href="{{ route('standar.prosedur_pelayanan') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Prosedur
                                Pelayanan Publik</a>
                            <a href="{{ route('standar.prosedur_keberatan') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Prosedur
                                Pengajuan Keberatan</a>
                            <a href="{{ route('standar.prosedur_sengketa') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Prosedur
                                Permohonan Sengketa</a>
                            <a href="{{ route('standar.penanganan_sengketa') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Prosedur
                                Penanganan Sengketa</a>
                            <a href="{{ route('profil.sop') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">SOP
                                PPID</a>
                            <a href="{{ route('standar.kanal_layanan') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Kanal
                                Layanan PPID</a>
                            <a href="{{ route('standar.waktu_biaya') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Waktu
                                dan Biaya Layanan</a>
                        </div>
                    </div>

                    <div class="relative group" x-data="{ open: false }" @mouseleave="open = false"
                        @mouseover="open = true">
                        <button
                            class="px-4 py-2 text-slate-600 font-medium hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition-colors flex items-center gap-1 text-sm outline-none">
                            <span>Publikasi</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute top-full left-0 mt-1 w-56 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden py-2"
                            style="display: none;" @click.away="open = false">
                            <a href="{{ route('publikasi.index', 'berita') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Berita</a>
                            <a href="{{ route('publikasi.index', 'pengumuman') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Pengumuman</a>
                            <a href="{{ route('publikasi.index', 'agenda') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors border-b border-slate-100 pb-3 mb-2">Agenda</a>
                        </div>
                    </div>

                    <div class="relative group" x-data="{ open: false }" @mouseleave="open = false"
                        @mouseover="open = true">
                        <button
                            class="px-4 py-2 text-slate-600 font-medium hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition-colors flex items-center gap-1 text-sm outline-none">
                            <span>Kategori</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute top-full left-0 mt-1 w-56 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden py-2"
                            style="display: none;" @click.away="open = false">
                            <a href="{{ route('informasi.kategori', ['kategori' => 'semua']) }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Daftar
                                Informasi</a>
                            <a href="{{ route('informasi.kategori', ['kategori' => 'berkala']) }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Informasi
                                Berkala</a>
                            <a href="{{ route('informasi.kategori', ['kategori' => 'serta_merta']) }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Informasi
                                Serta Merta</a>
                            <a href="{{ route('informasi.kategori', ['kategori' => 'setiap_saat']) }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Informasi
                                Setiap Saat</a>
                            <a href="{{ route('informasi.kategori', ['kategori' => 'pengadaan']) }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Pengadaan
                                Barang dan Jasa</a>
                        </div>
                    </div>



                    <div class="relative group" x-data="{ open: false }" @mouseleave="open = false"
                        @mouseover="open = true">
                        <button
                            class="px-4 py-2 text-slate-600 font-medium hover:bg-slate-50 hover:text-indigo-600 rounded-lg transition-colors flex items-center gap-1 text-sm outline-none">
                            <span>Laporan</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute top-full left-0 mt-1 w-56 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden py-2"
                            style="display: none;" @click.away="open = false">
                            <a href="{{ route('laporan.ppid') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Laporan
                                PPID</a>
                            <a href="{{ route('laporan.survey') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Laporan
                                Hasil Survey</a>
                            <a href="{{ route('statistik') }}"
                                class="block px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">Statistik</a>

                        </div>
                    </div>

                    <a href="{{ route('cek_status') }}"
                        class="px-4 py-2 text-indigo-600 font-semibold hover:bg-indigo-50 rounded-lg transition-colors text-sm ml-2">
                        Cek Status
                    </a>
                </div>

                <div class="flex items-center space-x-3 sm:space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="px-5 py-2.5 rounded-xl bg-slate-900 text-white font-medium hover:bg-indigo-600 transition-all shadow-md hover:shadow-xl hover:shadow-indigo-200 hover:-translate-y-0.5 brand-font text-sm whitespace-nowrap">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-2.5 rounded-xl bg-slate-900 text-white font-medium hover:bg-slate-800 transition-all shadow-md hover:shadow-xl hover:shadow-slate-800 hover:-translate-y-0.5 brand-font text-sm whitespace-nowrap">Login</a>
                    @endauth

                    <!-- Mobile menu button -->
                    <div class="flex items-center md:hidden">
                        <button type="button" @click="mobileMenuOpen = !mobileMenuOpen"
                            class="inline-flex items-center justify-center p-2 rounded-md text-slate-600 hover:text-indigo-600 hover:bg-slate-100 focus:outline-none transition-colors"
                            aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Buka menu utama</span>
                            <!-- Icon menu hamburger (hilang saat menu terbuka) -->
                            <svg x-show="!mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <!-- Icon silang (tampil saat menu terbuka) -->
                            <svg x-show="mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"
                                style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                class="md:hidden absolute top-full left-0 w-full bg-white/95 backdrop-blur-md shadow-xl border-b border-slate-200"
                id="mobile-menu" @click.away="mobileMenuOpen = false" style="display: none;">

                <div class="px-4 pt-2 pb-6 space-y-1">
                    <a href="{{ url('/') }}"
                        class="block px-3 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Beranda</a>

                    <!-- Profil Dropdown (Mobile) -->
                    <div x-data="{ openProfil: false }" class="space-y-1">
                        <button @click="openProfil = !openProfil"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                            <span>Profil PPID</span>
                            <svg class="h-5 w-5 transform transition-transform" :class="{'rotate-180': openProfil}"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="openProfil" class="pl-4 pr-2 space-y-1" style="display: none;">
                            <a href="{{ route('profil.ppid') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Profil
                                PPID</a>
                            <a href="{{ route('profil.tugas_fungsi') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Tugas
                                dan Fungsi</a>
                            <a href="{{ route('profil.visi_misi') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Visi
                                Misi</a>
                            <a href="{{ route('profil.struktur') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Struktur
                                Organisasi</a>

                            <a href="{{ route('profil.maklumat') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Maklumat
                                Pelayanan</a>
                            <a href="{{ route('profil.dasar_hukum') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Dasar
                                Hukum</a>
                        </div>
                    </div>

                    <!-- Standar Pelayanan (Mobile) -->
                    <div x-data="{ openStandar: false }" class="space-y-1">
                        <button @click="openStandar = !openStandar"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                            <span>Standar Pelayanan</span>
                            <svg class="h-5 w-5 transform transition-transform" :class="{'rotate-180': openStandar}"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="openStandar" class="pl-4 pr-2 space-y-1" style="display: none;">
                            <a href="{{ route('standar.prosedur_pelayanan') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Prosedur
                                Pelayanan Publik</a>
                            <a href="{{ route('standar.prosedur_keberatan') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Prosedur
                                Pengajuan Keberatan</a>
                            <a href="{{ route('standar.prosedur_sengketa') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Prosedur
                                Permohonan Sengketa</a>
                            <a href="{{ route('standar.penanganan_sengketa') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Prosedur
                                Penanganan Sengketa</a>
                            <a href="{{ route('profil.sop') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">SOP
                                PPID</a>
                            <a href="{{ route('standar.kanal_layanan') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Kanal
                                Layanan PPID</a>
                            <a href="{{ route('standar.waktu_biaya') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Waktu
                                dan Biaya Layanan</a>
                        </div>
                    </div>

                    <!-- Publikasi Dropdown (Mobile) -->
                    <div x-data="{ openPublikasi: false }" class="space-y-1">
                        <button @click="openPublikasi = !openPublikasi"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                            <span>Publikasi</span>
                            <svg class="h-5 w-5 transform transition-transform" :class="{'rotate-180': openPublikasi}"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="openPublikasi" class="pl-4 pr-2 space-y-1" style="display: none;">
                            <a href="{{ route('publikasi.index', 'berita') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Berita</a>
                            <a href="{{ route('publikasi.index', 'pengumuman') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Pengumuman</a>
                            <a href="{{ route('publikasi.index', 'agenda') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors border-b border-slate-100 pb-3 mb-2">Agenda</a>
                        </div>
                    </div>

                    <!-- Kategori Dropdown (Mobile) -->
                    <div x-data="{ openKategori: false }" class="space-y-1">
                        <button @click="openKategori = !openKategori"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                            <span>Kategori</span>
                            <svg class="h-5 w-5 transform transition-transform" :class="{'rotate-180': openKategori}"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="openKategori" class="pl-4 pr-2 space-y-1" style="display: none;">
                            <a href="{{ route('informasi.kategori', ['kategori' => 'semua']) }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Daftar
                                Informasi</a>
                            <a href="{{ route('informasi.kategori', ['kategori' => 'berkala']) }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Informasi
                                Berkala</a>
                            <a href="{{ route('informasi.kategori', ['kategori' => 'serta_merta']) }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Informasi
                                Serta Merta</a>
                            <a href="{{ route('informasi.kategori', ['kategori' => 'setiap_saat']) }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Informasi
                                Setiap Saat</a>
                            <a href="{{ route('informasi.kategori', ['kategori' => 'pengadaan']) }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Pengadaan
                                Barang dan Jasa</a>
                        </div>
                    </div>

                    <a href="{{ route('guestbook.create') }}"
                        class="block px-3 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Buku
                        Tamu</a>
                    <!-- Laporan Dropdown (Mobile) -->
                    <div x-data="{ openLaporan: false }" class="space-y-1">
                        <button @click="openLaporan = !openLaporan"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
                            <span>Laporan</span>
                            <svg class="h-5 w-5 transform transition-transform" :class="{'rotate-180': openLaporan}"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="openLaporan" class="pl-4 pr-2 space-y-1" style="display: none;">
                            <a href="{{ route('laporan.ppid') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Laporan
                                PPID</a>
                            <a href="{{ route('laporan.survey') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Laporan
                                Hasil Survey</a>
                            <a href="{{ route('statistik') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Statistik</a>

                        </div>
                    </div>
                    <a href="{{ route('cek_status') }}"
                        class="block px-3 py-2.5 rounded-lg text-base font-medium text-indigo-600 hover:bg-indigo-50 transition-colors">Cek
                        Status</a>

                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-8 pb-16">
        @yield('content')
    </main>

    <x-public-footer :settings="$settings" />

    @yield('scripts')
</body>

</html>
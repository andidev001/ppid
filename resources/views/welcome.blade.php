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
    </style>
</head>

<body
    class="antialiased min-h-screen flex flex-col text-slate-800 selection:bg-indigo-500 selection:text-white bg-slate-50 relative"
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
                        class="text-base sm:text-lg font-bold brand-font bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-indigo-800 tracking-tight">
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
                        class="block px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Beranda</a>

                    <!-- Profil Dropdown (Mobile) -->
                    <div x-data="{ openProfil: false }" class="space-y-1">
                        <button @click="openProfil = !openProfil"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
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

                    <!-- Standar Pelayanan Dropdown (Mobile) -->
                    <div x-data="{ openStandar: false }" class="space-y-1">
                        <button @click="openStandar = !openStandar"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
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
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
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
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
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
                        class="block px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Buku
                        Tamu</a>
                    <!-- Laporan Dropdown (Mobile) -->
                    <div x-data="{ openLaporan: false }" class="space-y-1">
                        <button @click="openLaporan = !openLaporan"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:text-indigo-600 hover:bg-slate-50 transition-colors">
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
                            <a href="{{ route('statistik') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Statistik</a>
                            <a href="{{ route('survey.index') }}"
                                class="block px-3 py-2 rounded-lg text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-colors">Survey
                                Layanan</a>
                        </div>
                    </div>
                    <a href="{{ route('cek_status') }}"
                        class="block px-3 py-2.5 rounded-lg text-sm font-medium text-indigo-600 hover:bg-indigo-50 transition-colors">Cek
                        Status</a>

                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow">
        <div class="relative bg-slate-900 overflow-hidden">
            <!-- Decorative Blobs -->
            <div class="absolute top-0 left-1/2 w-full -translate-x-1/2 h-full overflow-hidden pointer-events-none">
                <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[70%] rounded-full bg-indigo-600/20 blur-[100px]">
                </div>
                <div class="absolute top-[20%] -right-[10%] w-[40%] h-[60%] rounded-full bg-blue-500/20 blur-[100px]">
                </div>
            </div>

            <!-- Foto Pimpinan (Tampil di layar besar) -->
            @if(isset($settings['app_foto_kepsek']) && $settings['app_foto_kepsek'])
                <div class="absolute left-0 hidden md:flex items-end z-0 pointer-events-none drop-shadow-2xl opacity-95 transition-opacity hover:opacity-100"
                    style="padding-left: 2rem; width: 25%; max-width: 350px; bottom: 4rem;">
                    <img src="{{ asset('storage/' . $settings['app_foto_kepsek']) }}" alt="Kepala Sekolah"
                        class="w-full h-auto object-contain object-bottom" style="max-height: 550px;">
                </div>
            @endif

            @if(isset($settings['app_foto_sekda']) && $settings['app_foto_sekda'])
                <div class="absolute right-0 hidden md:flex items-end z-0 pointer-events-none drop-shadow-2xl opacity-95 transition-opacity hover:opacity-100"
                    style="padding-right: 2rem; width: 25%; max-width: 350px; bottom: 4rem;">
                    <img src="{{ asset('storage/' . $settings['app_foto_sekda']) }}" alt="Sekda"
                        class="w-full h-auto object-contain object-bottom" style="max-height: 550px;">
                </div>
            @endif

            <div class="hero-pattern relative z-10 px-4 py-24 sm:py-32 lg:py-40 text-center">
                <div class="max-w-4xl mx-auto flex flex-col items-center">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-300 ring-1 ring-indigo-500/20 mb-8 backdrop-blur-sm text-xs font-semibold uppercase tracking-wider">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                        </span>
                        Pelayanan Publik Transparan
                    </div>

                    <h1
                        class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-[1.1] mb-6">
                        {{ $settings['hero_title_1'] ?? 'Keterbukaan Informasi' }} <br class="hidden sm:block" />
                        <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-300">{{ $settings['hero_title_2'] ?? 'Untuk Masyarakat' }}</span>
                    </h1>

                    <p class="text-sm sm:text-base text-slate-300 max-w-2xl mx-auto mb-10 leading-relaxed font-light">
                        Wujudkan tata kelola yang transparan dan akuntabel. Temukan informasi publik yang Anda butuhkan
                        atau ajukan permohonan secara online.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                        <a href="#informasi"
                            class="inline-flex justify-center items-center px-6 py-3 rounded-xl bg-white text-slate-900 font-bold hover:bg-indigo-50 transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1 group brand-font">
                            Lihat Informasi
                            <svg class="w-5 h-5 ml-2 group-hover:translate-y-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('pilih_permohonan') }}"
                            class="inline-flex justify-center items-center px-6 py-3 rounded-xl bg-slate-800/50 text-white font-bold hover:bg-slate-700/80 backdrop-blur-md transition-all duration-300 border border-slate-700 group brand-font">
                            Ajukan Permohonan
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7-7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="absolute bottom-0 w-full overflow-hidden leading-none transform translate-y-[1px]">
                <svg class="relative block w-full h-[70px] sm:h-[110px] lg:h-[150px]" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1440 320" preserveAspectRatio="none">
                    <path fill="#f8fafc" d="M0,192 C400,192 800,64 1440,64 L1440,320 L0,320 Z" opacity="0.25"></path>
                    <path fill="#f8fafc" d="M0,256 C600,256 1000,128 1440,128 L1440,320 L0,320 Z"></path>
                </svg>
            </div>
        </div>

        <!-- Content -->
        <div id="informasi" class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight inline-block relative">
                    Daftar Informasi Publik
                    <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-12 h-1 bg-indigo-600 rounded-full"></div>
                </h2>
                <p class="mt-6 text-slate-500 max-w-xl mx-auto">Akses berbagai dokumen publik secara langsung di bawah
                    ini. Kami memperbarui data secara berkala untuk transparansi maksimal.</p>
            </div>

            <div x-data="{ 
    activeCategory: 'berkala', 
    showPreview: false, 
    previewUrl: '',
    showVideo: false, 
    currentVideo: '',
    openVideo(base64Content) {
        let content = atob(base64Content);
        if (content.includes('youtube.com/watch') || content.includes('youtu.be/')) {
            let videoId = '';
            if (content.includes('youtube.com/watch')) {
                videoId = content.split('v=')[1].split('&')[0];
            } else {
                videoId = content.split('youtu.be/')[1].split('?')[0];
            }
            content = `<iframe class='w-full h-full rounded-b-lg' src='https://www.youtube.com/embed/${videoId}' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>`;
        } else if (!content.includes('<iframe')) {
            content = `<iframe class='w-full h-full rounded-b-lg' src='${content}' frameborder='0' allowfullscreen></iframe>`;
        }
        this.currentVideo = content;
        this.showVideo = true;
    }
}" class="mt-10 relative">
                <!-- Tabs -->
                <div class="flex flex-wrap justify-center gap-2 mb-10 border-b border-slate-200 pb-4">
                    <button @click="activeCategory = 'berkala'"
                        :class="activeCategory === 'berkala' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200'"
                        class="px-5 py-2.5 rounded-xl font-semibold text-sm transition-all brand-font">Berkala</button>
                    <button @click="activeCategory = 'serta_merta'"
                        :class="activeCategory === 'serta_merta' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200'"
                        class="px-5 py-2.5 rounded-xl font-semibold text-sm transition-all brand-font">Serta
                        Merta</button>
                    <button @click="activeCategory = 'setiap_saat'"
                        :class="activeCategory === 'setiap_saat' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200'"
                        class="px-5 py-2.5 rounded-xl font-semibold text-sm transition-all brand-font">Setiap
                        Saat</button>
                    <button @click="activeCategory = 'dikecualikan'"
                        :class="activeCategory === 'dikecualikan' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200'"
                        class="px-5 py-2.5 rounded-xl font-semibold text-sm transition-all brand-font">Dikecualikan</button>
                    <button @click="activeCategory = 'arsip'"
                        :class="activeCategory === 'arsip' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200'"
                        class="px-5 py-2.5 rounded-xl font-semibold text-sm transition-all brand-font">Arsip
                        Dokumen</button>
                </div>

                <!-- Content Grids per Category -->
                @php
                    $categories = [
                        'berkala' => 'Berkala',
                        'serta_merta' => 'Serta Merta',
                        'setiap_saat' => 'Setiap Saat',
                        'dikecualikan' => 'Dikecualikan',
                        'arsip' => 'Arsip Dokumen'
                    ];
                @endphp

                @foreach($categories as $catKey => $catLabel)
                    <div x-show="activeCategory === '{{ $catKey }}'"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">

                        @php
                            $filteredInfos = $informations->where('category', $catKey);
                        @endphp

                        @if($filteredInfos->count() > 0)
                            <div x-data="{ expanded_{{ $catKey }}: false }">
                                <!-- Grid view for first 3 -->
                                <div x-show="!expanded_{{ $catKey }}"
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    @foreach($filteredInfos->values() as $index => $info)
                                        @if($index < 3)
                                            <div
                                                class="bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-slate-100 p-6 sm:p-8 hover:shadow-[0_8px_30px_-4px_rgba(79,70,229,0.15)] hover:border-indigo-100 transition-all duration-500 transform hover:-translate-y-2 group flex flex-col relative overflow-hidden">
                                                <div
                                                    class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-blue-500 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                                                </div>

                                                <div class="flex justify-between items-start mb-6">
                                                    <div
                                                        class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="flex flex-col items-end gap-1">
                                                        <span
                                                            class="px-3 py-1 bg-slate-100 text-slate-500 rounded-full text-xs font-semibold uppercase tracking-wider">{{ $catLabel }}</span>
                                                        @if($info->published_year)
                                                            <span
                                                                class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-semibold uppercase tracking-wider">
                                                                Tahun {{ $info->published_year }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <h3 class="text-lg font-bold text-slate-900 mb-3 brand-font leading-tight">
                                                    {{ $info->title }}
                                                </h3>
                                                <p class="text-slate-500 mb-6 text-sm flex-grow leading-relaxed">
                                                    {{ Str::limit($info->description, 120) }}
                                                </p>

                                                @php
                                                    $ext = strtolower(pathinfo($info->file_path, PATHINFO_EXTENSION));
                                                    $isPdf = $ext === 'pdf';
                                                @endphp

                                                <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
                                                    @if($info->visibility === 'restricted')
                                                        <a href="{{ route('pilih_permohonan') }}"
                                                            class="inline-flex items-center text-xs px-4 py-2 bg-rose-50 text-rose-700 rounded-lg font-semibold hover:bg-rose-100 transition-colors group/link brand-font border border-rose-200">
                                                            Ajukan Permohonan Akses
                                                            <svg class="w-4 h-4 ml-1.5 group-hover/link:translate-x-1 transition-transform"
                                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                            </svg>
                                                        </a>
                                                        <div class="text-slate-400" title="Informasi Dikecualikan / Tertutup">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    @else
                                                        @if(($info->info_type ?? 'file') === 'file')
                                                            <button
                                                                @click.prevent="showPreview = true; loadPdfViewer('{{ asset('storage/' . $info->file_path) }}')"
                                                                class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors group/link brand-font">
                                                                Lihat Dokumen
                                                                <svg class="w-4 h-4 ml-1.5 group-hover/link:translate-x-0.5 transition-transform"
                                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                    </path>
                                                                </svg>
                                                            </button>
                                                        @elseif($info->info_type === 'url')
                                                            <a href="{{ $info->url }}" target="_blank"
                                                                class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors group/link brand-font">
                                                                Buka Tautan
                                                                <svg class="w-4 h-4 ml-1.5 group-hover/link:translate-x-0.5 transition-transform"
                                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                        @elseif($info->info_type === 'video')
                                                            <button @click.prevent="openVideo('{{ base64_encode($info->video_embed ?? '') }}')"
                                                                class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors group/link brand-font">
                                                                Putar Video
                                                                <svg class="w-4 h-4 ml-1.5 group-hover/link:translate-x-0.5 transition-transform"
                                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                                                    </path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                            </button>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                @if($filteredInfos->count() > 3)
                                    <div class="mt-8 text-center">
                                        <a href="{{ route('informasi.kategori', $catKey) }}"
                                            class="inline-flex items-center px-6 py-3 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-indigo-600 rounded-xl font-semibold transition-all shadow-sm group">
                                            Lihat Semua {{ $catLabel }} (Ada {{ $filteredInfos->count() }} Dokumen)
                                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="bg-white rounded-3xl border border-slate-200 border-dashed p-16 text-center shadow-sm">
                                <div
                                    class="mx-auto w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6 shadow-inner">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-slate-800 brand-font mb-2">Belum Tersedia</h3>
                                <p class="text-slate-500 max-w-sm mx-auto text-sm">Belum ada dokumen publik yang diunggah untuk
                                    kategori {{ $catLabel }}.</p>
                            </div>
                        @endif
                    </div>
                @endforeach

                <!-- PDF Preview Modal -->
                @include('components.pdf-viewer-modal')
                @include('components.video-viewer-modal')
            </div>

            <div class="mt-24 relative rounded-3xl shadow-2xl overflow-hidden bg-slate-900">
                <div class="absolute inset-0 opacity-20">
                    <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
                        preserveAspectRatio="none">
                        <polygon fill="#ffffff" points="0,100 100,0 100,100" />
                    </svg>
                </div>
                <div class="relative flex flex-col lg:flex-row">
                    <div
                        class="bg-gradient-to-br from-indigo-600 to-indigo-800 p-10 sm:p-14 lg:w-5/12 flex flex-col justify-center text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-8 transform translate-x-1/3 -translate-y-1/3 opacity-10">
                            <svg class="w-48 h-48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-extrabold mb-4 brand-font leading-tight">Tidak Menemukan<br>Informasi?
                        </h3>
                        <p class="text-indigo-100 text-base">Berdasarkan UU KIP No. 14 Tahun 2008, Anda berhak
                            mengajukan
                            permohonan informasi publik ke PPID.</p>
                    </div>
                    <div
                        class="p-10 sm:p-14 lg:w-7/12 flex flex-col justify-center items-start bg-slate-900/50 backdrop-blur-sm z-10">
                        <div class="flex items-start gap-4 mb-8">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-blue-400 font-bold brand-font text-lg">1</span>
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-base brand-font mb-1">Masuk ke Akun</h4>
                                <p class="text-slate-400 text-sm">Login atau buat akun baru untuk mulai.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 mb-10">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center flex-shrink-0 mt-1">
                                <span class="text-blue-400 font-bold brand-font text-lg">2</span>
                            </div>
                            <div>
                                <h4 class="text-white font-bold text-base brand-font mb-1">Isi Formulir</h4>
                                <p class="text-slate-400 text-sm">Lengkapi formulir permohonan dengan jelas.</p>
                            </div>
                        </div>
                        <a href="{{ route('pilih_permohonan') }}"
                            class="group relative inline-flex items-center justify-center px-6 py-3 font-bold text-white transition-all duration-200 bg-indigo-600 border border-transparent rounded-xl hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 shadow-xl shadow-indigo-500/30 brand-font w-full sm:w-auto">
                            Ajukan Permohonan Sekarang
                            <svg class="w-5 h-5 ml-2 mt-0.5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>


            @if(isset($news) && $news->count() > 0)
                <div class="mt-24">
                    <div class="text-center mb-12">
                        <h2
                            class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight inline-block relative brand-font">
                            Berita & Publikasi Terkini
                            <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-12 h-1 bg-indigo-600 rounded-full">
                            </div>
                        </h2>
                        <p class="mt-6 text-slate-500 max-w-xl mx-auto">Ikuti perkembangan terbaru dan publikasi resmi dari
                            Badan Publik kami.</p>
                    </div>

                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 @if($news->count() < 3) justify-center @endif">
                        @foreach($news as $item)
                            <div onclick="window.location.href='{{ route('publikasi.show', $item->slug) }}'"
                                class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 overflow-hidden flex flex-col group cursor-pointer relative">
                                <div class="h-48 overflow-hidden relative bg-slate-100">
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
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="px-3 py-1 bg-indigo-600/90 backdrop-blur text-white text-[10px] font-bold uppercase tracking-wider rounded-lg shadow-sm">
                                            {{ $item->type }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6 flex flex-col flex-grow">
                                    <div class="flex items-center gap-2 text-xs text-slate-400 mb-3 font-medium">
                                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $item->created_at->format('d M Y') }}
                                    </div>
                                    <h3
                                        class="text-base font-bold text-slate-800 brand-font mb-3 leading-snug group-hover:text-indigo-600 transition-colors line-clamp-2">
                                        {{ $item->title }}
                                    </h3>
                                    <p class="text-slate-500 text-sm line-clamp-3 mb-6 flex-grow">
                                        {{ strip_tags($item->content) }}
                                    </p>
                                    <a href="{{ route('publikasi.show', $item->slug) }}"
                                        class="inline-flex items-center text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors mt-auto group/link brand-font">
                                        Baca Selengkapnya
                                        <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Buku Tamu & Survei Kepuasan -->
            <div class="mt-24 mb-16 px-0">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Buku Tamu Card -->
                    <a href="{{ route('guestbook.create') }}"
                        class="group relative bg-white border border-slate-200 rounded-3xl p-8 sm:p-10 shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10 hover:border-indigo-200 overflow-hidden hover:-translate-y-1 transition-all duration-300 block">
                        <div
                            class="absolute -right-8 -top-8 w-64 h-64 bg-gradient-to-br from-indigo-50 to-blue-50 rounded-full opacity-50 blur-3xl group-hover:opacity-80 transition-opacity duration-500 pointer-events-none">
                        </div>

                        <div class="relative z-10 flex flex-col md:flex-row items-start gap-6">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-600 text-white rounded-2xl flex items-center justify-center shrink-0 shadow-lg shadow-indigo-500/30 group-hover:scale-110 group-hover:-rotate-6 transition-transform duration-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="text-xl font-extrabold text-slate-800 brand-font mb-2 tracking-tight group-hover:text-indigo-600 transition-colors">
                                    Buku Tamu Digital</h3>
                                <p class="text-slate-500 text-sm mb-6 leading-relaxed">Berikan saran, masukan, dan
                                    kritik membangun Anda kepada instansi kami melalui sistem buku tamu digital yang
                                    terintegrasi.</p>
                                <span
                                    class="inline-flex items-center text-indigo-600 font-bold text-sm group-hover:text-indigo-700">
                                    Isi Buku Tamu Sekarang
                                    <svg class="w-4 h-4 ml-1.5 group-hover:translate-x-2 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- Survei Kepuasan Card -->
                    <a href="{{ route('survey.index') }}"
                        class="group relative bg-slate-900 border border-slate-700/50 rounded-3xl p-8 sm:p-10 shadow-xl shadow-slate-900/20 hover:shadow-2xl hover:shadow-blue-900/30 hover:border-slate-600 overflow-hidden hover:-translate-y-1 transition-all duration-300 block">
                        <div
                            class="absolute -left-10 -bottom-10 w-64 h-64 bg-gradient-to-br from-purple-500/20 to-blue-500/20 rounded-full opacity-50 blur-3xl group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                        </div>
                        <div
                            class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 pointer-events-none">
                        </div>

                        <div class="relative z-10 flex flex-col md:flex-row items-start gap-6">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-violet-500 to-purple-600 text-white rounded-2xl flex items-center justify-center shrink-0 shadow-lg shadow-purple-500/30 group-hover:scale-110 group-hover:-rotate-6 transition-transform duration-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-extrabold text-white brand-font mb-2 tracking-tight">Survei
                                    Kepuasan</h3>
                                <p class="text-indigo-200 text-sm mb-6 leading-relaxed">Bantu kami meningkatkan standar
                                    dan kualitas layanan publik dengan berpartisipasi mengisi survei IKM ini.</p>
                                <span
                                    class="inline-flex items-center text-indigo-300 font-bold text-sm group-hover:text-white transition-colors">
                                    Mulai Isi Survei
                                    <svg class="w-4 h-4 ml-1.5 group-hover:translate-x-2 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <!-- Galeri & Link Terkait Section -->
        <section class="bg-slate-900 pt-20 pb-40 -mb-20 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <!-- Left: Website Wilayah (Standard Tailwind Colors) -->
                    <div class="bg-slate-800 border border-slate-700 rounded-3xl p-6 sm:p-8">
                        <div class="flex items-center gap-4 border-b border-slate-700 pb-5 mb-6">
                            <div
                                class="w-10 h-10 rounded-xl bg-orange-400 text-white flex items-center justify-center shrink-0 shadow-lg shadow-orange-500/30">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-white tracking-widest uppercase">Link Terkait</h3>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @forelse($related_links ?? [] as $link)
                                <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                                    class="group flex flex-col items-center justify-center p-4 bg-slate-900/50 rounded-2xl hover:bg-slate-700/80 border border-slate-700/50 transition-colors gap-3">
                                    <div
                                        class="w-14 h-14 bg-slate-800 rounded-full p-2 border border-slate-600 flex items-center justify-center group-hover:scale-110 transition-transform overflow-hidden">
                                        @if($link->logo_path)
                                            <img src="{{ asset('storage/' . $link->logo_path) }}"
                                                class="w-full h-full object-contain" alt="">
                                        @else
                                            <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <span
                                        class="text-xs font-bold text-slate-300 text-center group-hover:text-white">{{ $link->title }}</span>
                                </a>
                            @empty
                                <p class="text-slate-400 text-sm italic col-span-3">Belum ada data wilayah tersimpan.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Right: Galeri Video -->
                    <div
                        class="bg-slate-800 border border-slate-700 rounded-3xl p-6 sm:p-8 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-4 border-b border-slate-700 pb-5 mb-6">
                                <div
                                    class="w-10 h-10 rounded-xl bg-orange-400 text-white flex items-center justify-center shrink-0 shadow-lg shadow-orange-500/30">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-white tracking-widest uppercase">Galeri</h3>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @forelse($gallery_videos ?? [] as $vid)
                                    <a href="{{ $vid->youtube_url }}" target="_blank"
                                        class="relative w-full aspect-video rounded-xl overflow-hidden shadow-lg border border-slate-700 group block">
                                        @if($vid->youtube_id)
                                            <img src="https://img.youtube.com/vi/{{ $vid->youtube_id }}/maxresdefault.jpg"
                                                onerror="this.src='https://img.youtube.com/vi/{{ $vid->youtube_id }}/hqdefault.jpg'"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                                alt="Video">
                                        @else
                                            <div class="w-full h-full bg-slate-900 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-slate-500" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div
                                            class="absolute inset-0 bg-black/40 flex items-center justify-center group-hover:bg-black/20 transition-colors">
                                            <div
                                                class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white ml-1" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="absolute bottom-2 left-2 right-2 flex justify-center">
                                            <span
                                                class="bg-black/70 backdrop-blur text-white text-[10px] font-bold px-3 py-1 rounded inline-block text-center line-clamp-1">{{ strtoupper($vid->title) }}</span>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-slate-400 text-sm italic col-span-2">Belum ada galeri video tersimpan.
                                    </p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-8 flex justify-start">
                            <a href="{{ route('galeri') }}"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full border border-slate-500 text-slate-300 text-sm font-semibold hover:bg-white hover:text-slate-900 transition-colors shadow-sm">
                                Lihat semua galeri
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <x-public-footer :settings="$settings" />

    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Jalankan sege        ra (tanpa menunggu DOMContentLoaded kerena ini di bottom body)
            // Ini untuk memastikan Hotwire Turbo tetap mau merender SweetAlert.
            setTimeout(() => {
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#4f46e5'
                });
            }, 100);
        </script>
    @endif
</body>

</html>
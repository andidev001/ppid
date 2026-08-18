<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon"
        href="{{ \App\Models\Setting::where('key', 'app_logo')->value('value') ? asset('storage/' . \App\Models\Setting::where('key', 'app_logo')->value('value')) : asset('favicon.ico') }}">
    <title>{{ \App\Models\Setting::where('key', 'app_name')->value('value') ?? config('app.name', 'PPID Portal') }} -
        Dashboard</title>

    <!-- Fonts -->
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

        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased text-slate-800 bg-slate-50 selection:bg-indigo-500 selection:text-white"
    x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar Backdrop -->
        <div x-show="sidebarOpen" x-transition.opacity
            class="fixed inset-0 z-20 bg-slate-900/50 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 text-white transition-transform duration-300 lg:static lg:translate-x-0 lg:flex lg:flex-col shadow-[4px_0_24px_rgba(43,37,104,0.3)] flex flex-col"
            style="background-color: #2b2568;">

            <div class="flex items-center justify-between h-16 px-5 border-b border-white/10 shrink-0"
                style="background-color: rgba(0,0,0,0.2);">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    @php $appLogo = \App\Models\Setting::where('key', 'app_logo')->value('value');
                    $appName = \App\Models\Setting::where('key', 'app_name')->value('value'); @endphp
                    @if($appLogo)
                        <div
                            class="w-8 h-8 bg-white rounded-lg flex items-center justify-center p-0.5 shadow-md group-hover:scale-105 transition-transform">
                            <img src="{{ asset('storage/' . $appLogo) }}" class="max-w-full max-h-full object-contain">
                        </div>
                    @else
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                    @endif
                    <span class="text-lg font-bold brand-font tracking-wide line-clamp-1">Portal PPID</span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-indigo-300 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto overflow-x-hidden py-5 px-3 space-y-1 custom-scrollbar">
                <div class="text-[10px] font-semibold text-indigo-300/70 uppercase tracking-wider mb-1 px-3">Main Menu
                </div>

                @if(auth()->user()->role !== 'user')
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="font-medium text-sm brand-font">Dashboard Utama</span>
                    </a>

                    <!-- Permohonan Informasi -->
                    <a href="{{ route('admin.requests.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.requests.*') ? 'bg-indigo-600/90 text-white font-semibold shadow-lg shadow-indigo-900/20' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }} mt-1 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                            </path>
                        </svg>
                        <span class="font-medium text-sm brand-font">Kelola Permohonan</span>
                    </a>

                    <!-- Informasi Publik Dropdown -->
                    <div x-data="{ open: {{ request()->routeIs('admin.public-info.index') || request()->routeIs('admin.information-groups.*') ? 'true' : 'false' }} }"
                        class="mt-1">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all text-indigo-200 hover:bg-white/10 hover:text-white">
                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                                <span class="font-medium text-sm brand-font">Informasi Publik</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div x-show="open" x-transition.opacity class="pl-9 pr-3 py-2 space-y-1" x-cloak>
                            <a href="{{ route('admin.public-info.index', ['category' => 'berkala']) }}"
                                class="block text-xs font-medium {{ request('category') == 'berkala' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-400/50 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Informasi
                                Berkala</a>
                            <a href="{{ route('admin.public-info.index', ['category' => 'setiap_saat']) }}"
                                class="block text-xs font-medium {{ request('category') == 'setiap_saat' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-400/50 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Informasi
                                Setiap Saat</a>
                            <a href="{{ route('admin.public-info.index', ['category' => 'serta_merta']) }}"
                                class="block text-xs font-medium {{ request('category') == 'serta_merta' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-400/50 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Informasi
                                Serta Merta</a>
                            <a href="{{ route('admin.public-info.index', ['category' => 'dikecualikan']) }}"
                                class="block text-xs font-medium {{ request('category') == 'dikecualikan' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-400/50 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Informasi
                                Dikecualikan</a>
                            <a href="{{ route('admin.public-info.index', ['category' => 'pengadaan']) }}"
                                class="block text-xs font-medium {{ request('category') == 'pengadaan' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-400/50 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Pengadaan
                                Barang dan Jasa</a>
                            <a href="{{ route('admin.public-info.index', ['category' => 'arsip']) }}"
                                class="block text-xs font-medium {{ request('category') == 'arsip' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-400/50 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Arsip
                                Dokumen</a>
                            <a href="{{ route('admin.public-info.index', ['category' => 'laporan']) }}"
                                class="block text-xs font-medium {{ request('category') == 'laporan' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-400/50 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Laporan
                                PPID</a>
                            <a href="{{ route('admin.public-info.index', ['category' => 'laporan_survey']) }}"
                                class="block text-xs font-medium {{ request('category') == 'laporan_survey' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-400/50 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Laporan
                                Survey</a>
                            <a href="{{ route('admin.information-groups.index') }}"
                                class="block text-xs font-medium {{ request()->routeIs('admin.information-groups.*') ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-400/50 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Grup
                                Informasi</a>
                        </div>
                    </div>


                    <!-- Keberatan Dropdown -->
                    <div x-data="{ open: {{ request()->routeIs('admin.objections.index') ? 'true' : 'false' }} }"
                        class="mt-1">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all text-indigo-200 hover:bg-white/10 hover:text-white">
                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                <span class="font-medium text-sm brand-font">Keberatan</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div x-show="open" x-transition.opacity class="pl-9 pr-3 py-2 space-y-1" x-cloak>
                            <a href="{{ route('admin.objections.index', ['status' => 'pending']) }}"
                                class="block text-xs font-medium {{ request('status') == 'pending' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-amber-500 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-amber-400">Pengajuan
                                Keberatan</a>
                            <a href="{{ route('admin.objections.index', ['status' => 'reviewed']) }}"
                                class="block text-xs font-medium {{ request('status') == 'reviewed' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-blue-500 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-blue-400">Diproses</a>
                            <a href="{{ route('admin.objections.index', ['status' => 'resolved']) }}"
                                class="block text-xs font-medium {{ request('status') == 'resolved' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-emerald-500 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-emerald-400">Selesai</a>
                            <a href="{{ route('admin.objections.index', ['status' => 'rejected']) }}"
                                class="block text-xs font-medium {{ request('status') == 'rejected' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-rose-500 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-rose-400">Ditolak</a>
                        </div>
                    </div>

                    <!-- Publikasi Dropdown -->
                    <div x-data="{ open: {{ request()->routeIs('admin.publications.*') ? 'true' : 'false' }} }"
                        class="mt-1">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all text-indigo-200 hover:bg-white/10 hover:text-white">
                            <div class="flex items-center gap-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                    </path>
                                </svg>
                                <span class="font-medium text-sm brand-font">Publikasi</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div x-show="open" x-transition.opacity class="pl-9 pr-3 py-2 space-y-1" x-cloak>
                            <a href="{{ route('admin.publications.index', ['type' => 'berita']) }}"
                                class="block text-xs font-medium {{ request('type') == 'berita' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-400/50 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Berita</a>
                            <a href="{{ route('admin.publications.index', ['type' => 'pengumuman']) }}"
                                class="block text-xs font-medium {{ request('type') == 'pengumuman' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-400/50 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Pengumuman</a>
                            <a href="{{ route('admin.publications.index', ['type' => 'agenda']) }}"
                                class="block text-xs font-medium {{ request('type') == 'agenda' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-400/50 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Agenda</a>
                        </div>
                    </div>

                    <!-- Single Menus Section -->
                    <div class="pt-2 pb-1">
                        <div class="text-[10px] font-semibold text-indigo-300/70 uppercase tracking-wider mb-1 px-3">Lainnya
                        </div>

                        <div x-data="{ open: {{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }} }" class="mt-1">
                            <button @click="open = !open"
                                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-all text-indigo-200 hover:bg-white/10 hover:text-white">
                                <div class="flex items-center gap-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <span class="font-medium text-sm brand-font">Laporan</span>
                                </div>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>

                            <div x-show="open" x-transition.opacity class="pl-9 pr-3 py-2 space-y-1" x-cloak>
                                <a href="{{ route('admin.reports.index', ['type' => 'permohonan']) }}"
                                    class="block text-xs font-medium {{ request('type') == 'permohonan' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-blue-500 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-blue-400">Permohonan</a>
                                <a href="{{ route('admin.reports.index', ['type' => 'keberatan']) }}"
                                    class="block text-xs font-medium {{ request('type') == 'keberatan' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-amber-500 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-amber-400">Keberatan</a>
                                <a href="{{ route('admin.reports.index', ['type' => 'bukutamu']) }}"
                                    class="block text-xs font-medium {{ request('type') == 'bukutamu' ? 'text-white font-bold' : 'text-indigo-300 hover:text-white' }} py-1.5 transition-colors relative before:absolute before:w-1.5 before:h-1.5 before:bg-indigo-500 before:rounded-full before:top-[11px] before:-left-4 hover:before:bg-indigo-300">Buku
                                    Tamu</a>
                            </div>
                        </div>

                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.users') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.users') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }} mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                <span class="font-medium text-sm brand-font">Pengguna</span>
                            </a>
                        @endif

                        <a href="{{ route('admin.guestbooks.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.guestbooks.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }} mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            <span class="font-medium text-sm brand-font">Buku Tamu</span>
                        </a>

                        <a href="{{ route('admin.survey.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.survey.index') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }} mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            <span class="font-medium text-sm brand-font">Pertanyaan Survei</span>
                        </a>

                        <a href="{{ route('admin.survey.results') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.survey.results*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }} mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                            <span class="font-medium text-sm brand-font">Hasil Survei</span>
                        </a>

                        {{-- Kelola Komentar --}}
                        @php $pendingComments = \App\Models\Comment::where('is_approved', false)->count(); @endphp
                        <a href="{{ route('admin.comments.index') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.comments.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }} mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            <span class="font-medium text-sm brand-font flex-1">Kelola Komentar</span>
                            @if($pendingComments > 0)
                                <span
                                    class="text-[10px] font-bold bg-amber-400 text-amber-900 rounded-full px-1.5 py-0.5 leading-none">{{ $pendingComments }}</span>
                            @endif
                        </a>

                        <a href="{{ route('admin.pages') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.pages') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }} mt-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <span class="font-medium text-sm brand-font">Kelola Halaman</span>
                        </a>

                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.home_content.index') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.home_content.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }} mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="font-medium text-sm brand-font">Galeri & Tautan</span>
                            </a>

                            <a href="{{ route('admin.settings') }}"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.settings') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }} mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="font-medium text-sm brand-font">Pengaturan</span>
                            </a>
                        @endif
                    </div>
                @endif

                @if(auth()->user()->role === 'user')
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg mb-4 transition-all {{ request()->routeIs('profile.edit') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-indigo-200 hover:bg-emerald-500/20 hover:text-emerald-400 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                            </path>
                        </svg>
                        <span class="font-medium text-sm brand-font">Lengkapi Biodata</span>
                    </a>

                    <a href="{{ route('requests.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('requests.index') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="font-medium text-sm brand-font">Riwayat Permohonan</span>
                    </a>

                    <a href="{{ route('requests.create') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('requests.create') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/30' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        <span class="font-medium text-sm brand-font">Ajukan Permohonan</span>
                    </a>
                @endif
            </div>

            <!-- User Info Sidebar Bottom -->
            <div class="p-3 shrink-0" style="background-color: rgba(0,0,0,0.2);">
                <div class="flex items-center gap-2.5 p-2.5 rounded-lg bg-white/5 border border-white/10">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                            class="w-8 h-8 rounded-md object-cover border border-indigo-500/30">
                    @else
                        <div
                            class="w-8 h-8 rounded-md bg-indigo-500/20 flex items-center justify-center text-indigo-300 font-bold brand-font text-sm border border-indigo-500/30">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-white truncate brand-font">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-indigo-300 capitalize truncate">{{ Auth::user()->role }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Layout -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-slate-50/50">

            <!-- Top Header -->
            <header
                class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 z-10 shrink-0">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true"
                        class="lg:hidden text-slate-500 hover:text-indigo-600 p-2 rounded-lg bg-slate-100 hover:bg-indigo-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                    </button>
                    @if (isset($header))
                        <h2 class="text-lg sm:text-xl font-bold text-slate-700 brand-font">
                            {{ $header }}
                        </h2>
                    @endif
                </div>

                <div class="flex items-center gap-3 relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false"
                        class="flex items-center gap-2 hover:bg-slate-50 border border-transparent hover:border-slate-100 py-1.5 px-3 rounded-lg transition-colors">
                        <span class="text-sm font-medium text-slate-600 hidden sm:block">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div x-show="dropdownOpen" x-transition.opacity.duration.200ms
                        class="absolute right-0 top-full mt-1 w-48 bg-white border border-slate-200 rounded-lg shadow-lg py-1.5 z-50 text-sm"
                        x-cloak>
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-slate-600 hover:bg-indigo-50 hover:text-indigo-700 transition">Profil
                            Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 font-medium transition">Log
                                Out</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 sm:p-5 lg:p-6 bg-[#f8fafc] flex flex-col">
                <div class="max-w-7xl mx-auto w-full flex-1">
                    {{ $slot }}
                </div>

                <!-- Admin Footer -->
                <footer class="mt-auto mt-10 pt-6 shrink-0 text-center text-[13px] font-medium text-slate-400">
                    &copy; {{ date('Y') }} <span class="text-indigo-500 font-bold brand-font">Skolabs</span>.
                </footer>
            </main>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
        <script>
            setTimeout(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: @json(session('success')),
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#ffffff',
                    color: '#1e293b',
                    customClass: { popup: 'rounded-2xl shadow-xl' }
                });
            }, 100);
        </script>
    @endif

    @if(session('error') || $errors->any())
        <script>
            setTimeout(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    html: @json(session('error') ?: 'Periksa kembali data masukan anda:<br>' . implode('<br>', $errors->all())),
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    customClass: { popup: 'rounded-2xl shadow-xl' }
                });
            }, 100);
        </script>
    @endif
</body>

</html>
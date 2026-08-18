<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon"
        href="{{ \App\Models\Setting::where('key', 'app_favicon')->value('value') ? asset('storage/' . \App\Models\Setting::where('key', 'app_favicon')->value('value')) : asset('favicon.ico') }}">
    <title>{{ \App\Models\Setting::where('key', 'app_name')->value('value') ?? config('app.name', 'PPID Portal') }} -
        Akses Autentikasi</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        .brand-font {
            font-family: 'Outfit', sans-serif;
        }

        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%234f46e5' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans antialiased text-slate-800 bg-slate-50 selection:bg-indigo-500 selection:text-white hero-pattern relative"
    x-data>

    <!-- Decorative Blurs -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-indigo-400/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-96 h-96 bg-blue-400/20 rounded-full blur-3xl"></div>
    </div>

    @php $appLogo = \App\Models\Setting::where('key', 'app_logo')->value('value');
    $appName = \App\Models\Setting::where('key', 'app_name')->value('value'); @endphp

    <div class="min-h-screen flex flex-col items-center pt-12 pb-16 px-4">

        <div class="mb-6 mt-4 md:mt-8 text-center">
            <a href="/" class="inline-flex items-center gap-2 group">
                @if($appLogo)
                    <img src="{{ asset('storage/' . $appLogo) }}"
                        class="h-12 w-auto object-contain group-hover:scale-105 transition-transform duration-300">
                @else
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="text-3xl font-extrabold brand-font bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-indigo-800 tracking-tight text-left leading-tight">
                        {{ $appName ?? 'Portal PPID' }}
                    </span>
                @endif
            </a>
        </div>

        <div
            class="w-full {{ request()->routeIs('register') ? 'sm:max-w-4xl' : 'sm:max-w-md' }} mt-4 px-8 py-8 bg-white/80 backdrop-blur-xl shadow-2xl shadow-indigo-900/5 border border-white overflow-hidden sm:rounded-3xl relative z-10 transition-all">
            {{ $slot }}
        </div>

        <p class="mt-8 text-sm text-slate-500 font-medium">
            &copy; <?= date('Y') ?> {{ $appName ?? 'Pemerintah Daerah' }}. All rights reserved.
        </p>
    </div>

</body>

</html>
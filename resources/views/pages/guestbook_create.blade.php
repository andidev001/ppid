@extends('layouts.public')

@section('content')
    <!-- Pattern Header -->
    <div class="bg-slate-900 pb-32 pt-16 relative overflow-hidden">
        <!-- Abstract pattern -->
        <div class="absolute inset-0 opacity-[0.05] text-white">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pattern-guestbook" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path
                            d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                            fill="currentColor"></path>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-guestbook)"></rect>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white brand-font tracking-tight mb-4">Buku Tamu PPID</h1>
            <p class="text-indigo-100 max-w-2xl mx-auto text-lg">Silakan lengkapi formulir di bawah ini. Terimakasih atas
                kunjungan Anda.</p>
        </div>
    </div>

    <!-- Main Container -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20 pb-20">
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden relative">
            <!-- Abstract Decoration -->
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-indigo-50 rounded-full blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2 pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 left-0 w-64 h-64 bg-emerald-50 rounded-full blur-3xl opacity-50 translate-y-1/2 -translate-x-1/2 pointer-events-none">
            </div>

            <div class="relative px-6 py-10 sm:px-12 sm:py-16">
                <!-- Title removed as it is in the header now -->

                @if(session('success'))
                    <div class="mb-8 p-4 md:p-5 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-emerald-800 font-bold mb-1">Berhasil!</h3>
                            <p class="text-emerald-600 text-sm md:text-base">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('guestbook.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-slate-700">Nama Lengkap <span
                                    class="text-rose-500">*</span></label>
                            <input type="text" name="name" id="name" required
                                class="w-full rounded-xl border-slate-200 focus:ring-indigo-600 focus:border-indigo-600 bg-slate-50/50 hover:bg-slate-50 transition-colors placeholder:text-slate-400"
                                placeholder="Masukkan nama Anda">
                        </div>
                        <div class="space-y-2">
                            <label for="institution" class="block text-sm font-medium text-slate-700">Instansi / Organisasi
                                <span class="text-slate-400 font-normal">(Opsional)</span></label>
                            <input type="text" name="institution" id="institution"
                                class="w-full rounded-xl border-slate-200 focus:ring-indigo-600 focus:border-indigo-600 bg-slate-50/50 hover:bg-slate-50 transition-colors placeholder:text-slate-400"
                                placeholder="Asal instansi atau pribadi">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-slate-700">Email <span
                                    class="text-slate-400 font-normal">(Opsional)</span></label>
                            <input type="email" name="email" id="email"
                                class="w-full rounded-xl border-slate-200 focus:ring-indigo-600 focus:border-indigo-600 bg-slate-50/50 hover:bg-slate-50 transition-colors placeholder:text-slate-400"
                                placeholder="nama@email.com">
                        </div>
                        <div class="space-y-2">
                            <label for="phone" class="block text-sm font-medium text-slate-700">No. WhatsApp/HP <span
                                    class="text-slate-400 font-normal">(Opsional)</span></label>
                            <input type="tel" name="phone" id="phone"
                                class="w-full rounded-xl border-slate-200 focus:ring-indigo-600 focus:border-indigo-600 bg-slate-50/50 hover:bg-slate-50 transition-colors placeholder:text-slate-400"
                                placeholder="08xxxxxxxxxx">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="purpose" class="block text-sm font-medium text-slate-700">Tujuan Kunjungan / Pesan <span
                                class="text-rose-500">*</span></label>
                        <textarea name="purpose" id="purpose" rows="4" required
                            class="w-full rounded-xl border-slate-200 focus:ring-indigo-600 focus:border-indigo-600 bg-slate-50/50 hover:bg-slate-50 transition-colors placeholder:text-slate-400 resize-none"
                            placeholder="Tuliskan pesan, saran, atau tujuan Anda berkunjung ke portal PPID kami..."></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full sm:w-auto px-8 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-all active:scale-95 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            <span>Kirim Pesan Buku Tamu</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
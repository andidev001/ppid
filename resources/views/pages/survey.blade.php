@extends('layouts.public')

@section('content')
    <!-- Header -->
    <div class="bg-slate-900 pb-32 pt-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.05] text-white">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pattern-statistik" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path
                            d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
                            fill="currentColor"></path>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#pattern-statistik)"></rect>
            </svg>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div
                class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-600/30 text-indigo-300 ring-1 ring-white/10 mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-white brand-font tracking-tight mb-4">Survei Kepuasan
                Masyarakat</h1>
            <p class="text-indigo-100 max-w-xl mx-auto text-lg">Kami mengundang Anda untuk memberikan umpan balik demi
                meningkatkan kualitas layanan publik kami di masa mendatang.</p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-20">

        @if(session('error'))
            <div class="mb-8 bg-rose-50 border border-rose-200 rounded-2xl p-4 flex gap-3 shadow-sm">
                <svg class="w-5 h-5 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
                <p class="text-sm font-medium text-rose-800">{{ session('error') }}</p>
            </div>
        @endif

        <form id="surveyForm" action="{{ route('survey.store') }}" method="POST" class="space-y-8" onsubmit="showLoading()">
            @csrf

            <!-- Demographics Card -->
            <div
                class="bg-white p-6 sm:p-8 rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 relative overflow-hidden flex flex-col">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                <div class="mb-6 pb-6 border-b border-slate-100">
                    <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                        <span
                            class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm font-black">1</span>
                        Informasi Responden
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 ml-10">Data profil Anda (Opsional)</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:ml-10">
                    <div>
                        <x-input-label for="name" value="Nama Lengkap" class="font-bold text-slate-700" />
                        <x-text-input id="name" class="block mt-2 w-full bg-slate-50 border-slate-200 focus:bg-white"
                            type="text" name="name" placeholder="Contoh: John Doe" />
                    </div>
                    <div>
                        <x-input-label for="email" value="Alamat Email" class="font-bold text-slate-700" />
                        <x-text-input id="email" class="block mt-2 w-full bg-slate-50 border-slate-200 focus:bg-white"
                            type="email" name="email" placeholder="contoh@email.com" />
                    </div>
                    <div>
                        <x-input-label for="phone" value="Nomor Telepon" class="font-bold text-slate-700" />
                        <x-text-input id="phone" class="block mt-2 w-full bg-slate-50 border-slate-200 focus:bg-white"
                            type="tel" name="phone" placeholder="08..." />
                    </div>
                    <div>
                        <x-input-label for="age_group" value="Kelompok Usia" class="font-bold text-slate-700" />
                        <select id="age_group" name="age_group"
                            class="block mt-2 w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm text-sm bg-slate-50 focus:bg-white transition-colors">
                            <option value="" disabled selected>Pilih Usia</option>
                            <option value="< 20">&lt; 20 Tahun</option>
                            <option value="20-30">20 - 30 Tahun</option>
                            <option value="31-40">31 - 40 Tahun</option>
                            <option value="41-50">41 - 50 Tahun</option>
                            <option value="> 50">&gt; 50 Tahun</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="education" value="Pendidikan Terakhir" class="font-bold text-slate-700" />
                        <select id="education" name="education"
                            class="block mt-2 w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm text-sm bg-slate-50 focus:bg-white transition-colors">
                            <option value="" disabled selected>Pilih Pendidikan</option>
                            <option value="SD/Sederajat">SD/Sederajat</option>
                            <option value="SMP/Sederajat">SMP/Sederajat</option>
                            <option value="SMA/SMK/Sederajat">SMA/SMK/Sederajat</option>
                            <option value="D1-D4/S1">D1-D4/S1</option>
                            <option value="S2/S3">S2/S3</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="job" value="Pekerjaan Utama" class="font-bold text-slate-700" />
                        <select id="job" name="job"
                            class="block mt-2 w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm text-sm bg-slate-50 focus:bg-white transition-colors">
                            <option value="" disabled selected>Pilih Pekerjaan</option>
                            <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                            <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                            <option value="Pegawai Swasta">Pegawai BUMN/Swasta</option>
                            <option value="Wiraswasta/Pengusaha">Wiraswasta/Pengusaha</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Questions Card -->
            <div
                class="bg-white p-6 sm:p-8 rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 flex flex-col">
                <div class="mb-6 pb-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                            <span
                                class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm font-black">2</span>
                            Daftar Pertanyaan
                        </h2>
                        <p class="text-sm text-slate-500 mt-1 ml-10">Jawablah pertanyaan di bawah ini (Wajib)</p>
                    </div>
                </div>

                <div class="space-y-8 md:ml-10">
                    @forelse($questions as $index => $q)
                        <div class="p-6 rounded-2xl bg-slate-50/50 border border-slate-200">
                            <label class="block text-lg font-bold text-slate-800 mb-4">{{ $index + 1 }}. {{ $q->question }}
                                <span class="text-rose-500">*</span></label>

                            @if($q->type === 'rating')
                                <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                                    @foreach([1 => 'Sg. Buruk', 2 => 'Buruk', 3 => 'Cukup', 4 => 'Baik', 5 => 'Sg. Baik'] as $val => $label)
                                        <label
                                            class="relative flex flex-col items-center justify-center p-4 rounded-xl border-2 border-slate-200 bg-white shadow-sm cursor-pointer hover:border-indigo-300 transition-all">
                                            <input type="radio" name="answers[{{ $q->id }}]" value="{{ $val }}"
                                                class="absolute w-full h-full opacity-0 cursor-pointer" required
                                                onclick="updateBoxes(this, 'answers[{{ $q->id }}]', 'rating')">
                                            <span class="block text-2xl font-black mb-1 text-slate-700 val-text">{{ $val }}</span>
                                            <span
                                                class="block text-[11px] font-bold text-slate-500 uppercase tracking-wide text-center label-text">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @elseif($q->type === 'yes_no')
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <label
                                        class="relative flex items-center justify-center gap-3 p-4 rounded-xl border-2 border-slate-200 bg-white shadow-sm cursor-pointer hover:border-emerald-300 transition-all">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="Ya"
                                            class="absolute w-full h-full opacity-0 cursor-pointer" required
                                            onclick="updateBoxes(this, 'answers[{{ $q->id }}]', 'ya')">
                                        <svg class="w-7 h-7 text-slate-400 icon-svg" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-lg font-bold text-slate-700 label-text">Ya, Sesuai</span>
                                    </label>
                                    <label
                                        class="relative flex items-center justify-center gap-3 p-4 rounded-xl border-2 border-slate-200 bg-white shadow-sm cursor-pointer hover:border-rose-300 transition-all">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="Tidak"
                                            class="absolute w-full h-full opacity-0 cursor-pointer" required
                                            onclick="updateBoxes(this, 'answers[{{ $q->id }}]', 'tidak')">
                                        <svg class="w-7 h-7 text-slate-400 icon-svg" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span class="text-lg font-bold text-slate-700 label-text">Tidak Sesuai</span>
                                    </label>
                                </div>
                            @else
                                <textarea name="answers[{{ $q->id }}]" rows="4"
                                    class="w-full border-slate-300 focus:border-indigo-600 focus:ring-indigo-600 rounded-xl shadow-sm text-sm"
                                    placeholder="Tuliskan jawaban atau masukan Anda..." required></textarea>
                            @endif

                            @error('answers.' . $q->id)
                                <p class="text-sm font-bold text-rose-500 mt-3 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    Pertanyaan ini wajib dijawab.
                                </p>
                            @enderror
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 text-slate-400 mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">Survei Belum Tersedia</h3>
                            <p class="text-slate-500 mt-1">Saat ini belum ada pertanyaan survei yang aktif.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="flex items-center justify-between pt-6">
                <a href="{{ route('home') }}"
                    class="text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali Beranda
                </a>

                @if($questions->count() > 0)
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3.5 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 transition-all shadow-lg shadow-indigo-600/30 hover:shadow-xl hover:-translate-y-0.5 group">
                        Kirim Jawaban Survei
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                @endif
            </div>
        </form>
    </div>

    <!-- Script to natively color elements when checking inputs -->
    <script>
        function updateBoxes(selectedInput, groupName, type) {
            // Get all inputs with the same name
            const inputs = document.querySelectorAll(`input[name="${groupName}"]`);

            inputs.forEach(input => {
                const label = input.closest('label');
                if (!label) return;

                // Strip active classes
                label.classList.remove('border-indigo-600', 'bg-indigo-50', 'ring-2', 'ring-indigo-600', 'border-emerald-500', 'bg-emerald-50', 'ring-emerald-500', 'border-rose-500', 'bg-rose-50', 'ring-rose-500');

                const valText = label.querySelector('.val-text');
                if (valText) valText.classList.remove('text-indigo-700');
                if (valText) valText.classList.add('text-slate-700');

                const labelText = label.querySelector('.label-text');
                if (labelText) labelText.classList.remove('text-indigo-700', 'text-emerald-700', 'text-rose-700');
                if (labelText && type === 'rating') labelText.classList.add('text-slate-500');
                if (labelText && type !== 'rating') labelText.classList.add('text-slate-700');

                const iconSvg = label.querySelector('.icon-svg');
                if (iconSvg) iconSvg.classList.remove('text-emerald-600', 'text-rose-600');
                if (iconSvg) iconSvg.classList.add('text-slate-400');

                // Add active classes to checked
                if (input.checked) {
                    if (type === 'rating') {
                        label.classList.add('border-indigo-600', 'bg-indigo-50', 'ring-2', 'ring-indigo-600');
                        if (valText) valText.classList.replace('text-slate-700', 'text-indigo-700');
                        if (labelText) labelText.classList.replace('text-slate-500', 'text-indigo-700');
                    } else if (input.value === 'Ya') {
                        label.classList.add('border-emerald-500', 'bg-emerald-50', 'ring-2', 'ring-emerald-500');
                        if (iconSvg) iconSvg.classList.replace('text-slate-400', 'text-emerald-600');
                        if (labelText) labelText.classList.replace('text-slate-700', 'text-emerald-700');
                    } else if (input.value === 'Tidak') {
                        label.classList.add('border-rose-500', 'bg-rose-50', 'ring-2', 'ring-rose-500');
                        if (iconSvg) iconSvg.classList.replace('text-slate-400', 'text-rose-600');
                        if (labelText) labelText.classList.replace('text-slate-700', 'text-rose-700');
                    }
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showLoading() {
            Swal.fire({
                title: 'Mengirim Tanggapan...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }
    </script>
@endsection
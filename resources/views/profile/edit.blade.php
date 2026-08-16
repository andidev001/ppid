<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ showPreviewModal: false, previewType: '', previewUrl: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="max-w-4xl mx-auto space-y-6">
                <div
                    class="bg-white rounded-3xl shadow-[0_4px_25px_-5px_rgba(0,0,0,0.05)] border border-slate-100 overflow-hidden">
                    <div class="p-8 sm:p-10">
                        <div class="flex items-center gap-4 mb-8 border-b border-slate-100 pb-6">
                            <div
                                class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-800 brand-font">Pengaturan Profil</h2>
                                <p class="text-sm text-slate-500 mt-1">Perbarui informasi dasar, pasfoto, dan kata sandi
                                    akun Anda.</p>
                            </div>
                        </div>

                        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                            class="space-y-8">
                            @csrf
                            @method('patch')

                            <!-- Photo Section -->
                            <div class="flex items-start gap-6">
                                @if($user->photo)
                                    <div
                                        class="w-24 h-24 rounded-full bg-slate-100 border-4 border-white shadow-lg overflow-hidden shrink-0">
                                        <img src="{{ asset('storage/' . $user->photo) }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="w-24 h-24 rounded-full bg-slate-100 border-4 border-white shadow-lg flex items-center justify-center text-slate-400 shrink-0 uppercase text-3xl font-bold brand-font">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div class="flex-1 mt-2">
                                    <h4 class="text-sm font-bold text-slate-700 mb-1">Pasfoto Profil</h4>
                                    <p class="text-xs text-slate-500 mb-3">Mendukung format PNG atau JPG maksimal 2MB.
                                    </p>
                                    <input type="file" name="photo" accept=".jpg,.jpeg,.png"
                                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                                    <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                                </div>
                            </div>

                            <hr class="border-slate-100">

                            <!-- Info Section -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wider"
                                        for="name">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                        class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm"
                                        required autofocus autocomplete="name">
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <label class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wider"
                                        for="email">Alamat Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                        class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm"
                                        required autocomplete="username">
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>
                            </div>

                            <hr class="border-slate-100">

                            <!-- Additional Info Section (Domicile & Contact) -->
                            <div>
                                <h3
                                    class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">
                                    Data Domisili & Kontak (Wajib Diisi Lengkap)</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <div class="md:col-span-2">
                                        <label
                                            class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wider"
                                            for="address">Alamat Lengkap (Jl/RT/RW)</label>
                                        <textarea name="address" id="address" rows="2"
                                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm">{{ old('address', $user->address) }}</textarea>
                                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wider"
                                            for="province">Provinsi</label>
                                        <input type="text" name="province" id="province"
                                            value="{{ old('province', $user->province) }}"
                                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm"
                                            placeholder="Contoh: Jawa Barat">
                                        <x-input-error class="mt-2" :messages="$errors->get('province')" />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wider"
                                            for="city">Kabupaten / Kota</label>
                                        <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}"
                                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm"
                                            placeholder="Contoh: Kota Bandung">
                                        <x-input-error class="mt-2" :messages="$errors->get('city')" />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wider"
                                            for="district">Kecamatan</label>
                                        <input type="text" name="district" id="district"
                                            value="{{ old('district', $user->district) }}"
                                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm">
                                        <x-input-error class="mt-2" :messages="$errors->get('district')" />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wider"
                                            for="village">Kelurahan / Desa</label>
                                        <input type="text" name="village" id="village"
                                            value="{{ old('village', $user->village) }}"
                                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm">
                                        <x-input-error class="mt-2" :messages="$errors->get('village')" />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wider"
                                            for="postal_code">Kode Pos</label>
                                        <input type="text" name="postal_code" id="postal_code"
                                            value="{{ old('postal_code', $user->postal_code) }}"
                                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm"
                                            inputmode="numeric">
                                        <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wider"
                                            for="phone">No. WhatsApp / Telepon</label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <input type="text" name="phone" id="phone"
                                                value="{{ old('phone', $user->phone) }}"
                                                class="block w-full pl-10 px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm"
                                                placeholder="Contoh: 08123456789">
                                        </div>
                                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                    </div>
                                </div>
                            </div>

                            <hr class="border-slate-100">

                            <!-- Identity Document Section -->
                            @if(in_array($user->role, ['user', 'pemohon']))
                                @php
                                    $docs = [
                                        ['field' => 'identity_file_path', 'label' => 'Dokumen Identitas KTP / Instansi / Utama'],
                                    ];

                                    if ($user->user_type === 'organisasi') {
                                        $docs[] = ['field' => 'identity_file_path_2', 'label' => 'KTP Anggota 1'];
                                        $docs[] = ['field' => 'identity_file_path_3', 'label' => 'KTP Anggota 2'];
                                        $docs[] = ['field' => 'identity_file_path_4', 'label' => 'KTP Anggota 3'];
                                        $docs[] = ['field' => 'identity_file_path_5', 'label' => 'KTP Anggota 4'];
                                    }
                                @endphp

                                <div class="mt-8 space-y-8">
                                    @foreach($docs as $doc)
                                        <div>
                                            <h3
                                                class="text-sm font-bold text-slate-700 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">
                                                {{ $doc['label'] }}
                                            </h3>
                                            <div class="flex flex-col sm:flex-row items-start gap-6">
                                                <div class="w-full sm:w-40 shrink-0">
                                                    @if($user->{$doc['field']})
                                                        @if(\Illuminate\Support\Str::endsWith(strtolower($user->{$doc['field']}), ['pdf']))
                                                            <div class="w-full h-32 bg-rose-50 border border-rose-100 rounded-xl flex flex-col items-center justify-center p-4 group cursor-pointer hover:bg-rose-100 transition-colors"
                                                                @click="previewUrl = '{{ asset('storage/' . $user->{$doc['field']}) }}'; previewType = 'pdf'; showPreviewModal = true;">
                                                                <svg class="w-10 h-10 mb-2 text-rose-500 group-hover:scale-110 transition-transform"
                                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                                    </path>
                                                                </svg>
                                                                <span class="text-[11px] font-bold text-rose-700">PDF Diunggah</span>
                                                                <span class="text-[10px] text-rose-500 mt-1">Klik untuk melihat</span>
                                                            </div>
                                                        @else
                                                            <div class="w-full aspect-[4/3] bg-slate-100 rounded-xl overflow-hidden shadow-sm border border-slate-200 group relative cursor-pointer"
                                                                @click="previewUrl = '{{ asset('storage/' . $user->{$doc['field']}) }}'; previewType = 'image'; showPreviewModal = true;">
                                                                <img src="{{ asset('storage/' . $user->{$doc['field']}) }}"
                                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                                <div
                                                                    class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center transition-opacity">
                                                                    <svg class="w-6 h-6 text-white mb-1" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                                        </path>
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                                        </path>
                                                                    </svg>
                                                                    <span class="text-[10px] text-white font-bold">Lihat Foto</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div
                                                            class="w-full aspect-[4/3] bg-slate-50 rounded-xl flex flex-col items-center justify-center border-2 border-slate-200 border-dashed text-slate-400">
                                                            <svg class="w-7 h-7 mb-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M10 21h4a2 2 0 002-2v-4a2 2 0 00-2-2h-4a2 2 0 00-2 2v4a2 2 0 002 2z">
                                                                </path>
                                                            </svg>
                                                            <span class="text-[11px] font-semibold">Belum Diupload</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-1 w-full">
                                                    <p
                                                        class="text-xs text-slate-500 bg-white p-3 rounded border border-slate-100 flex-1 leading-relaxed">
                                                        @if($loop->first)
                                                            Anda dapat memperbarui atau merubah dokumen identitas ini kapan saja.
                                                            Identitas ini secara otomatis digunakan sebagai lampiran wajib saat Anda
                                                            mengajukan permohonan ke Portal PPID berdasarkan peraturan UU (Maksimal
                                                            besar arsip 5MB format JPG/PNG/PDF).
                                                        @else
                                                            Silakan unggah dokumen KTP anggota Anda di sini (Maksimal 5MB format
                                                            JPG/PNG/PDF).
                                                        @endif
                                                    </p>
                                                    <input type="file" name="{{ $doc['field'] }}"
                                                        accept=".jpg,.jpeg,.png,.pdf,.webp"
                                                        class="block w-full mt-3 text-sm text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer focus:outline-none rounded-lg border border-slate-200 p-1 bg-white">
                                                    <x-input-error class="mt-2" :messages="$errors->get($doc['field'])" />
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <hr class="border-slate-100 mt-8">
                            @endif

                            <!-- Password Section -->
                            <div>
                                <div
                                    class="flex items-center gap-2 mb-4 text-amber-600 bg-amber-50 p-3 rounded-lg border border-amber-200/50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-xs font-semibold">Biarkan kosong jika Anda tidak ingin mengubah
                                        kata sandi.</span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label
                                            class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wider"
                                            for="password">Kata Sandi Baru</label>
                                        <input type="password" name="password" id="password"
                                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm"
                                            autocomplete="new-password">
                                        <x-input-error class="mt-2" :messages="$errors->get('password')" />
                                    </div>

                                    <div>
                                        <label
                                            class="block text-slate-700 text-xs font-bold mb-2 uppercase tracking-wider"
                                            for="password_confirmation">Konfirmasi Sandi Baru</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-medium text-sm"
                                            autocomplete="new-password">
                                        <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                                    </div>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-slate-100 flex items-center gap-4">
                                <button type="submit"
                                    class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 transform hover:-translate-y-0.5 text-sm brand-font">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview Modal -->
        <div x-show="showPreviewModal"
            class="fixed inset-0 z-[100] flex items-center justify-center overflow-hidden bg-slate-900/80 backdrop-blur-sm"
            x-cloak style="display: none;">
            <div x-show="showPreviewModal" @click.away="showPreviewModal = false"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl max-h-[90vh] flex flex-col mx-4 sm:mx-auto">
                <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-slate-800 brand-font">Pratinjau Dokumen Identitas</h3>
                    <button @click="showPreviewModal = false"
                        class="text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div
                    class="flex-1 bg-slate-100 p-0 overflow-auto rounded-b-2xl h-[70vh] flex items-center justify-center">
                    <template x-if="previewType === 'pdf'">
                        <iframe :src="previewUrl" class="w-full h-full border-0"></iframe>
                    </template>
                    <template x-if="previewType === 'image'">
                        <img :src="previewUrl" class="max-w-full max-h-full object-contain p-4 shadow-sm"
                            alt="Dokumen Identitas">
                    </template>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
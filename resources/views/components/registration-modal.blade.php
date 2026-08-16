@props(['type' => 'perorangan'])
@php
    $isLembaga = $type === 'lembaga';
    $isOrganisasi = $type === 'organisasi';
    $modalTitleText = $isLembaga ? 'Lembaga/Instansi' : ($isOrganisasi ? 'Organisasi Bukan Lembaga' : 'Perorangan');
    $modalName = 'open-register-modal-' . $type;
@endphp

<div x-data="{ open: {{ (old('user_type') == $type && $errors->any()) ? 'true' : 'false' }} }" x-on:{{ $modalName }}.window="open = true" @keydown.escape.window="open = false" x-cloak>

    <!-- Backdrop -->
    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">

        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">

            <div x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 max-w-4xl w-full border border-slate-100">

                <!-- Close Button -->
                <button @click="open = false"
                    class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-full p-2 transition-colors z-10 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                <!-- Modal Content -->
                <div class="px-6 py-10 sm:px-10 sm:py-12 max-h-[90vh] overflow-y-auto w-full">

                    <div class="mb-8 pb-6 border-b border-slate-100">
                        <h2 class="text-2xl font-bold text-slate-800 brand-font">
                            Form Registrasi {{ $modalTitleText }}
                        </h2>
                    </div>

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_type" value="{{ $type }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">

                            <!-- KOLOM KIRI -->
                            <div class="space-y-6">

                                <!-- Identification Number -->
                                <div>
                                    <x-input-label for="identification_number_{{$type}}"
                                        value="{{ $isLembaga ? 'NIK/No.Identitas Lembaga' : ($isOrganisasi ? 'NIK/No.Identitas Organisasi' : 'NIK/No.Identitas Pribadi') }}"
                                        class="text-[14px] text-gray-700 mb-1" />
                                    <x-text-input id="identification_number_{{$type}}"
                                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                                        type="text" name="identification_number" :value="old('identification_number')"
                                        required autofocus />
                                    <x-input-error :messages="$errors->get('identification_number')" class="mt-2" />
                                </div>

                                <!-- Name -->
                                <div>
                                    <x-input-label for="name_{{$type}}"
                                        value="{{ $isLembaga ? 'Nama Lembaga / Instansi' : ($isOrganisasi ? 'Nama Organisasi' : 'Nama Lengkap') }}"
                                        class="text-[14px] text-gray-700 mb-1" />
                                    <x-text-input id="name_{{$type}}"
                                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                                        type="text" name="name" :value="old('name')" required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- File Identity Upload -->
                                @if($isOrganisasi)
                                    <div>
                                        <x-input-label for="identity_file_{{$type}}"
                                            value="Upload KTP Ketua / Penanggung Jawab"
                                            class="text-[14px] text-gray-700 mb-1" />
                                        <div class="mt-1 flex items-center">
                                            <input id="identity_file_{{$type}}" name="identity_file" type="file" required
                                                accept=".jpeg,.jpg,.png,.pdf" class="block w-full text-[14px] text-gray-700
                                                    file:mr-2 file:py-1.5 file:px-3
                                                    file:border file:border-gray-300 file:rounded
                                                    file:text-[14px] file:bg-gray-50 file:text-black
                                                    focus:outline-none" />
                                        </div>
                                        <x-input-error :messages="$errors->get('identity_file')" class="mt-2" />
                                    </div>
                                    @for ($i = 2; $i <= 5; $i++)
                                        <div>
                                            <x-input-label for="identity_file_{{$i}}_{{$type}}"
                                                value="Upload KTP Anggota {{ $i - 1 }}"
                                                class="text-[14px] text-gray-700 mb-1" />
                                            <div class="mt-1 flex items-center">
                                                <input id="identity_file_{{$i}}_{{$type}}" name="identity_file_{{$i}}"
                                                    type="file" required accept=".jpeg,.jpg,.png,.pdf" class="block w-full text-[14px] text-gray-700
                                                        file:mr-2 file:py-1.5 file:px-3
                                                        file:border file:border-gray-300 file:rounded
                                                        file:text-[14px] file:bg-gray-50 file:text-black
                                                        focus:outline-none" />
                                            </div>
                                            <x-input-error :messages="$errors->get('identity_file_' . $i)" class="mt-2" />
                                        </div>
                                    @endfor
                                    <p class="text-[12px] text-gray-500 mt-1 italic">*File yang boleh diupload jpg,
                                        jpeg, png, pdf dan maksimal 2MB.</p>
                                @else
                                    <div>
                                        <x-input-label for="identity_file_{{$type}}"
                                            value="{{ $isLembaga ? 'Upload Akta Notaris Lembaga / Organisasi' : 'Upload KTP Pribadi' }}"
                                            class="text-[14px] text-gray-700 mb-1" />
                                        <div class="mt-1 flex items-center">
                                            <input id="identity_file_{{$type}}" name="identity_file" type="file" required
                                                accept=".jpeg,.jpg,.png,.pdf" class="block w-full text-[14px] text-gray-700
                                                    file:mr-2 file:py-1.5 file:px-3
                                                    file:border file:border-gray-300 file:rounded
                                                    file:text-[14px] file:bg-gray-50 file:text-black
                                                    focus:outline-none" />
                                        </div>
                                        <p class="text-[12px] text-gray-500 mt-1 italic">*File yang boleh diupload jpg,
                                            jpeg, png, pdf dan maksimal 2MB.</p>
                                        <x-input-error :messages="$errors->get('identity_file')" class="mt-2" />
                                    </div>
                                @endif

                                <!-- Phone -->
                                <div>
                                    <x-input-label for="phone_{{$type}}" value="Nomor Telepon"
                                        class="text-[14px] text-gray-700 mb-1" />
                                    <x-text-input id="phone_{{$type}}"
                                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                                        type="text" name="phone" :value="old('phone')" required
                                        placeholder="08XX-XXXX-XXXX" />
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>

                                <!-- Job Title -->
                                <div>
                                    <x-input-label for="job_title_{{$type}}" value="Pekerjaan"
                                        class="text-[14px] text-gray-700 mb-1" />
                                    <x-text-input id="job_title_{{$type}}"
                                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                                        type="text" name="job_title" :value="old('job_title')" required
                                        placeholder="Masukan pekerjaan anda :)" />
                                    <x-input-error :messages="$errors->get('job_title')" class="mt-2" />
                                </div>
                            </div>

                            <!-- KOLOM KANAN -->
                            <div class="space-y-6">

                                <!-- Address -->
                                <div>
                                    <x-input-label for="address_{{$type}}" value="Alamat"
                                        class="text-[14px] text-gray-700 mb-1" />
                                    <textarea id="address_{{$type}}" name="address" required rows="3"
                                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                                        placeholder="...">{{ old('address') }}</textarea>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>

                                <!-- Email -->
                                <div>
                                    <x-input-label for="email_{{$type}}" value="Email"
                                        class="text-[14px] text-gray-700 mb-1" />
                                    <x-text-input id="email_{{$type}}"
                                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                                        type="email" name="email" :value="old('email')" required autocomplete="username"
                                        placeholder="Masukan email anda :)" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div>
                                    <x-input-label for="password_{{$type}}" value="Password"
                                        class="text-[14px] text-gray-700 mb-1" />
                                    <x-text-input id="password_{{$type}}"
                                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                                        type="password" name="password" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <x-input-label for="password_confirmation_{{$type}}" value="Konfirmasi Password"
                                        class="text-[14px] text-gray-700 mb-1" />
                                    <x-text-input id="password_confirmation_{{$type}}"
                                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                                        type="password" name="password_confirmation" required
                                        autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                            </div>
                        </div>

                        <div
                            class="mt-10 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <a class="text-sm text-slate-500 hover:text-indigo-600 transition-colors underline-offset-4 hover:underline font-medium"
                                href="{{ route('login') }}">
                                &larr; Sudah punya akun? Masuk
                            </a>

                            <button type="submit"
                                class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white tracking-wide hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 transform hover:-translate-y-0.5">
                                DAFTARKAN AKUN SAYA
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
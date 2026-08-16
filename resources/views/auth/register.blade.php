<x-guest-layout>
    @php
        $type = request('type', 'perorangan');
        $isLembaga = $type === 'lembaga';
    @endphp

    <div class="mb-8 text-center pb-6 border-b border-slate-100">
        <h2 class="text-2xl md:text-3xl font-bold text-slate-800 brand-font">
            Form Registrasi {{ $isLembaga ? 'Instansi / Lembaga' : 'Perorangan' }}
        </h2>
        <p class="text-sm md:text-base text-slate-500 mt-2 max-w-xl mx-auto">Silakan lengkapi formulir pendaftaran di
            bawah ini. Pastikan data yang dimasukkan valid untuk keperluan verifikasi.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_type" value="{{ $type }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">

            <!-- KOLOM KIRI -->
            <div class="space-y-6">

                <!-- Identification Number -->
                <div>
                    <x-input-label for="identification_number"
                        value="{{ $isLembaga ? 'NIK/No.Identitas Lembaga' : 'NIK/No.Identitas Pribadi' }}"
                        class="text-[14px] text-gray-700 mb-1" />
                    <x-text-input id="identification_number"
                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                        type="text" name="identification_number" :value="old('identification_number')" required
                        autofocus />
                    <x-input-error :messages="$errors->get('identification_number')" class="mt-2" />
                </div>

                <!-- Name -->
                <div>
                    <x-input-label for="name" value="{{ $isLembaga ? 'Nama Lembaga / Organisasi' : 'Nama Lengkap' }}"
                        class="text-[14px] text-gray-700 mb-1" />
                    <x-text-input id="name"
                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                        type="text" name="name" :value="old('name')" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- File Identity Upload -->
                <div>
                    <x-input-label for="identity_file"
                        value="{{ $isLembaga ? 'Upload Akta Notaris Lembaga / Organisasi' : 'Upload KTP Pribadi' }}"
                        class="text-[14px] text-gray-700 mb-1" />
                    <div class="mt-1 flex items-center">
                        <input id="identity_file" name="identity_file" type="file" required
                            accept=".jpeg,.jpg,.png,.pdf" class="block w-full text-[14px] text-gray-700
                            file:mr-2 file:py-1.5 file:px-3
                            file:border file:border-gray-300 file:rounded
                            file:text-[14px] file:bg-gray-50 file:text-black
                            focus:outline-none" />
                    </div>
                    <p class="text-[12px] text-gray-500 mt-1 italic">*File yang boleh diupload jpg, jpeg, png dan
                        maksimal 2MB.</p>
                    <x-input-error :messages="$errors->get('identity_file')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div>
                    <x-input-label for="phone" value="Nomor Telepon" class="text-[14px] text-gray-700 mb-1" />
                    <x-text-input id="phone"
                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                        type="text" name="phone" :value="old('phone')" required placeholder="08XX-XXXX-XXXX" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Job Title -->
                <div>
                    <x-input-label for="job_title" value="Pekerjaan" class="text-[14px] text-gray-700 mb-1" />
                    <x-text-input id="job_title"
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
                    <x-input-label for="address" value="Alamat" class="text-[14px] text-gray-700 mb-1" />
                    <textarea id="address" name="address" required rows="3"
                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                        placeholder="...">{{ old('address') }}</textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" value="Email" class="text-[14px] text-gray-700 mb-1" />
                    <x-text-input id="email"
                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                        type="email" name="email" :value="old('email')" required autocomplete="username"
                        placeholder="Masukan email anda :)" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" value="Password" class="text-[14px] text-gray-700 mb-1" />
                    <x-text-input id="password"
                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                        type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" value="Konfirmasi Password"
                        class="text-[14px] text-gray-700 mb-1" />
                    <x-text-input id="password_confirmation"
                        class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2 text-[14px]"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <a class="text-sm text-slate-500 hover:text-indigo-600 transition-colors underline-offset-4 hover:underline font-medium"
                href="{{ route('login') }}">
                &larr; Sudah punya akun? Masuk
            </a>

            <button type="submit"
                class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white tracking-wide hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 transform hover:-translate-y-0.5">
                DAFTARKAN AKUN SAYA
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </button>
        </div>
    </form>
</x-guest-layout>
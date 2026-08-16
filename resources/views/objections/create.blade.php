<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajukan Keberatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-sm text-gray-600">Mengajukan keberatan untuk permohonan: <strong>{{ $request->subject }}</strong></p>
                    <form method="POST" action="{{ route('objections.store') }}">
                        @csrf
                        <input type="hidden" name="information_request_id" value="{{ $request->id }}">
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="reason">Alasan Keberatan</label>
                            <textarea name="reason" id="reason" rows="4" class="shadow-sm border-gray-300 rounded-md w-full focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Jelaskan alasan pengajuan keberatan..."></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 transition">Kirim Keberatan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

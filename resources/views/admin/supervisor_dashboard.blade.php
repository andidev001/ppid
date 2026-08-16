<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atasan PPID Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b">
                    <h3 class="text-lg font-bold mb-4">Pengajuan Keberatan Pemohon</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemohon</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subjek Awal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alasan Keberatan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($objections as $obj)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $obj->user->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $obj->request->subject }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $obj->reason }}</td>
                                        <td class="px-6 py-4 text-sm whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 font-bold uppercase">{{ $obj->status }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            @if ($obj->status == 'pending')
                                                <form action="{{ route('admin.objections.update', $obj->id) }}" method="POST" class="flex flex-col space-y-2">
                                                    @csrf @method('PATCH')
                                                    <textarea name="decision_notes" placeholder="Catatan/Keputusan Keberatan..." class="border-gray-300 rounded text-sm min-w-[200px]" required></textarea>
                                                    <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-800 px-3 py-1 rounded text-xs font-bold">Kirim Keputusan</button>
                                                </form>
                                            @else
                                                <div class="text-sm font-semibold text-gray-700">Keputusan:</div>
                                                <p class="text-xs text-gray-600">{{ $obj->decision_notes }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-6 py-4 text-center">Belum ada keberatan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

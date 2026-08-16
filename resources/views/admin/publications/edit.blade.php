<x-app-layout>
    <x-slot name="header">
        Edit {{ ucfirst($publication->type) }}
    </x-slot>

    <div class="max-w-4xl mx-auto pb-10">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <h3 class="text-lg font-bold text-slate-800 brand-font flex items-center gap-2">
                    <span class="w-7 h-7 rounded flex items-center justify-center bg-indigo-100 text-indigo-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </span>
                    Form Edit Konten
                </h3>
                <a href="{{ route('admin.publications.index', ['type' => $publication->type]) }}"
                    class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition">Kembali</a>
            </div>

            <form action="{{ route('admin.publications.update', $publication->id) }}" method="POST"
                enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="{{ $publication->type }}">

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Judul <span
                                class="text-rose-500">*</span></label>
                        <input type="text" name="title" required value="{{ old('title', $publication->title) }}"
                            class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
                    </div>

                    @if($publication->type == 'agenda')
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Pelaksanaan Agenda <span
                                    class="text-rose-500">*</span></label>
                            <input type="date" name="event_date" required
                                value="{{ old('event_date', $publication->event_date) }}"
                                class="w-full sm:w-64 px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-sm">
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Gambar / Banner <i>(Opsional,
                                ganti jika perlu)</i></label>

                        @if($publication->image)
                            <div class="mb-3">
                                <span class="block text-[11px] text-slate-500 mb-1">Gambar saat ini:</span>
                                <img src="{{ asset('storage/' . $publication->image) }}"
                                    class="h-32 object-cover rounded shadow-sm border border-slate-200">
                            </div>
                        @endif

                        <input type="file" name="image" accept="image/*"
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border border-slate-200 rounded-lg bg-slate-50">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Isi / Konten <span
                                class="text-rose-500">*</span></label>
                        <textarea name="content"
                            id="content-editor">{!! old('content', $publication->content) !!}</textarea>
                    </div>

                    <div class="flex items-center gap-2 pt-2">
                        <input type="checkbox" name="is_published" id="is_published" value="1" {{ $publication->is_published ? 'checked' : '' }}
                            class="w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500">
                        <label for="is_published"
                            class="text-sm font-semibold text-slate-700 cursor-pointer">Ditayangkan (Publik)</label>
                    </div>
                </div>

                <div class="mt-8 pt-5 border-t border-slate-100 flex justify-end gap-3">
                    <a href="{{ route('admin.publications.index', ['type' => $publication->type]) }}"
                        class="px-5 py-2.5 bg-slate-100 text-slate-600 rounded-lg text-sm font-bold hover:bg-slate-200 transition">Batal</a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- TincyMCE Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        /* Sembunyikan notifikasi API Key dan branding TinyMCE */
        .tox-notifications-container,
        .tox-promotion {
            display: none !important;
        }
    </style>
    <script>
        (function() {
            const initEditor = () => {
                if (typeof tinymce === 'undefined' || !document.getElementById('content-editor')) return;
                tinymce.remove('#content-editor');
                tinymce.init({
                    selector: '#content-editor',
                    height: 400,
                    menubar: false,
                    plugins: ['advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'],
                    toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                    content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 14px }',
                    skin: "oxide",
                    promotion: false
                });
            };

            setTimeout(initEditor, 100);

            if (!window.tinymceTurboInterceptor) {
                document.addEventListener('turbo:load', () => {
                    setTimeout(() => { if(window.tinymceInitActive) window.tinymceInitActive(); }, 150);
                });
                window.tinymceTurboInterceptor = true;
            }
            window.tinymceInitActive = initEditor;
        })();
    </script>
</x-app-layout>
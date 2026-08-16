<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'berita'); // berita, pengumuman, agenda
        return view('admin.publications.index', compact('type'));
    }

    public function data(Request $request)
    {
        $type = $request->query('type', 'berita');
        $data = \App\Models\Publication::where('type', $type)->latest();

        return \Yajra\DataTables\Facades\DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('title_info', function ($row) {
                $image = $row->image ? '<img src="' . asset('storage/' . $row->image) . '" class="w-10 h-10 object-cover rounded shadow-sm shrink-0">' : '<div class="w-10 h-10 bg-slate-200 rounded flex items-center justify-center shrink-0"><svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>';
                return '
                    <div class="flex items-center gap-3">
                        ' . $image . '
                        <div>
                            <div class="font-bold text-slate-800">' . e($row->title) . '</div>
                            <div class="text-[11px] text-slate-500">' . $row->created_at->format('d M Y') . '</div>
                        </div>
                    </div>
                ';
            })
            ->addColumn('status', function ($row) {
                return $row->is_published ? '<span class="px-2 py-1 text-[10px] bg-emerald-100 text-emerald-700 rounded border border-emerald-200 font-bold uppercase">Publik</span>' : '<span class="px-2 py-1 text-[10px] bg-slate-100 text-slate-600 rounded border border-slate-200 font-bold uppercase">Draft</span>';
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.publications.edit', $row->id);
                $deleteUrl = route('admin.publications.destroy', $row->id);
                $csrf = csrf_field();
                $method = method_field('DELETE');

                return '
                    <div class="flex items-center justify-end gap-2">
                        <a href="' . $editUrl . '" class="px-3 py-1.5 bg-amber-500 text-white rounded text-[11px] font-bold hover:bg-amber-600 transition shadow-sm">Edit</a>
                        <form action="' . $deleteUrl . '" method="POST" class="inline delete-form">
                            ' . $csrf . ' ' . $method . '
                            <button type="button" class="px-3 py-1.5 bg-rose-600 text-white rounded text-[11px] font-bold hover:bg-rose-700 transition shadow-sm delete-btn">Hapus</button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns(['title_info', 'status', 'action'])
            ->make(true);
    }

    public function create(Request $request)
    {
        $type = $request->query('type', 'berita');
        return view('admin.publications.create', compact('type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:berita,pengumuman,agenda',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'event_date' => 'nullable|date'
        ]);

        $data = $request->only('title', 'type', 'content', 'is_published', 'event_date');
        $data['slug'] = \Illuminate\Support\Str::slug($request->title) . '-' . time();
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('publications', 'public');
        }

        \App\Models\Publication::create($data);

        return redirect()->route('admin.publications.index', ['type' => $request->type])->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $publication = \App\Models\Publication::findOrFail($id);
        return view('admin.publications.edit', compact('publication'));
    }

    public function update(Request $request, $id)
    {
        $publication = \App\Models\Publication::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'event_date' => 'nullable|date'
        ]);

        $data = $request->only('title', 'content', 'event_date');
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            if ($publication->image)
                @unlink(storage_path('app/public/' . $publication->image));
            $data['image'] = $request->file('image')->store('publications', 'public');
        }

        $publication->update($data);

        return redirect()->route('admin.publications.index', ['type' => $publication->type])->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $publication = \App\Models\Publication::findOrFail($id);
        if ($publication->image)
            @unlink(storage_path('app/public/' . $publication->image));
        $type = $publication->type;
        $publication->delete();

        return redirect()->route('admin.publications.index', ['type' => $type])->with('success', 'Data berhasil dihapus.');
    }
}

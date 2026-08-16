<?php

namespace App\Http\Controllers;

use App\Models\Guestbook;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GuestbookController extends Controller
{
    // === PUBLIC METHODS ===

    public function create()
    {
        // Get common settings for public layout
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('pages.guestbook_create', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'institution' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'purpose' => 'required|string'
        ]);

        Guestbook::create($request->all());

        return redirect()->back()->with('success', 'Buku tamumu berhasil diisi. Terima kasih atas kunjungannya!');
    }

    // === ADMIN METHODS ===

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Guestbook::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('d M Y H:i');
                })
                ->addColumn('action', function ($row) {
                    return '<button type="button" onclick="deleteGuestbook(' . $row->id . ')" class="text-rose-500 hover:text-rose-700 transition">Hapus</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.guestbooks.index');
    }

    public function destroy($id)
    {
        $guestbook = Guestbook::findOrFail($id);
        $guestbook->delete();

        return response()->json(['success' => 'Data buku tamu berhasil dihapus.']);
    }
}

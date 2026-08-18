<?php

namespace App\Http\Controllers;

use App\Models\InformationGroup;
use Illuminate\Http\Request;

class InformationGroupController extends Controller
{
    public function index()
    {
        $groups = InformationGroup::orderBy('category')->orderBy('name')->get();
        return view('admin.information_groups', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string'
        ]);

        InformationGroup::create($request->only('name', 'category'));
        return back()->with('success', 'Kelompok Informasi berhasil ditambahkan.');
    }

    public function update(Request $request, InformationGroup $group)
    {
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string'
        ]);

        $group->update($request->only('name', 'category'));
        return back()->with('success', 'Kelompok Informasi berhasil diperbarui.');
    }

    public function destroy(InformationGroup $group)
    {
        $group->delete();
        return back()->with('success', 'Kelompok Informasi berhasil dihapus.');
    }
}

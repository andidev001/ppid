<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Publication;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a new comment (public facing - pending moderation)
     */
    public function store(Request $request, $publicationId)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:150',
            'body' => 'required|string|max:2000',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'body.required' => 'Komentar tidak boleh kosong.',
        ]);

        $publication = Publication::findOrFail($publicationId);

        Comment::create([
            'publication_id' => $publication->id,
            'name' => $request->name,
            'email' => $request->email,
            'body' => $request->body,
            'is_approved' => false,
        ]);

        return back()->with('comment_success', 'Komentar Anda berhasil dikirim dan sedang menunggu persetujuan admin.');
    }

    // ======= ADMIN METHODS =======

    /**
     * Admin: list all comments pending or approved
     */
    public function adminIndex(Request $request)
    {
        $status = $request->get('status', 'pending');

        $comments = Comment::with('publication')
            ->when($status === 'pending', fn($q) => $q->where('is_approved', false))
            ->when($status === 'approved', fn($q) => $q->where('is_approved', true))
            ->latest()
            ->paginate(20);

        $pendingCount = Comment::where('is_approved', false)->count();
        $approvedCount = Comment::where('is_approved', true)->count();

        return view('admin.comments.index', compact('comments', 'status', 'pendingCount', 'approvedCount'));
    }

    /**
     * Admin: approve a comment
     */
    public function approve($id)
    {
        Comment::findOrFail($id)->update(['is_approved' => true]);
        return back()->with('success', 'Komentar berhasil disetujui.');
    }

    /**
     * Admin: reject / delete a comment
     */
    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}

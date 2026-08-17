<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RelatedLink;
use App\Models\GalleryVideo;
use Illuminate\Support\Facades\Storage;

class HomeContentController extends Controller
{
    public function index()
    {
        $links = RelatedLink::orderBy('order_num')->orderBy('created_at', 'desc')->get();
        $videos = GalleryVideo::orderBy('order_num')->orderBy('created_at', 'desc')->get();

        return view('admin.home_content', compact('links', 'videos'));
    }

    public function storeLink(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'logo' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('related_links', 'public');
        }

        RelatedLink::create([
            'title' => $request->title,
            'url' => $request->url,
            'logo_path' => $path,
            'order_num' => RelatedLink::max('order_num') + 1,
        ]);

        return back()->with('success', 'Link berhasil ditambahkan.');
    }

    public function updateLink(Request $request, RelatedLink $link)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'logo' => 'nullable|image|max:2048',
        ]);

        $link->title = $request->title;
        $link->url = $request->url;

        if ($request->hasFile('logo')) {
            if ($link->logo_path) {
                Storage::disk('public')->delete($link->logo_path);
            }
            $link->logo_path = $request->file('logo')->store('related_links', 'public');
        }

        $link->save();

        return back()->with('success', 'Tautan berhasil diperbarui.');
    }

    public function destroyLink(RelatedLink $link)
    {
        if ($link->logo_path) {
            Storage::disk('public')->delete($link->logo_path);
        }
        $link->delete();
        return back()->with('success', 'Tautan berhasil dihapus.');
    }

    public function storeVideo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url',
        ]);

        // Extract YT ID
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $request->youtube_url, $match);
        $youtube_id = $match[1] ?? null;

        GalleryVideo::create([
            'title' => $request->title,
            'youtube_url' => $request->youtube_url,
            'youtube_id' => $youtube_id,
            'order_num' => GalleryVideo::max('order_num') + 1,
        ]);

        return back()->with('success', 'Video berhasil ditambahkan.');
    }

    public function updateVideo(Request $request, GalleryVideo $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url',
        ]);

        // Extract YT ID
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $request->youtube_url, $match);
        $youtube_id = $match[1] ?? null;

        $video->title = $request->title;
        $video->youtube_url = $request->youtube_url;
        if ($youtube_id) {
            $video->youtube_id = $youtube_id;
        }
        $video->save();

        return back()->with('success', 'Galeri Video berhasil diperbarui.');
    }

    public function destroyVideo(GalleryVideo $video)
    {
        $video->delete();
        return back()->with('success', 'Video berhasil dihapus.');
    }
}

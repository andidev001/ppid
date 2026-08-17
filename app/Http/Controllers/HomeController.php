<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PublicInformation;

class HomeController extends Controller
{
    public function index()
    {
        $informations = PublicInformation::latest()->get();
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        $news = \App\Models\Publication::where('type', 'berita')->where('is_published', true)->latest()->take(3)->get();
        $related_links = \App\Models\RelatedLink::orderBy('order_num')->get();
        $gallery_videos = \App\Models\GalleryVideo::orderBy('order_num')->orderBy('created_at', 'desc')->take(4)->get();
        return view('welcome', compact('informations', 'settings', 'news', 'related_links', 'gallery_videos'));
    }
}

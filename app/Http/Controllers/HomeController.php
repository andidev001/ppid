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
        return view('welcome', compact('informations', 'settings', 'news'));
    }
}

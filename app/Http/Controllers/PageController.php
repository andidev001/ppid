<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    private function getCommonData()
    {
        return [
            'settings' => \App\Models\Setting::pluck('value', 'key')->toArray()
        ];
    }

    public function tugasFungsi()
    {
        return view('pages.tugas_fungsi', $this->getCommonData());
    }

    public function profilPpid()
    {
        return view('pages.profil_ppid', $this->getCommonData());
    }

    public function visiMisi()
    {
        return view('pages.visi_misi', $this->getCommonData());
    }

    public function struktur()
    {
        return view('pages.struktur', $this->getCommonData());
    }

    public function sop()
    {
        return view('pages.sop', $this->getCommonData());
    }

    public function maklumat()
    {
        return view('pages.maklumat', $this->getCommonData());
    }

    public function dasarHukum()
    {
        return view('pages.dasar_hukum', $this->getCommonData());
    }

    public function statistik()
    {
        $data = $this->getCommonData();

        $data['total'] = \App\Models\InformationRequest::count();
        $data['pending'] = \App\Models\InformationRequest::where('status', 'pending')->count();
        $data['proses'] = \App\Models\InformationRequest::whereIn('status', ['verified', 'approved'])->count();
        $data['selesai'] = \App\Models\InformationRequest::where('status', 'completed')->count();
        $data['ditolak'] = \App\Models\InformationRequest::where('status', 'rejected')->count();

        $data['obj_pending'] = \App\Models\Objection::where('status', 'pending')->count();
        $data['obj_reviewed'] = \App\Models\Objection::where('status', 'reviewed')->count();
        $data['obj_resolved'] = \App\Models\Objection::where('status', 'resolved')->count();

        $months = [];
        $counts = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->translatedFormat('F Y');
            $counts[] = \App\Models\InformationRequest::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        $data['chartMonths'] = json_encode($months);
        $data['chartCounts'] = json_encode($counts);

        return view('pages.statistik', $data);
    }

    public function pilihPermohonan()
    {
        return view('pages.pilih_permohonan', $this->getCommonData());
    }

    public function cekStatus(Request $request)
    {
        $data = $this->getCommonData();
        $query = $request->query('keyword');
        $data['keyword'] = $query;
        $data['requestData'] = null;

        if ($query) {
            $data['requestData'] = \App\Models\InformationRequest::where('registration_number', strtoupper($query))->first();
        }

        return view('pages.cek_status', $data);
    }

    public function informasi(\Illuminate\Http\Request $request, $kategori)
    {
        $data = $this->getCommonData();

        $categories = [
            'berkala' => 'Informasi Berkala',
            'serta_merta' => 'Informasi Serta Merta',
            'setiap_saat' => 'Informasi Setiap Saat',
            'dikecualikan' => 'Informasi Dikecualikan',
            'arsip' => 'Arsip Dokumen'
        ];

        if (!array_key_exists($kategori, $categories)) {
            abort(404);
        }

        $data['kategoriLabel'] = $categories[$kategori];
        $data['kategori'] = $kategori;

        $query = \App\Models\PublicInformation::where('category', $kategori);

        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $data['informations'] = $query->latest()->paginate(15);
        return view('pages.informasi', $data);
    }

    public function indexPublication($type)
    {
        $data = $this->getCommonData();
        $data['type'] = $type;
        $data['publications'] = \App\Models\Publication::where('type', $type)
            ->where('is_published', true)
            ->latest()
            ->paginate(12);

        return view('pages.publikasi_index', $data);
    }

    public function showPublication($slug)
    {
        $data = $this->getCommonData();
        $publication = \App\Models\Publication::where('slug', $slug)->where('is_published', true)->firstOrFail();

        // Increase view count
        $publication->increment('views');

        $data['publication'] = $publication;
        $data['otherArticles'] = \App\Models\Publication::where('is_published', true)
            ->where('id', '!=', $publication->id)
            ->latest()
            ->take(5)
            ->get();

        $data['comments'] = $publication->comments()
            ->where('is_approved', true)
            ->oldest()
            ->get();

        return view('pages.publikasi_show', $data);
    }
}

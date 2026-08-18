<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    private function getCommonData()
    {
        return [
            'settings' => \App\Models\Setting::pluck('value', 'key')->toArray(),
            'publications' => \App\Models\Publication::where('is_published', true)->latest()->take(4)->get()
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

    public function profilPimpinan()
    {
        return view('pages.profil_pimpinan', $this->getCommonData());
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

    public function prosedurPelayanan()
    {
        return view('pages.prosedur_pelayanan', $this->getCommonData());
    }

    public function prosedurKeberatan()
    {
        return view('pages.prosedur_keberatan', $this->getCommonData());
    }

    public function prosedurSengketa()
    {
        return view('pages.prosedur_sengketa', $this->getCommonData());
    }

    public function penangananSengketa()
    {
        return view('pages.penanganan_sengketa', $this->getCommonData());
    }

    public function kanalLayanan()
    {
        return view('pages.kanal_layanan', $this->getCommonData());
    }

    public function waktuBiaya()
    {
        return view('pages.waktu_biaya', $this->getCommonData());
    }

    public function laporanPpid()
    {
        $data = $this->getCommonData();
        $data['laporans'] = \App\Models\PublicInformation::where('category', 'laporan')->latest()->get();
        return view('pages.laporan_ppid', $data);
    }

    public function laporanSurvey()
    {
        $data = $this->getCommonData();
        $data['laporans'] = \App\Models\PublicInformation::where('category', 'laporan_survey')->latest()->get();
        return view('pages.laporan_survey', $data);
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

        $trend7Months = [];
        $trend7Counts = [];
        $currentYear = now()->year;
        $data['currentYear'] = $currentYear;
        // Generate Januari sampai Desember
        for ($i = 1; $i <= 12; $i++) {
            $date = \Carbon\Carbon::createFromDate($currentYear, $i, 1);
            $trend7Months[] = $date->translatedFormat('F');
            $trend7Counts[] = \App\Models\InformationRequest::where('status', 'completed')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $i)
                ->count();
        }
        $data['trend7Months'] = json_encode($trend7Months);
        $data['trend7Counts'] = json_encode($trend7Counts);

        // Kategori Informasi Publik
        $data['cat_berkala'] = \App\Models\PublicInformation::where('category', 'berkala')->count();
        $data['cat_setiap_saat'] = \App\Models\PublicInformation::where('category', 'setiap_saat')->count();
        $data['cat_serta_merta'] = \App\Models\PublicInformation::where('category', 'serta_merta')->count();
        $data['cat_dikecualikan'] = \App\Models\PublicInformation::where('category', 'dikecualikan')->count();

        // Alasan Keberatan
        $reasons = \App\Models\Objection::select('reason', \DB::raw('count(*) as total'))->groupBy('reason')->pluck('total', 'reason')->toArray();
        $data['obj_reasons'] = [
            'pengecualian' => $reasons['Penolakan atas permintaan informasi berdasarkan alasan pengecualian'] ?? 0,
            'tidak_disediakan' => $reasons['Tidak disediakannya informasi berkala'] ?? 0,
            'tidak_ditanggapi' => $reasons['Permintaan informasi tidak ditanggapi'] ?? 0,
            'tidak_sesuai' => $reasons['Permintaan informasi ditanggapi tidak sebagaimana yang diminta'] ?? 0,
            'tidak_dipenuhi' => $reasons['Permintaan informasi tidak dipenuhi'] ?? 0,
            'biaya_tidak_wajar' => $reasons['Pengenaan biaya yang tidak wajar'] ?? 0,
            'melebihi_waktu' => $reasons['Penyampaian informasi yang melebihi waktu'] ?? 0,
        ];

        // Rata-rata penyelesaian hari murni dari perhitungan DB
        $completedReqs = \App\Models\InformationRequest::where('status', 'completed')->get();
        $avgDays = [
            '2026' => 0,
            '2025' => 0,
            '2024' => 0,
            '2021_2026' => 0
        ];

        if ($completedReqs->count() > 0) {
            $sums = ['2026' => 0, '2025' => 0, '2024' => 0, '2021_2026' => 0];
            $counts = ['2026' => 0, '2025' => 0, '2024' => 0, '2021_2026' => 0];

            foreach ($completedReqs as $r) {
                if ($r->created_at && $r->updated_at) {
                    $diff = $r->created_at->diffInDays($r->updated_at);
                    if ($diff == 0)
                        $diff = 1;

                    $year = $r->created_at->format('Y');

                    if ($year == '2026') {
                        $sums['2026'] += $diff;
                        $counts['2026']++;
                    } elseif ($year == '2025') {
                        $sums['2025'] += $diff;
                        $counts['2025']++;
                    } elseif ($year == '2024') {
                        $sums['2024'] += $diff;
                        $counts['2024']++;
                    }

                    if ($year >= 2021 && $year <= 2026) {
                        $sums['2021_2026'] += $diff;
                        $counts['2021_2026']++;
                    }
                }
            }

            foreach (['2026', '2025', '2024', '2021_2026'] as $k) {
                if ($counts[$k] > 0) {
                    $avgDays[$k] = round($sums[$k] / $counts[$k], 1);
                }
            }
        }
        $data['avgDays'] = $avgDays;

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
            'semua' => 'Daftar Informasi Publik',
            'berkala' => 'Informasi Berkala',
            'serta_merta' => 'Informasi Serta Merta',
            'setiap_saat' => 'Informasi Setiap Saat',
            'dikecualikan' => 'Informasi Dikecualikan',
            'pengadaan' => 'Informasi Pengadaan Barang dan Jasa',
            'arsip' => 'Arsip Dokumen'
        ];

        if (!array_key_exists($kategori, $categories)) {
            abort(404);
        }

        $data['kategoriLabel'] = $categories[$kategori];
        $data['kategori'] = $kategori;

        if ($kategori === 'semua') {
            $query = \App\Models\PublicInformation::query()->orderByRaw('group_name IS NULL, group_name ASC')->orderBy('id', 'asc');
        } else {
            $query = \App\Models\PublicInformation::where('category', $kategori)->orderByRaw('group_name IS NULL, group_name ASC')->orderBy('id', 'asc');
        }

        if ($request->ajax()) {
            return \Yajra\DataTables\Facades\DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('group_name', function ($info) {
                    return $info->group_name ?: '';
                })
                ->editColumn('title', function ($info) {
                    $yearHtml = $info->published_year
                        ? '<span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-[10px] font-bold border border-slate-200 ml-2">' . $info->published_year . '</span>'
                        : '';
                    return '<div class="font-bold text-slate-800">' . htmlspecialchars($info->title) . $yearHtml . '</div>';
                })
                ->addColumn('penanggung_jawab', function ($info) {
                    return $info->penanggung_jawab ? htmlspecialchars($info->penanggung_jawab) : '-';
                })
                ->addColumn('description', function ($info) {
                    return \Illuminate\Support\Str::limit(htmlspecialchars($info->description), 80);
                })
                ->addColumn('category_badge', function ($info) {
                    $catColors = [
                        'berkala' => 'bg-indigo-50 text-indigo-600 border-indigo-200',
                        'serta_merta' => 'bg-amber-50 text-amber-600 border-amber-200',
                        'setiap_saat' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                        'dikecualikan' => 'bg-rose-50 text-rose-600 border-rose-200',
                        'pengadaan' => 'bg-blue-50 text-blue-600 border-blue-200'
                    ];
                    $color = $catColors[$info->category] ?? 'bg-slate-50 text-slate-600 border-slate-200';
                    $label = strtoupper(str_replace('_', ' ', $info->category));
                    return '<span class="px-2.5 py-1 text-[11px] font-bold tracking-wider rounded-md uppercase border ' . $color . '">' . $label . '</span>';
                })
                ->addColumn('action', function ($info) {
                    $url = '#';
                    if ($info->info_type == 'file' && $info->file_path) {
                        $url = asset('storage/' . $info->file_path);
                    } elseif ($info->info_type == 'url' && $info->url) {
                        $url = $info->url;
                    } elseif ($info->info_type == 'video' && $info->video_embed) {
                        $url = $info->video_embed; // Wait, we might need a different handling for video or a link
                    }

                    if ($info->visibility !== 'public') {
                        return '<span class="text-[11px] font-bold text-rose-600 bg-rose-50 border border-rose-200 px-2.5 py-1 rounded-md uppercase tracking-wider">Dikecualikan</span>';
                    }

                    if ($info->info_type == 'fisik') {
                        return '<span class="text-[10px] sm:text-[11px] font-bold text-amber-600 bg-amber-50 border border-amber-200 px-2 py-1 sm:px-2.5 rounded-md tracking-wide flex items-center justify-center gap-1"><svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>Tersedia Cetak/Fisik</span>';
                    }

                    return '<a href="' . $url . '" target="_blank"
                                class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded-lg transition-colors text-xs font-bold w-full sm:w-auto shadow-sm shadow-indigo-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                Lihat Dokumen
                            </a>';
                })
                ->rawColumns(['title', 'category_badge', 'action'])
                ->make(true);
        }

        $data['informations'] = collect([]); // Dummy to not break initial view load
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

    public function galeri()
    {
        $data = $this->getCommonData();
        $data['videos'] = \App\Models\GalleryVideo::orderBy('order_num')->orderBy('created_at', 'desc')->paginate(12);

        return view('pages.galeri', $data);
    }
}

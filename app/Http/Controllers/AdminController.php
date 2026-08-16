<?php
namespace App\Http\Controllers;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\InformationRequest;
use App\Models\Objection;
use App\Models\PublicInformation;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'supervisor') {
            $objections = Objection::with(['user', 'request'])->latest()->get();
            return view('admin.supervisor_dashboard', compact('objections'));
        }

        $informations = PublicInformation::latest()->get();

        $stats = [
            'new_requests' => InformationRequest::where('status', 'pending')->count(),
            'processing_requests' => InformationRequest::where('status', 'verified')->count(),
            'completed_requests' => InformationRequest::whereIn('status', ['approved', 'completed', 'rejected'])->count(),
            'total_objections' => Objection::count(),
            'visitors' => \App\Models\Visitor::count()
        ];

        return view('admin.dashboard', compact('informations', 'stats'));
    }

    public function requestsIndex()
    {
        return view('admin.requests');
    }

    public function requestsData(Request $request)
    {
        $requests = InformationRequest::with('user')->select('information_requests.*')->latest();

        return \Yajra\DataTables\Facades\DataTables::of($requests)
            ->addIndexColumn()
            ->addColumn('applicant', function ($req) {
                return '
                    <div class="font-bold text-indigo-600 text-xs font-mono uppercase">' . e($req->registration_number) . '</div>
                    <div class="font-bold text-slate-800 text-sm mt-0.5">' . e($req->user->name ?? 'User Dihapus') . '</div>
                ';
            })
            ->addColumn('subject_info', function ($req) {
                return '
                    <div class="text-sm font-medium text-slate-700 truncate max-w-[200px]">' . e($req->subject) . '</div>
                    <div class="text-[11px] text-slate-500 mt-1" title="' . e($req->description) . '">' . e(\Illuminate\Support\Str::limit($req->description, 50)) . '</div>
                ';
            })
            ->addColumn('attachment', function ($req) {
                $html = '<div class="flex flex-col gap-2 items-center">';

                // Tombol lampiran surat permohonan
                if ($req->attachment_path) {
                    $html .= '<button type="button" data-url="' . asset('storage/' . $req->attachment_path) . '" class="view-pdf-btn inline-flex w-full justify-center items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-600 hover:text-blue-700 font-semibold text-[11px] rounded transition-colors border border-blue-100">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <span class="truncate">Surat Permohonan</span>
                            </button>';
                } else {
                    $html .= '<span class="text-[11px] text-slate-400 italic">Surat: (-)</span>';
                }

                // Tombol KTP/Identitas user
                if ($req->user && $req->user->identity_file_path) {
                    $html .= '<button type="button" data-url="' . asset('storage/' . $req->user->identity_file_path) . '" class="view-pdf-btn inline-flex w-full justify-center items-center gap-1.5 px-3 py-1.5 bg-indigo-50 text-indigo-600 hover:text-indigo-700 font-semibold text-[11px] rounded transition-colors border border-indigo-100">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                <span class="truncate">KTP Pemohon</span>
                            </button>';
                } else {
                    $html .= '<span class="text-[11px] text-slate-400 italic">KTP: (-)</span>';
                }

                $html .= '</div>';
                return $html;
            })
            ->addColumn('status_badge', function ($req) {
                if ($req->status == 'pending') {
                    return '<span class="px-2.5 py-1 text-[11px] rounded bg-amber-100 text-amber-700 font-semibold border border-amber-200 whitespace-nowrap">Menunggu</span>';
                } elseif ($req->status == 'verified') {
                    return '<span class="px-2.5 py-1 text-[11px] rounded bg-blue-100 text-blue-700 font-semibold border border-blue-200 whitespace-nowrap">Diverifikasi</span>';
                } elseif ($req->status == 'approved' || $req->status == 'completed') {
                    return '<span class="px-2.5 py-1 text-[11px] rounded bg-emerald-100 text-emerald-700 font-semibold border border-emerald-200 whitespace-nowrap">Selesai</span>';
                } elseif ($req->status == 'rejected') {
                    return '<span class="px-2.5 py-1 text-[11px] rounded bg-rose-100 text-rose-700 font-semibold border border-rose-200 whitespace-nowrap">Ditolak</span>';
                }
                return $req->status;
            })
            ->addColumn('action', function ($req) {
                $csrf = csrf_field();
                $method = method_field('PATCH');
                $route = route('admin.requests.update', $req->id);

                if ($req->status == 'pending') {
                    return '
                        <div class="flex flex-col xl:flex-row gap-2 justify-end">
                            <form action="' . $route . '" method="POST" class="flex flex-col bg-indigo-50 p-2 rounded-lg border border-indigo-200 shadow-sm w-full xl:w-40 text-left">
                                ' . $csrf . ' ' . $method . '
                                <input type="hidden" name="action" value="verify_complete">
                                <span class="text-[11px] font-semibold text-indigo-700 mb-1">Pengecekan Dokumen</span>
                                <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 px-2 py-1.5 rounded-md text-[11px] font-bold transition">✅ Dokumen Lengkap</button>
                            </form>
                            <form action="' . $route . '" method="POST" class="flex flex-col bg-amber-50 p-2 rounded-lg border border-amber-200 shadow-sm w-full xl:w-40 text-left mt-2 xl:mt-0">
                                ' . $csrf . ' ' . $method . '
                                <input type="hidden" name="action" value="reject_incomplete">
                                <span class="text-[11px] font-semibold text-amber-800 mb-1">❌ Tidak Lengkap</span>
                                <input type="text" name="rejection_reason" placeholder="Berikan komentar/notif..." class="block w-full text-[11px] px-2 py-1 mb-2 border border-amber-200 rounded-md focus:ring-amber-500 focus:border-amber-500 bg-white" required>
                                <button type="submit" class="w-full text-white bg-amber-500 hover:bg-amber-600 px-2 py-1.5 rounded-md text-[11px] font-bold transition">Kirim Notif to Pemohon</button>
                            </form>
                        </div>
                    ';
                } elseif ($req->status == 'verified') {
                    return '
                        <div class="flex flex-col xl:flex-row gap-2 justify-end">
                            <form action="' . $route . '" method="POST" enctype="multipart/form-data" class="flex flex-col bg-emerald-50 p-2 rounded-lg border border-emerald-200 shadow-sm w-full xl:w-40 text-left">
                                ' . $csrf . ' ' . $method . '
                                <input type="hidden" name="action" value="approve">
                                <span class="text-[11px] font-semibold text-emerald-700 mb-1">Diterima (Proses Kirim)</span>
                                <input type="file" name="response_file" class="block w-full text-[10px] text-slate-500 file:mr-2 file:py-1 file:px-2 file:-ml-1 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200 mb-2 cursor-pointer" required>
                                <button type="submit" class="w-full text-white bg-emerald-600 hover:bg-emerald-700 px-2 py-1.5 rounded-md text-[11px] font-bold transition">Kirim Dokumen</button>
                            </form>
                            <form action="' . $route . '" method="POST" class="flex flex-col bg-rose-50 p-2 rounded-lg border border-rose-200 shadow-sm w-full xl:w-40 text-left mt-2 xl:mt-0">
                                ' . $csrf . ' ' . $method . '
                                <input type="hidden" name="action" value="reject">
                                <span class="text-[11px] font-semibold text-rose-800 mb-1">Ditolak</span>
                                <input type="text" name="rejection_reason" placeholder="Ketik alasan penolakan..." class="block w-full text-[11px] px-2 py-1 mb-2 border border-rose-200 rounded-md focus:ring-rose-500 focus:border-rose-500 bg-white" required>
                                <button type="submit" class="w-full text-white bg-rose-600 hover:bg-rose-700 px-2 py-1.5 rounded-md text-[11px] font-bold transition">Tolak Permohonan</button>
                            </form>
                        </div>
                    ';
                } else {
                    return '<div class="text-right"><span class="text-[11px] font-medium text-slate-400 italic">Telah diproses</span></div>';
                }
            })
            ->rawColumns(['applicant', 'subject_info', 'attachment', 'status_badge', 'action'])
            ->make(true);
    }

    public function updateRequest(Request $req, $id)
    {
        $request = InformationRequest::findOrFail($id);

        if ($req->action == 'verify_complete') {
            $request->update(['status' => 'verified']);
        } elseif ($req->action == 'reject_incomplete') {
            $req->validate(['rejection_reason' => 'required|string']);
            $request->update([
                'status' => 'rejected',
                'rejection_reason' => 'Dokumen Tidak Lengkap: ' . $req->rejection_reason
            ]);
        } elseif ($req->action == 'approve') {
            $req->validate(['response_file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip,rar,jpg,jpeg,png|max:10240']);
            $path = $req->file('response_file')->store('responses', 'public');
            $request->update(['status' => 'approved', 'response_file' => $path]);
        } elseif ($req->action == 'reject') {
            $req->validate(['rejection_reason' => 'required|string']);
            $request->update([
                'status' => 'rejected',
                'rejection_reason' => 'Permohonan Ditolak: ' . $req->rejection_reason
            ]);
        }

        return back()->with('success', 'Status permohonan diperbarui.');
    }

    public function objectionsIndex(Request $request)
    {
        $status = $request->query('status', 'pending');
        return view('admin.objections', compact('status'));
    }

    public function objectionsData(Request $request)
    {
        $status = $request->query('status', 'pending');

        $objections = \App\Models\Objection::with(['user', 'request'])->where('status', $status)->latest();

        return \Yajra\DataTables\Facades\DataTables::of($objections)
            ->addIndexColumn()
            ->addColumn('applicant', function ($obj) {
                return '
                    <div class="font-bold text-indigo-600 text-xs font-mono uppercase">' . e($obj->request->registration_number ?? '-') . '</div>
                    <div class="font-bold text-slate-800 text-sm mt-0.5">' . e($obj->user->name ?? 'User Dihapus') . '</div>
                ';
            })
            ->addColumn('reason_info', function ($obj) {
                return '
                    <div class="text-sm text-slate-700 whitespace-normal min-w-[200px]">' . e($obj->reason) . '</div>
                ';
            })
            ->addColumn('status_badge', function ($obj) {
                if ($obj->status == 'pending') {
                    return '<span class="px-2.5 py-1 text-[11px] rounded bg-amber-100 text-amber-700 font-semibold border border-amber-200 whitespace-nowrap">Pengajuan</span>';
                } elseif ($obj->status == 'reviewed') {
                    return '<span class="px-2.5 py-1 text-[11px] rounded bg-blue-100 text-blue-700 font-semibold border border-blue-200 whitespace-nowrap">Diproses</span>';
                } elseif ($obj->status == 'resolved') {
                    return '<span class="px-2.5 py-1 text-[11px] rounded bg-emerald-100 text-emerald-700 font-semibold border border-emerald-200 whitespace-nowrap">Selesai</span>';
                } elseif ($obj->status == 'rejected') {
                    return '<span class="px-2.5 py-1 text-[11px] rounded bg-rose-100 text-rose-700 font-semibold border border-rose-200 whitespace-nowrap">Ditolak</span>';
                }
                return $obj->status;
            })
            ->addColumn('action', function ($obj) {
                $csrf = csrf_field();
                $method = method_field('PATCH');
                $route = route('admin.objections.update', $obj->id);

                if ($obj->status == 'pending') {
                    return '
                        <form action="' . $route . '" method="POST" class="inline-block text-right w-full">
                            ' . $csrf . ' ' . $method . '
                            <input type="hidden" name="action" value="process">
                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-600 text-white rounded-lg text-[11px] font-semibold hover:bg-indigo-700 transition shadow-sm whitespace-nowrap">
                                Proses Keberatan
                            </button>
                        </form>
                    ';
                } elseif ($obj->status == 'reviewed') {
                    return '
                        <div class="flex flex-col xl:flex-row gap-2 justify-end">
                            <form action="' . $route . '" method="POST" enctype="multipart/form-data" class="flex flex-col bg-emerald-50 p-2 rounded-lg border border-emerald-200 shadow-sm w-full xl:w-48 text-left">
                                ' . $csrf . ' ' . $method . '
                                <input type="hidden" name="action" value="resolve">
                                <span class="text-[11px] font-semibold text-emerald-700 mb-1">Terima / Selesaikan</span>
                                <textarea name="decision_notes" placeholder="Berikan penjelasan..." class="block w-full text-[11px] px-2 py-1 mb-2 border border-emerald-200 rounded-md focus:ring-emerald-500 focus:border-emerald-500 bg-white resize-none" required rows="2"></textarea>
                                <input type="file" name="response_file" class="block w-full text-[10px] text-slate-500 file:mr-2 file:py-1 file:px-2 file:-ml-2 file:rounded file:border-0 file:text-[10px] file:font-semibold file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200 mb-2 cursor-pointer" required>
                                <button type="submit" class="w-full text-white bg-emerald-600 hover:bg-emerald-700 px-2 py-1.5 rounded-md text-[11px] font-bold transition">Tandai Selesai</button>
                            </form>
                            <form action="' . $route . '" method="POST" class="flex flex-col bg-rose-50 p-2 rounded-lg border border-rose-200 shadow-sm w-full xl:w-48 text-left mt-2 xl:mt-0">
                                ' . $csrf . ' ' . $method . '
                                <input type="hidden" name="action" value="reject">
                                <span class="text-[11px] font-semibold text-rose-800 mb-1">Tolak Keberatan</span>
                                <textarea name="decision_notes" placeholder="Ketik alasan penolakan..." class="block w-full text-[11px] px-2 py-1 mb-2 border border-rose-200 rounded-md focus:ring-rose-500 focus:border-rose-500 bg-white resize-none" required rows="2"></textarea>
                                <button type="submit" class="w-full text-white bg-rose-600 hover:bg-rose-700 px-2 py-1.5 rounded-md text-[11px] font-bold transition">Tolak Keberatan</button>
                            </form>
                        </div>
                    ';
                } else {
                    $fileBtn = $obj->response_file
                        ? '<a href="' . asset('storage/' . $obj->response_file) . '" target="_blank" class="block mt-2 text-center bg-white border border-emerald-200 px-2 py-1 rounded text-[10px] text-emerald-700 font-bold hover:bg-emerald-50">Unduh Berkas Solusi</a>'
                        : '';
                    $boxColor = $obj->status == 'rejected' ? 'rose' : 'emerald';
                    $titleText = $obj->status == 'rejected' ? 'Alasan Penolakan:' : 'Penyelesaian:';

                    return '
                        <div class="text-right flex justify-end">
                            <div class="text-[11px] text-' . $boxColor . '-700 bg-' . $boxColor . '-50 p-2 rounded border border-' . $boxColor . '-100 inline-block w-48 text-left whitespace-normal">
                                <strong>' . $titleText . '</strong><br>
                                ' . e($obj->decision_notes) . '
                                ' . $fileBtn . '
                            </div>
                        </div>
                    ';
                }
            })
            ->rawColumns(['applicant', 'reason_info', 'status_badge', 'action'])
            ->make(true);
    }

    public function updateObjection(Request $req, $id)
    {
        $objection = \App\Models\Objection::findOrFail($id);

        if ($req->action == 'process') {
            $objection->update(['status' => 'reviewed']);
            return back()->with('success', 'Keberatan sedang diproses.');
        } elseif ($req->action == 'resolve') {
            $req->validate([
                'decision_notes' => 'required|string',
                'response_file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip,rar,jpg,jpeg,png|max:10240'
            ]);

            $path = $req->file('response_file')->store('objections', 'public');

            $objection->update([
                'status' => 'resolved',
                'decision_notes' => $req->decision_notes,
                'response_file' => $path
            ]);
            return back()->with('success', 'Keberatan telah diselesaikan dengan melampirkan berkas!');
        } elseif ($req->action == 'reject') {
            $req->validate(['decision_notes' => 'required|string']);

            $objection->update([
                'status' => 'rejected',
                'decision_notes' => $req->decision_notes
            ]);
            return back()->with('success', 'Keberatan telah ditolak secara resmi.');
        }

        return back();
    }

    public function storePublicInfo(Request $req)
    {
        $req->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'visibility' => 'required|in:public,restricted',
            'info_file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240'
        ]);

        $path = $req->file('info_file')->store('public_info', 'public');

        PublicInformation::create([
            'title' => $req->title,
            'category' => $req->category,
            'description' => $req->description,
            'visibility' => $req->visibility,
            'file_path' => $path
        ]);

        return back()->with('success', 'Informasi publik ditambahkan.');
    }

    public function publicInfoIndex(Request $request)
    {
        $category = $request->query('category', 'berkala');
        $search = $request->query('search');

        $informations = PublicInformation::where('category', $category)
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.public_info', compact('informations', 'category'));
    }

    public function updatePublicInfo(Request $req, $id)
    {
        $info = PublicInformation::findOrFail($id);

        $req->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'visibility' => 'required|in:public,restricted',
            'info_file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240'
        ]);

        if ($req->hasFile('info_file')) {
            if ($info->file_path && Storage::disk('public')->exists($info->file_path)) {
                Storage::disk('public')->delete($info->file_path);
            }
            $info->file_path = $req->file('info_file')->store('public_info', 'public');
        }

        $info->title = $req->title;
        $info->description = $req->description;
        $info->visibility = $req->visibility;
        $info->save();

        return back()->with('success', 'Dokumen informasi publik berhasil diperbarui.');
    }

    public function destroyPublicInfo($id)
    {
        $info = PublicInformation::findOrFail($id);
        if ($info->file_path && Storage::disk('public')->exists($info->file_path)) {
            Storage::disk('public')->delete($info->file_path);
        }
        $info->delete();
        return back()->with('success', 'Dokumen informasi publik berhasil dihapus.');
    }

    public function settings()
    {
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $req)
    {
        $data = $req->except('_token');

        foreach ($data as $key => $value) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Pengaturan berhasil disimpan!')->with('active_tab', 'identitas');
    }

    public function uploadLogo(Request $request)
    {
        $request->validate([
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'app_foto_kepsek' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'app_foto_sekda' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $mediaFields = ['app_logo', 'app_foto_kepsek', 'app_foto_sekda'];

        foreach ($mediaFields as $field) {
            if ($request->hasFile($field)) {
                $oldFile = Setting::where('key', $field)->value('value');
                if ($oldFile && \Illuminate\Support\Facades\Storage::disk('public')->exists($oldFile)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($oldFile);
                }

                $path = $request->file($field)->store('media', 'public');
                Setting::updateOrCreate(['key' => $field], ['value' => $path]);
            }
        }

        return redirect()->back()->with('success', 'Media & Logo berhasil diperbarui.')->with('active_tab', 'logo');
    }

    public function pages()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.pages', compact('settings'));
    }

    public function updatePages(Request $request)
    {
        // Allowed page keys
        $keys = [
            'page_profil_ppid',
            'page_tugas_fungsi',
            'page_visi_misi',
            'page_struktur',
            'page_sop',
            'page_maklumat',
            'page_dasar_hukum',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return redirect()->back()->with('success', 'Konten profil PPID berhasil diperbarui.')->with('active_tab', 'surat');
    }

    public function users(Request $request)
    {
        return view('admin.users');
    }

    public function usersData(Request $request)
    {
        $users = User::where('role', 'user')->latest();

        return \Yajra\DataTables\Facades\DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('info', function ($user) {
                // Return data for the modal detail in a clean array
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_type' => $user->user_type,
                    'identification_number' => $user->identification_number ?? 'Belum diset',
                    'phone' => $user->phone ?? 'Belum diset',
                    'job_title' => $user->job_title ?? 'Belum diset',
                    'address' => $user->address ?? 'Belum diset',
                    'province' => $user->province ?? '-',
                    'city' => $user->city ?? '-',
                    'district' => $user->district ?? '-',
                    'village' => $user->village ?? '-',
                    'postal_code' => $user->postal_code ?? '-',
                    'identity_file_path' => $user->identity_file_path ? asset('storage/' . $user->identity_file_path) : null,
                    'identity_file_type' => $user->identity_file_path ? (\Illuminate\Support\Str::endsWith(strtolower($user->identity_file_path), ['pdf']) ? 'pdf' : 'image') : null,
                    'identity_file_path_2' => $user->identity_file_path_2 ? asset('storage/' . $user->identity_file_path_2) : null,
                    'identity_file_type_2' => $user->identity_file_path_2 ? (\Illuminate\Support\Str::endsWith(strtolower($user->identity_file_path_2), ['pdf']) ? 'pdf' : 'image') : null,
                    'identity_file_path_3' => $user->identity_file_path_3 ? asset('storage/' . $user->identity_file_path_3) : null,
                    'identity_file_type_3' => $user->identity_file_path_3 ? (\Illuminate\Support\Str::endsWith(strtolower($user->identity_file_path_3), ['pdf']) ? 'pdf' : 'image') : null,
                    'identity_file_path_4' => $user->identity_file_path_4 ? asset('storage/' . $user->identity_file_path_4) : null,
                    'identity_file_type_4' => $user->identity_file_path_4 ? (\Illuminate\Support\Str::endsWith(strtolower($user->identity_file_path_4), ['pdf']) ? 'pdf' : 'image') : null,
                    'identity_file_path_5' => $user->identity_file_path_5 ? asset('storage/' . $user->identity_file_path_5) : null,
                    'identity_file_type_5' => $user->identity_file_path_5 ? (\Illuminate\Support\Str::endsWith(strtolower($user->identity_file_path_5), ['pdf']) ? 'pdf' : 'image') : null
                ];
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d M Y');
            })
            ->make(true);
    }

    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'Akun pengguna berhasil dihapus.');
    }
}

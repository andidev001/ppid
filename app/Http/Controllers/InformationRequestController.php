<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\InformationRequest;

class InformationRequestController extends Controller
{
    private function checkRole()
    {
        if (auth()->user()->role === 'admin' || auth()->user()->role === 'supervisor') {
            return true;
        }
        return false;
    }

    public function index()
    {
        if ($this->checkRole())
            return redirect()->route('admin.dashboard');

        return view('requests.index');
    }

    public function historyData()
    {
        if ($this->checkRole())
            return response()->json(['error' => 'Unauthorized']);

        $requests = auth()->user()->informationRequests()->with('objection')->latest();

        return \Yajra\DataTables\Facades\DataTables::of($requests)
            ->addIndexColumn()
            ->addColumn('subject_info', function ($req) {
                $regNumber = $req->registration_number ?? 'REQ-LAMA';
                $datetime = $req->created_at->format('d M Y, H:i');
                return '
                    <div class="font-mono text-xs font-bold text-indigo-600 bg-indigo-50 inline-block px-2 py-0.5 rounded border border-indigo-100 mb-2">' . e($regNumber) . '</div>
                    <div class="font-bold text-slate-800">' . e($req->subject) . '</div>
                    <div class="text-xs text-slate-400 mt-1 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        ' . $datetime . '
                    </div>
                ';
            })
            ->addColumn('status_badge', function ($req) {
                if ($req->status == 'pending') {
                    return '<span class="px-3 py-1 text-xs rounded-full bg-amber-100 text-amber-700 font-semibold border border-amber-200 shadow-sm whitespace-nowrap">Menunggu</span>';
                } elseif ($req->status == 'verified') {
                    return '<span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-semibold border border-blue-200 shadow-sm whitespace-nowrap">Diverifikasi</span>';
                } elseif ($req->status == 'approved' || $req->status == 'completed') {
                    return '<span class="px-3 py-1 text-xs rounded-full bg-emerald-100 text-emerald-700 font-semibold border border-emerald-200 shadow-sm flex inline-flex items-center gap-1 whitespace-nowrap"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Disetujui</span>';
                } elseif ($req->status == 'rejected') {
                    return '<span class="px-3 py-1 text-xs rounded-full bg-rose-100 text-rose-700 font-semibold border border-rose-200 shadow-sm whitespace-nowrap">Ditolak</span>';
                }
                return '-';
            })
            ->addColumn('action', function ($req) {
                if ($req->status == 'approved' || $req->status == 'completed') {
                    if ($req->response_file) {
                        return '
                            <a href="' . asset('storage/' . $req->response_file) . '" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-lg text-[11px] font-bold hover:bg-emerald-100 transition shadow-sm border border-emerald-200 whitespace-nowrap">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Unduh File
                            </a>
                        ';
                    } else {
                        return '<span class="text-[11px] font-semibold text-slate-500 bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-200 whitespace-nowrap">Siap Diambil</span>';
                    }
                } elseif ($req->status == 'rejected') {
                    $html = '
                        <div class="flex flex-col items-end gap-2 text-right">
                            <div class="text-[11px] text-rose-600 bg-rose-50 px-2 py-1.5 rounded-md border border-rose-100 text-left max-w-[220px] whitespace-normal">
                                <strong>Alasan:</strong> ' . e($req->rejection_reason) . '
                            </div>
                    ';

                    if ($req->objection) {
                        $obStatus = $req->objection->status;
                        $color = $obStatus == 'pending' ? 'amber' : ($obStatus == 'reviewed' ? 'blue' : ($obStatus == 'rejected' ? 'rose' : 'emerald'));
                        $label = $obStatus == 'pending' ? 'Menunggu' : ($obStatus == 'reviewed' ? 'Diproses' : ($obStatus == 'rejected' ? 'Ditolak' : 'Selesai'));

                        $html .= '
                            <div class="mt-1 text-[11px] text-left w-full p-2 border rounded-md bg-' . $color . '-50 border-' . $color . '-200">
                                <div class="font-bold flex items-center justify-between gap-1 mb-1 text-' . $color . '-700">
                                    <span>Status Keberatan:</span>
                                    <span class="px-1.5 py-0.5 rounded bg-white border opacity-80 text-[9px] uppercase">' . $label . '</span>
                                </div>
                        ';
                        if ($obStatus == 'resolved' || $obStatus == 'rejected') {
                            $html .= '<div class="mt-1 text-slate-600 border-t border-slate-200 pt-1"><strong>Tanggapan:</strong> ' . e($req->objection->decision_notes) . '</div>';
                            if ($req->objection->response_file) {
                                $html .= '<a href="' . asset('storage/' . $req->objection->response_file) . '" target="_blank" class="block w-full mt-1.5 text-center text-[10px] font-bold text-emerald-700 bg-white border border-emerald-300 py-1 rounded hover:bg-emerald-100 transition shadow-sm">Unduh File Solusi</a>';
                            }
                        } else {
                            $html .= '<div class="text-slate-500 italic text-[9px]">Sebentar lagi ditindak PPID...</div>';
                        }
                        $html .= '</div>';
                    } else {
                        $html .= '
                            <a href="' . route('objections.create', $req->id) . '" class="inline-flex items-center gap-1 text-[11px] font-bold text-indigo-600 hover:text-indigo-800 transition px-2 py-1 rounded hover:bg-indigo-50 mt-1 whitespace-nowrap">
                                Ajukan Keberatan
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        ';
                    }
                    $html .= '</div>';
                    return $html;
                } else {
                    return '<span class="text-[11px] font-medium text-slate-300">-</span>';
                }
            })
            ->rawColumns(['subject_info', 'status_badge', 'action'])
            ->make(true);
    }

    public function create()
    {
        if ($this->checkRole())
            return redirect()->route('admin.dashboard');

        return view('requests.create');
    }

    public function store(Request $request)
    {
        if ($this->checkRole())
            return redirect()->route('admin.dashboard');

        $request->validate([
            'subject' => 'required|string|max:255',
            'information_purpose' => 'required|string',
            'description' => 'required|string',
            'obtaining_method' => 'required|string',
            'attachment_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $filePath = null;
        if ($request->hasFile('attachment_file')) {
            $filePath = $request->file('attachment_file')->store('requests/attachments', 'public');
        }

        $regNumber = 'REQ-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(5));

        auth()->user()->informationRequests()->create([
            'registration_number' => $regNumber,
            'subject' => $request->subject,
            'information_purpose' => $request->information_purpose,
            'description' => $request->description,
            'obtaining_method' => $request->obtaining_method,
            'attachment_path' => $filePath,
            'status' => 'pending'
        ]);

        return redirect()->route('requests.index')->with('registration_success', $regNumber);
    }
}

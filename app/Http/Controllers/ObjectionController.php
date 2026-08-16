<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\InformationRequest;
use App\Models\Objection;

class ObjectionController extends Controller
{
    public function create($request_id)
    {
        $request = InformationRequest::where('id', $request_id)->where('user_id', auth()->id())->firstOrFail();
        return view('objections.create', compact('request'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'information_request_id' => 'required|exists:information_requests,id',
            'reason' => 'required|string',
        ]);

        $request = InformationRequest::where('id', $req->information_request_id)->where('user_id', auth()->id())->firstOrFail();

        Objection::create([
            'information_request_id' => $request->id,
            'user_id' => auth()->id(),
            'reason' => $req->reason,
            'status' => 'pending'
        ]);

        return redirect()->route('requests.index')->with('success', 'Keberatan berhasil diajukan dan akan diproses oleh Atasan PPID.');
    }
}

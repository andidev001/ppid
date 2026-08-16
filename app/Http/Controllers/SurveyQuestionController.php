<?php

namespace App\Http\Controllers;

use App\Models\SurveyQuestion;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SurveyQuestionController extends Controller
{
    public function index()
    {
        return view('admin.survey_questions');
    }

    public function data()
    {
        $questions = SurveyQuestion::query();
        return DataTables::of($questions)
            ->addColumn('action', function ($row) {
                return '<div class="flex items-center justify-center gap-2">
                            <button onclick="editQuestion(' . $row->id . ')" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 rounded-lg text-xs font-bold transition-colors tooltip" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </button>
                            <button onclick="deleteQuestion(' . $row->id . ')" class="inline-flex items-center px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-lg text-xs font-bold transition-colors tooltip" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'type' => 'required|in:rating,text,yes_no',
            'order_num' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $question = SurveyQuestion::create($data);
        return response()->json(['message' => 'Pertanyaan survei berhasil ditambahkan', 'data' => $question]);
    }

    public function edit($id)
    {
        $question = SurveyQuestion::findOrFail($id);
        return response()->json($question);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'type' => 'required|in:rating,text,yes_no',
            'order_num' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $question = SurveyQuestion::findOrFail($id);
        $question->update($data);

        return response()->json(['message' => 'Pertanyaan survei berhasil diperbarui', 'data' => $question]);
    }

    public function destroy($id)
    {
        $question = SurveyQuestion::findOrFail($id);
        $question->delete();
        return response()->json(['message' => 'Pertanyaan survei berhasil dihapus']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveyQuestion;
use App\Models\SurveyResponse;
use App\Models\SurveyAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SurveyResultController extends Controller
{
    public function index()
    {
        // Calculate aggregations for charts
        $questions = SurveyQuestion::orderBy('order_num', 'asc')->get();

        $chartData = [];
        $averageRatings = [];

        foreach ($questions as $q) {
            if ($q->type === 'rating' || $q->type === 'yes_no') {
                $counts = SurveyAnswer::where('survey_question_id', $q->id)
                    ->select('answer_text', DB::raw('count(*) as total'))
                    ->groupBy('answer_text')
                    ->get()
                    ->pluck('total', 'answer_text')
                    ->toArray();
                $chartData[$q->id] = $counts;

                if ($q->type === 'rating') {
                    // compute average
                    $totalScore = 0;
                    $totalVotes = 0;
                    foreach ($counts as $val => $cnt) {
                        $totalScore += intval($val) * intval($cnt);
                        $totalVotes += intval($cnt);
                    }
                    $averageRatings[$q->id] = $totalVotes > 0 ? round($totalScore / $totalVotes, 1) : 0;
                }

            } else {
                // Fetch the latest 5 text responses
                $chartData[$q->id] = SurveyAnswer::where('survey_question_id', $q->id)
                    ->whereNotNull('answer_text')
                    ->latest()
                    ->take(5)
                    ->get();
            }
        }

        $totalResponses = SurveyResponse::count();

        return view('admin.survey_results', compact('questions', 'chartData', 'averageRatings', 'totalResponses'));
    }

    public function data(Request $request)
    {
        $responses = SurveyResponse::latest()->get();

        return DataTables::of($responses)
            ->addColumn('created_at_fmt', function ($row) {
                return $row->created_at->format('d M Y H:i');
            })
            ->addColumn('action', function ($row) {
                return '<button onclick="viewDetails(' . $row->id . ')" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 rounded-lg text-xs font-bold transition-colors tooltip" title="Lihat Detail">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Jawaban Lengkap
                        </button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show($id)
    {
        $response = SurveyResponse::with('answers.question')->findOrFail($id);

        return response()->json([
            'response' => $response,
            'answers' => $response->answers->map(function ($ans) {
                return [
                    'question' => $ans->question ? $ans->question->question : 'Pertanyaan dihapus',
                    'answer' => $ans->answer_text
                ];
            })
        ]);
    }
}

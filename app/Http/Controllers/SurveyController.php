<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveyQuestion;
use App\Models\SurveyResponse;
use App\Models\SurveyAnswer;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public function index()
    {
        // View with active survey questions
        $questions = SurveyQuestion::where('is_active', true)->orderBy('order_num', 'asc')->get();
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('pages.survey', compact('questions', 'settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $response = SurveyResponse::create($request->only(['name', 'email', 'phone', 'age_group', 'education', 'job']));

            foreach ($request->answers as $question_id => $answer_text) {
                SurveyAnswer::create([
                    'survey_response_id' => $response->id,
                    'survey_question_id' => $question_id,
                    'answer_text' => $answer_text
                ]);
            }

            DB::commit();

            return redirect()->route('home')->with('success', 'Terima kasih atas partisipasi Anda dalam survei kepuasan masyarakat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }
}

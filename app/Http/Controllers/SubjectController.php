<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMcqRequest;

class SubjectController extends Controller
{
    public function show(Request $request, String $subjectId)
    {
        $subjectName = DB::table('subjects')->where('id', $subjectId)->value('name');
        $subjectColor = DB::table('subjects')->where('id', $subjectId)->value('color');
        $questionsRows = DB::table('questions')->where('subject_id', $subjectId)->get();
        //dd($questionsRows[0]->text);
        $questionsAndAnswer = [];
        foreach($questionsRows as $question){
            $questionsAndAnswer[$question->text] = 
                DB::table('answers')
                    ->select('id', 'text', 'is_correct', 'is_checked')
                    ->where('question_id', $question->id)
                    ->get();
        }
        return Inertia::render('McqPage', ['subjectName' => $subjectName, 'questionsAndAnswers' => $questionsAndAnswer, "subjectColor" => $subjectColor]);
    }

    public function store(StoreMcqRequest $request)
    {

        $formData = $request->validated();


        $subject = Subject::create([
            'name' => $formData["name"],
            'color' => $formData["color"]
        ]);



        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Answer;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMcqRequest;

class McqController extends Controller
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

        //dd($request->validated());
        $formData = $request->validated();

        $errorsTab = [];

        foreach($formData["questionTab"] as $key => $question){
            $atLeastOneChecked = false;
            foreach($question["answers"] as $answer){
                if ($answer["isCorrect"]){
                    $atLeastOneChecked = true;
                }
            }
            if (!$atLeastOneChecked){
                $errorsTab['question_' . $key] = ['At least one answer should be checked'];
            }
        }
        //dd($errorsTab);
        $error = ValidationException::withMessages($errorsTab);
        if (!empty($errorsTab)){
            throw $error;
        }
        
        $subject = Subject::create([
            'name' => $formData["name"],
            'color' => $formData["color"]
        ]);

        $subjectId = $subject->toArray()["id"];

        foreach($formData["questionTab"] as $key => $question){
            $questionCreated = Question::create([
                'subject_id' => $subjectId,
                'text' => $question["text"]
            ]);
            $questionId = $questionCreated->toArray()["id"];

            foreach($question["answers"] as $answer){
                Answer::create([
                    'question_id' => $questionId,
                    'text' => $answer["text"],
                    'is_correct' => $answer["isCorrect"]
                ]);
            }
        }

        return redirect()->route('home');
    }
}

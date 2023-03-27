<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Answer;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMcqRequest;
use Illuminate\Validation\ValidationException;

class McqController extends Controller
{
    public function show(Request $request, String $subjectId)
    {
        if (Auth::check()) {
            $subjectName = DB::table('subjects')->where('id', $subjectId)->value('name');
            $subjectColor = DB::table('subjects')->where('id', $subjectId)->value('color');
            $questionsRows = DB::table('questions')->where('subject_id', $subjectId)->get();
            $userRate = DB::table('difficulty_scores')->where('subject_id', $subjectId)
                        ->where('user_id', Auth::id())->value('score');
            //dd($questionsRows[0]->text);
            $questionsAndAnswer = [];
            foreach($questionsRows as $question){
                $questionsAndAnswer[$question->text] = 
                    DB::table('answers')
                        ->select('id', 'text', 'is_correct', 'is_checked')
                        ->where('question_id', $question->id)
                        ->get();
            }
            return Inertia::render('McqPage', [
                'subjectId' => $subjectId,
                'subjectName' => $subjectName, 
                'questionsAndAnswers' => $questionsAndAnswer, 
                'subjectColor' => $subjectColor,
                'userRate' => $userRate
            ]);
        }
        else {
            return Inertia::render('McqPage');
        }
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
            'color' => $formData["color"],
            'user_id' => Auth::id()
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

        return redirect()->route('discover');
    }
}

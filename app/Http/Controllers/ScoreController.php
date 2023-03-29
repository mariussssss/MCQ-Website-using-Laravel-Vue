<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Score;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScoreController extends Controller
{
    public function store(Request $request)
    {

        Score::create($request->all());

        //return redirect()->route('mcqpage', ['subjectId' => $data['subjectId'], 'data' => $data ]);

        /* return Inertia::render('McqPage', [
            'subjectId' => $data['subjectId'],
            'subjectName' => $data['subjectName'],
            'questionsAndAnswers' => $data['questionsAndAnswers'],
            'subjectColor' => $data['subjectColor'],
            'userRate' => $data['userRate']
        ]); */
    }
}

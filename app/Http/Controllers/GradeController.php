<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DifficultyScore;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function store(Request $request)
    {
        $formData = $request->all();
        //dd($formData["grade"]);
        DifficultyScore::create([
            'subject_id' => $formData["subjectId"],
            'user_id' => Auth::id(),
            'score' => $formData["grade"],
        ]);

        return redirect()->route('mcqpage', $formData["subjectId"]);
    }
}

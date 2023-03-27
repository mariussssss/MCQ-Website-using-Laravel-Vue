<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DiscoverController extends Controller
{
    public function show(Request $request)
    {
        if (Auth::check()) {
            $subjects = DB::table('subjects')
                        ->join('users', 'subjects.user_id', '=', 'users.id')
                        ->select('subjects.id', 'subjects.name', 'subjects.color', 'users.name as user_name')
                        ->paginate(5); //->get() if i don't want to paginate
            
            foreach($subjects as $subject){
                $subject->rate = 
                    DB::table('difficulty_scores')
                        ->where('subject_id', $subject->id)
                        ->avg('score');
            }

            //dd($subjects);
            
            return Inertia::render('Discover', ['subjects' => $subjects]);
        }
        else{
            return Inertia::render('Discover');
        }
    }
}

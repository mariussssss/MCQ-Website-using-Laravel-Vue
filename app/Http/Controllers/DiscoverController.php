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
                        ->when($request->all(), function ($query, $searchIdOrName){
                            //dd($searchIdOrName);
                            //array_key_exists
                            if(array_key_exists('searchById', $searchIdOrName) and $searchIdOrName['searchById'] != ''){
                                $query->where('subjects.id', 'like', $searchIdOrName['searchById'] );
                            }
                            else if (array_key_exists('searchByName', $searchIdOrName)){
                                $query->where('subjects.name', 'like', '%' . $searchIdOrName['searchByName'] . '%');
                            }                           
                        })
                        
                        ->join('users', 'subjects.user_id', '=', 'users.id')
                        ->select('subjects.id', 'subjects.name', 'subjects.color', 'users.name as user_name')
                        ->paginate(15)
                        ->withQueryString(); //->get() if i don't want to paginate
            
                        /* ->when($request->string('searchById'), function ($query, $id){
                            $query->where('subjects.id', 'like', $id );
                        }) */

            foreach($subjects as $subject){
                $subject->rate = 
                    DB::table('difficulty_scores')
                        ->where('subject_id', $subject->id)
                        ->avg('score');
            }

            //dd($subjects);
            
            return Inertia::render('Discover', ['subjects' => $subjects, 'filters' => [
                'searchByName' => $request->query('searchByName'),
                'searchById' => $request->query('searchById')
                ]]);
        }
        else{
            return Inertia::render('Discover');
        }
    }
}

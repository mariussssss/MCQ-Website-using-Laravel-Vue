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
            $subjects = DB::table('subjects')->select('id', 'name', 'color')->get();
            return Inertia::render('Discover', ['subjects' => $subjects]);
        }
        else{
            return Inertia::render('Discover');
        }
    }
}

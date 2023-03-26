<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function show(Request $request)
    {
        $subjects = DB::table('principal_subjects')->select('id', 'name', 'color')->get();
        return Inertia::render('Dashboard', ['subjects' => $subjects]);
    }
}

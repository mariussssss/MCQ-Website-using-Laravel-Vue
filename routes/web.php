<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\McqController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiscoverController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrincipalMcqController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* Route::get('/', function () {
    return redirect()->route('home');
}); */

Route::redirect('/', '/home');
/* Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

Route::get('/home', [DashboardController::class, 'show'])
->name('home');

Route::get('/mcq-page/{subjectId}', [PrincipalMcqController::class, 'show'])
->name('mcqhomepage');

Route::get('/discover/mcq-page/{subjectId}', [McqController::class, 'show'])
->middleware(['auth', 'verified'])
->name('mcqpage');

Route::post('/discover/post-grade', [GradeController::class, 'store'])
->middleware(['auth', 'verified'])
->name('grade.store');

Route::post('/discover/post-score', [ScoreController::class, 'store'])
->middleware(['auth', 'verified'])
->name('score.store');

Route::get('/discover',[DiscoverController::class,'show'])
->name('discover');

Route::get('/your-mcqs', function () {
    return Inertia::render('YourMCQs');
})
->middleware(['auth', 'verified'])
->name('yourmcqs');

Route::get('/your-results', function () {
    return Inertia::render('YourResults');
})
->middleware(['auth', 'verified'])
->name('yourresults');

Route::get('/mcq-creation-page', function () {
    return Inertia::render('McqCreationPage');
})
->name('mcqcreationpage');

Route::post('/mcq-creation-page', [McqController::class, 'store'])
->middleware(['auth', 'verified'])->name('mcqcreationpage.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

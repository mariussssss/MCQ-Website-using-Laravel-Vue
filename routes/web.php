<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DashboardController;

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

Route::get('/mcq-page/{subjectId}', [SubjectController::class, 'show'])
->middleware(['auth', 'verified'])
->name('mcqpage');

Route::get('/mcq-creation-page', function () {
    return Inertia::render('McqCreationPage');
})
->middleware(['auth', 'verified'])
->name('mcqcreationpage');

Route::post('/mcq-creation-page', [SubjectController::class, 'store'])
->middleware(['auth', 'verified'])->name('mcqcreationpage.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//====================================================================
/*
    Route::get('/notes', );         //Display all notes
    Route::get('/notes/{id}', );    // display Single note
    Rout::get('/notes/create', );   // display form
    Route::post('/note', );         // Submit/Add a note
    Route::post('/note/edit/{id}', );  // Display Edit Form for a note
    Route::post('/note/updaete/{id}', );     //  Updated a note
    Route::post('/note/delete/{id}',    );   // Delete a Note.....
*/

//Route::get('/user/{id}', [UserController::class, 'show']);

Route::resource('/notes', App\Http\Controllers\NoteController::class)->middleware(['auth']);
//Route::resource('/notes', App\Http\Controllers\NoteController::class)->middleware(['auth']);





require __DIR__.'/auth.php';

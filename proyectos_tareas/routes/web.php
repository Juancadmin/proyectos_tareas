<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::resource('projects.tasks', TaskController::class);


Route::middleware(['auth'])->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::resource('projects.tasks', TaskController::class);
});
 
});




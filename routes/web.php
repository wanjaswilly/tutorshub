<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TutorsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['tutor', 'auth'])->prefix('tutors')->group(function () {
    Route::get('/profile', [App\Http\Controllers\TutorsController::class, 'profile'])->name('tutors.profile');
});

Route::middleware(['admin', 'auth'])->prefix('student')->group(function () {
    Route::get('/profile', [App\Http\Controllers\StudentController::class, 'profile'])->name('student.profile');
});

Route::middleware([])->prefix('admin')->group(function () {
    Route::get('profile', [App\Http\Controllers\AdminController::class, 'profile'])->name('admin.profile');
});

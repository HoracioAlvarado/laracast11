<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get("test", function () {
    $job = Job::first();

    TranslateJob::dispatch($job);

    return 'Done';
});

Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');

Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create')
    ->middleware('auth');

Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store')
    ->middleware('auth');

Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit')
    ->middleware('auth')
    ->can('edit', 'job');

Route::patch('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update')
    ->middleware('auth')
    ->can('edit', 'job');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy')
    ->middleware('auth')
    ->can('edit', 'job');

Route::get('/register', [RegisterUserController::class, 'create']);
Route::post('/register', [RegisterUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

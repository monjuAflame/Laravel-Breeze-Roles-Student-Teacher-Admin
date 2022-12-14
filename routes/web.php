<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student;
use App\Http\Controllers\Teacher;
use App\Http\Controllers\Admin;

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

Route::middleware(['auth', 'verified'])->group(function() {
    Route::middleware('role:1')
        ->prefix('student')
        ->name('student.')
        ->group(function () {
            Route::get('timetable', [Student\TimetableController::class, 'index'])
                ->name('timetable');
        });

    Route::middleware('role:2')
        ->prefix('teacher')
        ->name('teacher.')
        ->group(function () {
            Route::get('timetable', [Teacher\TimetableController::class, 'index'])
                ->name('timetable');
        });

    Route::middleware('role:3')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('users', [Admin\UsersController::class, 'index'])
                ->name('users');
        });
});


require __DIR__.'/auth.php';

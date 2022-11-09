<?php

use App\Http\Controllers\AplicationController;
use App\Http\Controllers\MainController;
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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [MainController::class, 'main'])->name('main');
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');

//    Route::get('applications/{application}/answer', [AnswerController::class, 'create'])->name('answers.create');
//    Route::post('applications/{application}/answer', [AnswerController::class, 'store'])->name('answers.store');

    Route::resource('applications', AplicationController::class);
});

require __DIR__.'/auth.php';

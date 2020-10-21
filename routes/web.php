<?php

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['guest']], function () {
    // Authorisation routes
    Route::get('register', [\App\Http\Controllers\Auth\RegistrationController::class, 'index'])->name('register');
    Route::post('register', [\App\Http\Controllers\Auth\RegistrationController::class, 'create']);
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
    Route::get('login/{provider}', [\App\Http\Controllers\Auth\SocialController::class, 'redirectToProvider']);
    Route::get('login/{provider}/callback', [\App\Http\Controllers\Auth\SocialController::class, 'handleProviderCallback']);
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    Route::post('tasks', [\App\Http\Controllers\TaskController::class, 'create']);

    Route::get('tasks/{task}', [\App\Http\Controllers\TaskController::class, 'show'])
        ->middleware('can:show,task');

    Route::put('tasks/{task}', [\App\Http\Controllers\TaskController::class, 'update'])
        ->middleware('can:update,task');

    Route::post('tasks/{task}/done', [\App\Http\Controllers\TaskController::class, 'done'])
        ->middleware('can:update,task');

    Route::delete('tasks/{task}', [\App\Http\Controllers\TaskController::class, 'delete'])
        ->middleware('can:delete,task');
});

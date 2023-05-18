<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest')->name('welcome');

Route::controller(LoginController::class)->group(function () {
    Route::post('login','login')->name('login');
    Route::post('logout','logout')->name('logout');
});

Route::middleware('auth')->group(function () {
    // middleware por roles
    Route::middleware('role:admin|usernormal')->group(function () {
        Route::get('/redirect1', function () { return view('web.redirect.redirect1'); })->name('redirect1');
    });
    Route::middleware('role:admin')->group(function () {
        Route::get('/redirect2', function () { return view('web.redirect.redirect2'); })->name('redirect2');
    });
    
    // middleware por permisos
    // Route::middleware('permission:redirect1')->group(function () {
    //     Route::get('/redirect1', function () { return view('web.redirect.redirect1'); })->name('redirect1');
    // });
    // Route::middleware('permission:redirect2')->group(function () {
    //     Route::get('/redirect2', function () { return view('web.redirect.redirect2'); })->name('redirect2');
    // });

    // permisos directos en las rutas
    // Route::get('/redirect1', function () { return view('web.redirect.redirect1'); })->name('redirect1')->permission('redirect1');
    // Route::get('/redirect2', function () { return view('web.redirect.redirect2'); })->name('redirect2')->permission('redirect2');
});


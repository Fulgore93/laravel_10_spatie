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
    Route::get('/redirect1', function () { return view('web.redirect.redirect1'); })->name('redirect1');
    Route::get('/redirect2', function () { return view('web.redirect.redirect2'); })->name('redirect2');
});


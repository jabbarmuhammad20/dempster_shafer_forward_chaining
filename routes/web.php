<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

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
    return view('login');
})->name('page.login');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('register', function () {
    return view('register');
})->name('page.register');
Route::post('register', [AuthController::class, 'register'])->name('register');

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', [HomeController::class, 'adminHome'])->name('home');
    Route::get('/daftar', [AdminController::class, 'daftar'])->name('daftar');
    Route::get('/gejala', [AdminController::class, 'gejala'])->name('gejala');
    Route::post('/storeGejala', [AdminController::class, 'storeGejala'])->name('storeGejala');

    //Penyakit
    Route::controller(PenyakitController::class)->prefix('penyakit')->name('penyakit.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });

    //Gejala
    Route::controller(GejalaController::class)->prefix('gejala')->name('gejala.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });
});

/*------------------------------------------
--------------------------------------------
All Manager Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

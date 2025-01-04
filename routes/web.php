<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth')->prefix('home')->name('home.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::middleware('user-access:admin')->group(function () {
        Route::controller(UserController::class)->prefix('pasien')->name('pasien.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/detail/{id}', 'detail')->name('detail');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::controller(PenyakitController::class)->prefix('penyakit')->name('penyakit.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/detail/{id}', 'detail')->name('detail');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        Route::controller(GejalaController::class)->prefix('gejala')->name('gejala.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/detail/{id}', 'detail')->name('detail');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });
    });

    Route::middleware('user-access:user')->group(function () {
        Route::controller(UserController::class)->prefix('biodata')->name('biodata.')->group(function () {
            Route::get('/{id}', 'bio')->name('index');
            Route::put('/update/{id}', 'updateBio')->name('update');
        });
        Route::controller(KuisionerController::class)->prefix('kuisioner')->name('kuisioner.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/store', 'store')->name('store');
        });
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

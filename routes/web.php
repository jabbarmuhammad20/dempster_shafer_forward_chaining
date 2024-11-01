<?php

  

use Illuminate\Support\Facades\Route;

  

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Pasien;

  

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
    return view('login1');
});

Route::get('/register1', function () {
    return view('register');
});

  

Auth::routes();

  

/*------------------------------------------

--------------------------------------------

All Normal Users Routes List

--------------------------------------------

--------------------------------------------*/
Route::post('daftarpasien', [PasienController::class, 'store'])->name('daftarpasien');
Route::get('logout', [LoginController::class,'logout']);  

Route::middleware(['auth', 'user-access:user'])->group(function () {

  

    Route::get('/home', [HomeController::class, 'index'])->name('home');

});

  

/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:admin'])->group(function () {

  

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/daftar', [AdminController::class, 'daftar'])->name('admin.daftar');
    Route::get('/admin/gejala', [AdminController::class, 'gejala'])->name('admin.gejala');
    Route::post('/admin/storeGejala', [AdminController::class, 'storeGejala'])->name('admin.storeGejala');
    Route::get('/admin/penyakit', [AdminController::class, 'penyakit'])->name('admin.penyakit');
    Route::post('/admin/storePenyakit', [AdminController::class, 'storePenyakit'])->name('admin.storePenyakit');
    Route::put('/admin/updatePenyakit{id}', [AdminController::class, 'updatePenyakit'])->name('admin.updatePenyakit');
    Route::get('/admin/detailPenyakit{id}', [AdminController::class, 'detailPenyakit'])->name('admin.detailPenyakit');

});

  

/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:manager'])->group(function () {

  

    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');

});
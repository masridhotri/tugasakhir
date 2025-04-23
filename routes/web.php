<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenimutasiController;





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
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'indexe'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    route::get('user',[UserController::class, 'user'])->name('user.index');
    route::post('/user/updatedata',[UserController::class, 'updatedata'])->name('updatedata');

    Route::get('/indexe', [DashboardController::class, 'indexe'])->name('indexe');



    route::get('jenis', [JenimutasiController::class, 'index'])->name('jenis.index');
    route::post('/jenis/store', [JenimutasiController::class, 'store'])->name('jenis.store');
    route::post('/jenis/edit/{id}',[JenimutasiController::class, 'edit'])->name('jenis.edit');
    Route::post('/jenis/destroy/{id}', [JenimutasiController::class, 'destroy'])->name('jenis.destroy');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    route::get('tabungan',[TabunganController::class, 'index'])->name('tabungan.index');
    route::post('/tabungan/new',[TabunganController::class, 'new'])->name('tabung.new');
    route::post('/tabungan/update/{id}',[TabunganController::class, 'update'])->name('tabung.update');
    route::post('/tabungan/sampai/{id}',[TabunganController::class, 'sampai'])->name('tabung.sampai');
    route::post('/tabungan/input/{id}',[TabunganController::class, 'input'])->name('tabung.input');

    Route::post('/tabungan/store/{id}', [TabunganController::class, 'store'])->name('tabung.store');






    route::get('first',[TestingController::class, 'first'])->name('satu');
    route::get('seccond',[TestingController::class, 'seccond'])->name('dua');
    route::get('tiga',[TestingController::class, 'tiga'])->name('tiga');
    route::get('empat',[TestingController::class, 'empat'])->name('four');
    route::get('lima',[TestingController::class, 'lima'])->name('lima');
    route::get('enam',[TestingController::class, 'enam'])->name('enam');
    route::get('tujuh',[TestingController::class, 'tujuh'])->name('tujuh');
});

require __DIR__.'/auth.php';

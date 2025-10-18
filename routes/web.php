<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenimutasiController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\Auth\RegisteredUserController;



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
    return view('selamat');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboardadmin', [DashboardController::class, 'admin'])->name('dashboard.admin');
});

Route::middleware(['auth', 'operator'])->group(function () {
    Route::get('/dashboard/operator', [OperatorController::class, 'operator'])->name('dashboard.operator');

    Route::get('/tabungan', [TabunganController::class, 'index'])->name('tabungan.index');
    Route::post('/tabungan/new', [TabunganController::class, 'new'])->name('tabung.new');
    Route::post('/tabungan/update/{id}', [TabunganController::class, 'update'])->name('tabung.update');
    Route::post('/tabungan/sampai/{id}', [TabunganController::class, 'sampai'])->name('tabung.sampai');
    Route::post('/tabungan/input/{id}', [TabunganController::class, 'input'])->name('tabung.input');
    Route::post('/tabungan/store/{id}', [TabunganController::class, 'store'])->name('tabung.store');

    Route::get('/enam', [OperatorController::class, 'enam'])->name('operator.enam');
});
Route::get('/dashboard', [DashboardController::class, 'indexe'])
    ->middleware(['auth', 'verified', 'role:user'])
    ->name('dashboard');

Route::middleware('auth')->group(function () { 

    route::get('user',[UserController::class, 'user'])->name('user.index');
    route::post('/user/updatedata',[UserController::class, 'updatedata'])->name('updatedata');

    Route::get('/indexe', [DashboardController::class, 'indexe'])->name('indexe');
    Route::get('/detailjemput/{id}', [DashboardController::class, 'detailjemput'])->name('detailjemput');

    Route::get('indexuser', [NasabahController::class, 'indexuser'])->name('user');
    Route::get('saldouser', [NasabahController::class, 'saldouser'])->name('saldouser');
    Route::post('/tarik-saldo', [NasabahController::class, 'tarik'])->name('saldo');

    route::get('jenis', [JenimutasiController::class, 'index'])->name('jenis.index');
    route::post('/jenis/store', [JenimutasiController::class, 'store'])->name('jenis.store');
    route::post('/jenis/edit/{id}',[JenimutasiController::class, 'edit'])->name('jenis.edit');
    Route::post('/jenis/destroy/{id}', [JenimutasiController::class, 'destroy'])->name('jenis.destroy');

    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');


    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    route::get('enam',[OperatorController::class, 'enam'])->name('enam');


    route::get('tabungan',[TabunganController::class, 'index'])->name('tabungan.index');
    route::post('/tabungan/new',[TabunganController::class, 'new'])->name('tabung.new');
   

    route::get('first',[TestingController::class, 'first'])->name('satu');
    route::get('seccond',[TestingController::class, 'seccond'])->name('dua');
    route::get('tiga',[TestingController::class, 'tiga'])->name('tiga');
    route::get('empat',[TestingController::class, 'empat'])->name('four');
    // route::get('lima',[TestingController::class, 'lima'])->name('lima');
    route::get('tujuh',[TestingController::class, 'tujuh'])->name('tujuh');
});
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

require __DIR__.'/auth.php';

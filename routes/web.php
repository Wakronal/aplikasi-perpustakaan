<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AuthManualController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){
    Route::resource('anggotas', AnggotaController::class);
    Route::resource('bukus', BukuController::class);
    Route::resource('peminjamen', PeminjamanController::class);
    Route::post('/peminjamen/{id}/return', [PeminjamanController::class, 'returnBook'])->name('peminjamen.return');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/anggotas', [AnggotaController::class, 'index'])->name('anggotas.index');
    Route::get('/bukus', [BukuController::class, 'index'])->name('bukus.index');
    Route::get('/peminjamen', [PeminjamanController::class, 'index'])->name('peminjamen.index');
});

Route::get('/login', [AuthManualController::class, 'index'])->name('login');
Route::post('/login', [AuthManualController::class, 'loginProses'])->name('loginProses');
Route::post('/logout', [AuthManualController::class, 'logout'])->name('logout');



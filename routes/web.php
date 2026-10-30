<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\JenisLayananController;
Route::inertia('/', 'Auth/Login');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/layananaktif', [OrderController::class, 'getAktif'])->name('layananAktif');
    Route::get('/layanantunda', [OrderController::class, 'getTunda'])->name('layananTunda');
    Route::get('/layananselesai', [OrderController::class, 'getSelesai'])->name('layananSelesai');
    Route::get('/layanansisimahasiswa', [OrderController::class, 'getOrderanMahasiswa'])->name('layananSisiMahasiswa');
});

Route::get('/order/getjmlo', [OrderController::class, 'getJmlO']);
Route::get('/order/simpanorderan', [OrderController::class, 'simpanOrderan']);
Route::get('/order/editorderan', [OrderController::class, 'editOrderan']);
Route::get('/jenislayanan/getjenislayanan', [JenisLayananController::class, 'getJenisLayanan']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

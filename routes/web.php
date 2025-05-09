<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [MahasiswaController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/dashboard', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/dashboard/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/dashboard/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/dashboard/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

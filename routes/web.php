<?php

use App\Http\Controllers\MotoristasController;
use App\Http\Controllers\ViagensController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VeiculosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/motoristas', MotoristasController::class);

Route::resource('viagens', ViagensController::class);

Route::resource('/veiculos', VeiculosController::class);

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

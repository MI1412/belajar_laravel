<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailCheckController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;

// rute controller image
Route::post('/images', [ImageController::class, 'store'])->name('images.store');

// rute halaman add produk
Route::get('/add', function (){
    return view('add');
})->middleware(['auth', 'verified'])->name('add');

// rute url ke dashboard tetapi arahkan lagi ke verified jika sudah login atau register
// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// rute profile controller
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// rute ke image controller mengakses function index, create, edit, destroy

// masuk ke dashboard dan memakai function index
Route::get('/', [ImageController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard'); // mengarahkan nama file dashboard.blade.php
Route::get('/update/{id}/edit', [ImageController::class, 'edit'])->middleware(['auth', 'verified'])->name('images.edit');
Route::put('/update/{id}', [ImageController::class, 'update'])->middleware(['auth', 'verified'])->name('images.update');
// mengarahkan ke halaman images dengan function edit
Route::delete('/images/{image}', [ImageController::class, 'destroy'])->middleware(['auth', 'verified'])->name('images.destroy');// mengarahkan ke halaman images dengan function destroy



// rute check email
Route::get('/check-email/{email}', [EmailCheckController::class, 'check'])
    ->name('check.email');



require __DIR__.'/auth.php';

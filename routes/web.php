<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailCheckController;

// jangan dibuka
// Route::get('/', function () {
//     return view('welcome');
// });

// rute url ke dashboard tetapi arahkan lagi ke verified jika sudah login atau register
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// rute url ke cek 1
// Route::get('/cek1', function(){
//     return '<h1>cek 1</h1>';
// })->middleware(['auth', 'verified']);


Route::get('/check-email/{email}', [EmailCheckController::class, 'check'])
    ->name('check.email');



require __DIR__.'/auth.php';

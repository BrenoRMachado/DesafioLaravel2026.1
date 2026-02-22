<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdutoController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', [ProdutoController::class, 'index'])
    ->middleware(['auth']) 
    ->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboardAdmin', function () {
    return view('dashboardAdmin');
})->middleware(AdminMiddleware::class)->name('dashboardAdmin');

Route::get('/users', [UserController::class, 'index'])->middleware(AdminMiddleware::class)->name('users');
Route::post('/users', [UserController::class, 'store'])->middleware(AdminMiddleware::class)->name('users.store');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware(AdminMiddleware::class)->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware(AdminMiddleware::class)->name('users.destroy');

Route::get('/admins', [AdminController::class, 'index'])->middleware(AdminMiddleware::class)->name('admins');
Route::post('/admins', [AdminController::class, 'store'])->middleware(AdminMiddleware::class)->name('admins.store');
Route::put('/admins/{admin}', [AdminController::class, 'update'])->middleware(AdminMiddleware::class)->name('admins.update');
Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->middleware(AdminMiddleware::class)->name('admins.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

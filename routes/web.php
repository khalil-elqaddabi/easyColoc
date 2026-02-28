<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\ColocationController;

Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');
Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [HomeController::class, 'dashboard'])
            ->name('dashboard');

            
            Route::get('users/trashed', [UserController::class, 'trashed'])
            ->name('users.trashed');
            
            Route::patch('users/{id}/restore', [UserController::class, 'restore'])
            ->name('users.restore');
            
            Route::delete('users/{id}/force', [UserController::class, 'forceDestroy'])
            ->name('users.forceDestroy');
            Route::resource('users', UserController::class);
    });
    Route::resource('colocations', ColocationController::class)
    ->middleware('auth');


Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        return view('user.home');
    })->name('user.home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

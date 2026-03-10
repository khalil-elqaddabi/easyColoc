<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PaymentController;

Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');
Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Colocation
    Route::prefix('colocations')->name('colocations.')->group(function () {
        // Listing (Member or Owner)
        Route::get('/', [ColocationController::class, 'index'])->name('index');

        // Create (without role or admin)
        Route::get('/create', [ColocationController::class, 'create'])->name('create');
        Route::post('/', [ColocationController::class, 'store'])->name('store');

        // Show (Member or Owner)
        Route::get('/{colocation}', [ColocationController::class, 'show'])->name('show');

        // Edit (Owner‑only)
        Route::get('/{colocation}/edit', [ColocationController::class, 'edit'])->name('edit');
        Route::put('/{colocation}', [ColocationController::class, 'update'])->name('update');

        // Delete (Owner‑only)
        Route::delete('/{colocation}', [ColocationController::class, 'destroy'])->name('destroy');

        // Cancel (Owner‑only)
        Route::post('/{colocation}/cancel', [ColocationController::class, 'cancel'])->name('cancel');

        // quit (Member‑only)
        Route::post('/{colocation}/quit', [ColocationController::class, 'quit'])->name('quit');

        // remove a member (Owner‑only)
        Route::post('/{colocation}/members/{member}/remove', [ColocationController::class, 'removeMember'])->name('members.remove');

        // Categories
        Route::prefix('{colocation}/categories')->middleware('manage.categories')->name('categories.')->group(function () {
            // List all categories for colocation
            Route::get('/', [CategoryController::class, 'index'])->name('index')->withoutMiddleware('manage.categories');

            // Create form
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            // Store new category
            Route::post('/', [CategoryController::class, 'store'])->name('store');

            // Edit form
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
            // Update category
            Route::put('/{category}', [CategoryController::class, 'update'])->name('update');

            // Soft delete category (hard deletes expenses)
            Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');

            // Expenses (Member access)
            Route::prefix('{category}/expenses')->middleware('colocation.member')->withoutMiddleware('manage.categories')->name('expenses.')->group(function () {
                // List expenses for category
                Route::get('/', [ExpenseController::class, 'index'])->name('index');

                // Create form
                Route::get('/create', [ExpenseController::class, 'create'])->name('create');
                // Store new expense
                Route::post('/', [ExpenseController::class, 'store'])->name('store');

                // Show single expense
                Route::get('/{expense}', [ExpenseController::class, 'show'])->name('show');

                // Edit form
                Route::get('/{expense}/edit', [ExpenseController::class, 'edit'])->name('edit');
                // Update expense
                Route::put('/{expense}', [ExpenseController::class, 'update'])->name('update');

                // Delete expense
                Route::delete('/{expense}', [ExpenseController::class, 'destroy'])->name('destroy');

                // Payment markAsPaid
                Route::patch('{expense}/payments/{payment}/paid', [PaymentController::class, 'markPaid'])
    ->name('payments.mark-paid');
            });
        });

        // Invitations
        Route::prefix('{colocation}/invitations')->name('invitations.')->group(function () {
            Route::get('/', [InvitationController::class, 'index'])->name('index');
            Route::post('/', [InvitationController::class, 'invite'])->name('invite');
        });
    });

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [ColocationController::class, 'index'])
            ->name('dashboard');


            Route::get('users/trashed', [UserController::class, 'trashed'])
            ->name('users.trashed');

            Route::patch('users/{id}/restore', [UserController::class, 'restore'])
            ->name('users.restore');

            Route::delete('users/{id}/force', [UserController::class, 'forceDestroy'])
            ->name('users.forceDestroy');
            Route::resource('users', UserController::class);
    });



    Route::middleware('auth')->group(function () {

        Route::get('/home', [ColocationController::class, 'index'])->name('user.home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

Route::middleware(['guest'])->group(function () {
    Route::get('invitations/{invitation}/accept', [InvitationController::class, 'accept'])
        ->name('invitations.accept');
});

Route::middleware(['auth'])->prefix('invitations/{invitation}')->name('invitations.')->group(function () {
    Route::post('process', [InvitationController::class, 'process'])->name('process');
});

require __DIR__ . '/auth.php';

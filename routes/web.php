<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeAdminController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProfileController;
use App\Models\TempUser;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// All authenticated routes are now grouped in this single block.
Route::middleware(['auth2', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.commandes.index');
        }

        if ($user->hasRole('client')) {
            return redirect()->route('dashboard.client');
        }
    })->name('dashboard');

    Route::get('/dashboard/client', [ClientController::class, 'index'])->name('dashboard.client');

    Route::get('/dashboard/admin', [AdminController::class, 'index'])->middleware('admin')->name('dashboard.admin');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/commandes', [CommandeAdminController::class, 'index'])->middleware('admin')->name('commandes.index');
        Route::post('/commandes', [CommandeAdminController::class, 'store'])->middleware('admin')->name('commandes.store');
        Route::post('/commandes/{id}/markDone', [CommandeAdminController::class, 'markDone'])->middleware('admin')->name('commandes.markDone');
        Route::post('/commandes/{id}/cancel', [CommandeAdminController::class, 'cancel'])->middleware('admin')->name('commandes.cancel');
        Route::delete('/commandes/{id}', [CommandeAdminController::class, 'destroy'])->middleware('admin')->name('commandes.destroy');

        Route::post('/commandes/{id}/updateNote', [CommandeAdminController::class, 'updateNote'])->middleware('admin')->name('commandes.updateNote');
        Route::post('/commandes/{id}/updatePrice', [CommandeAdminController::class, 'updatePrice'])->middleware('admin')->name('commandes.updatePrice');
    });
});
Route::middleware(['web'])->group(function () {
    Route::get('/', [CommandeController::class, 'index'])->name('home.index');
    Route::post('/home/commandes', [CommandeController::class, 'store'])->name('home.store');
});

require __DIR__ . '/auth.php';

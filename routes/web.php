<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeAdminController;
use App\Http\Controllers\CommandeController;
use App\Models\TempUser;




// All authenticated routes are now grouped in this single block.
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard.admin');
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


});
Route::middleware(['tempUserSession'])->group(function () {

  /*  Route::get('/temp-user-info', function () {
        $tempUserId = session('temp_user_id');
        $tempUser = \App\Models\User::find($tempUserId);

        if (!$tempUser) {
            return response()->json(['error' => 'Temp user not found'], 404);
        }

        return response()->json([
            'id' => $tempUser->id,
            'name' => $tempUser->name,
            'email' => $tempUser->email,
        ]);
    });
*/
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });

});

Route::get('/test', [CommandeController::class, 'index'])->name('test.index');
Route::post('/test', [CommandeController::class, 'store'])->name('test.store');


Route::get('/commandes', [CommandeAdminController::class, 'index'])->name('commandes.index');
Route::post('/commandes', [CommandeAdminController::class, 'store'])->name('commandes.store');
Route::post('/commandes/{id}/markDone', [CommandeAdminController::class, 'markDone'])->name('commandes.markDone');
Route::post('/commandes/{id}/cancel', [CommandeAdminController::class, 'cancel'])->name('commandes.cancel');
Route::delete('/commandes/{id}', [CommandeAdminController::class, 'destroy'])->name('commandes.destroy');

Route::post('/commandes/{id}/updateNote', [CommandeAdminController::class, 'updateNote'])->name('commandes.updateNote');
Route::post('/commandes/{id}/updatePrice', [CommandeAdminController::class, 'updatePrice'])->name('commandes.updatePrice');




require __DIR__.'/auth.php';

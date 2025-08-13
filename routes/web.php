<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
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




require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::post('/clients', [ClientController::class, 'store']);

  Route::delete('/clients/{id}',[ClientController::class,'destroy']);
  

 Route::get('/clients',[ClientController::class,'index']);
 Route::put('/clients/{id}',[ClientController::class,'update']);

 // Route::apiResource('clients',ClientController::class);


<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
Route::get('/', function () {
    return view('welcome');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/veiculos/novo',[VehicleController::class,'create']);
    Route::post('/veiculos/novo/criar',[VehicleController::class,'store']);
    Route::get('/veiculos/show/{id}',[VehicleController::class,'show']);
    Route::delete('/veiculos/delete/{id}',[VehicleController::class,'destroy']);
    Route::put('/veiculos/update/{id}',[VehicleController::class,'update']);
    Route::get('/veiculos/edit/{id}',[VehicleController::class,'edit']);
    Route::get('/veiculos/dashboard',[VehicleController::class,'dashboard']);

});

require __DIR__.'/auth.php';

<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});


// Rota para o dashboard, que agora usa o DashboardController para exibir os usuários
Route::get('/dashboard', [DashboardController::class, 'dashboardAdministrator'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rota para validar o usuário
Route::post('/user/{id}/validate', [DashboardController::class, 'validateUser'])
    ->middleware(['auth', 'verified'])
    ->name('user.validate');

Route::post('/user/{id}/document', [DashboardController::class, 'documentUser'])
    ->middleware(['auth', 'verified'])
    ->name('user.document');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/user/{id}/destroy', [ProfileController::class, 'destroyAdm'])->name('user.destroy');
    Route::get('/veiculos/novo',[VehicleController::class,'create']);
    Route::post('/veiculos/novo/criar',[VehicleController::class,'store']);
    Route::get('/veiculos/show/{id}',[VehicleController::class,'show']);
    Route::delete('/veiculos/delete/{id}',[VehicleController::class,'destroy']);
    Route::put('/veiculos/update/{id}',[VehicleController::class,'update']);
    Route::get('/veiculos/edit/{id}',[VehicleController::class,'edit']);
    Route::get('/dashboard/user',[DashboardController::class,'dashboardUser'])->name('dashboard.user');

});

require __DIR__.'/auth.php';

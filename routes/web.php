<?php

use App\Http\Controllers\EquipmentAllocationController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('/users' , UserController::class);
    Route::resource('/equipments' , EquipmentController::class);

    Route::get('/allocations' , [EquipmentAllocationController::class , 'index'])->name('allocations.index');
    Route::post('/allocations' , [EquipmentAllocationController::class , 'assignEquipment'])->name('allocations.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';

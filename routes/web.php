<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    /* DASHBOARD */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* PROFILE */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    /* PROPERTY */
    Route::resource('properties', PropertyController::class);
    Route::post('/properties/store', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::patch('/properties/{property}/update', [PropertyController::class, 'update'])->name('properties.update');
    
    /* CONTRACT */
    Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create');
    Route::get('/contracts/store', [ContractController::class, 'store'])->name('contracts.store');
    Route::get('/contracts/{contract}/edit', [ContractController::class, 'edit'])->name('contracts.edit');
    Route::patch('/contracts/{contract}/update', [ContractController::class, 'update'])->name('contracts.update');
    Route::post('/contracts/{contract}/delete', [ContractController::class, 'delete'])->name('contracts.delete');
});


require __DIR__.'/auth.php';

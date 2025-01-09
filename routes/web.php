<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Fire\CommandController;
use App\Http\Controllers\FireController;
use Illuminate\Support\Facades\Route;

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

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    });

    // Fire Department Routes
    Route::prefix('fire')->name('fire.')->group(function () {
        Route::get('/command', [CommandController::class, 'index'])->name('command.index');
        Route::get('/command/{fire}', [CommandController::class, 'show'])->name('command.show');
    });

});

require __DIR__.'/auth.php';

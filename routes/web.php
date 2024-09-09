<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ic\Calls;
use App\Http\Controllers\ic\Command;
use App\Http\Controllers\ic\UnitPositionController;

use Illuminate\Http\Request;
Route::get('/', function () {
	return redirect('/ic/calls');
});

Route::get('/ic/calls', [Calls::class, 'index'])->name('ic-calls');
Route::get('/ic/{call_id}', [Command::class, 'index'])->name('ic-command');
Route::get('/columns/{call_id}', [Command::class, 'getColumns']);
Route::post('/columns/save', [Command::class, 'saveColumns']);
Route::post('/unit-positions/update', [UnitPositionController::class, 'update']);
Route::post('/unit-positions/initialize', [UnitPositionController::class, 'initializePositions']);
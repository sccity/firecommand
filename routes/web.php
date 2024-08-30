<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FireCommand\Calls;
use App\Http\Controllers\FireCommand\Command;

use Illuminate\Http\Request;
Route::get('/', function () {
	return redirect('/FireCommand/calls');
});

Route::get('/FireCommand/calls', [Calls::class, 'index'])->name('fc-calls');
Route::get('/FireCommand/command', [Command::class, 'index'])->name('fc-command');
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\ActiveCallsController;
use Illuminate\Http\Request;
Route::get('/', function () {
	return redirect('/activecalls');
});

Route::get('/activecalls', [ActiveCallsController::class, 'index'])->name('activecalls');
<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PondController;
use App\Http\Controllers\SpellCheckerController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // count spell checker
    Route::get('/spell-counter', [SpellCheckerController::class, 'index'])->name('spell-checker.index');
    Route::post('/spell-counter', [SpellCheckerController::class, 'store']);

    // crud
    Route::resource('ponds', PondController::class);
    Route::resource('packages', PackageController::class);

    Route::get('/logs/create/{package}', [LogController::class, 'create'])->name('logs.create');
    Route::resource('logs', LogController::class)->except(['create']);
});

require __DIR__.'/auth.php';

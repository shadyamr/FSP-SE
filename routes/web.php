<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestsController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    /* Requests */
    Route::prefix('requests')->group(function () {
        Route::get('/', [RequestsController::class, 'index'])->name('requests');
        Route::post('store', [RequestsController::class, 'store'])->name('requests.store');
        Route::prefix('{id}')->group(function () {
            Route::get('edit', [RequestsController::class, 'edit'])->name('requests.edit');
            Route::post('edit/store', [RequestsController::class, 'store_edit'])->name('requests.store.edit');
            Route::get('delete', [RequestsController::class, 'destroy'])->name('requests.delete');
        });
    });
    /* Inspections */
    /*Route::prefix('inspections')->group(function () {
        Route::get('/', [RequestsController::class, 'index'])->name('requests');
        Route::post('store', [RequestsController::class, 'store'])->name('requests.store');
        Route::prefix('{id}')->group(function () {
            Route::get('edit', [RequestsController::class, 'edit'])->name('requests.edit');
            Route::post('edit/store', [RequestsController::class, 'store_edit'])->name('requests.store.edit');
            Route::get('delete', [RequestsController::class, 'destroy'])->name('requests.delete');
        });
    });*/
});

Auth::routes();
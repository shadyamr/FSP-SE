<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\InspectionController;
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
    //Route::group(['middleware' => ['auth', 'role:sales']], function() {
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
    //});
    /* Inspections */
    Route::prefix('inspections')->group(function () {
        Route::get('/', [InspectionController::class, 'index'])->name('inspections');
        Route::post('store', [InspectionController::class, 'store'])->name('inspections.store');
        Route::prefix('{id}')->group(function () {
            Route::get('edit', [InspectionController::class, 'edit'])->name('inspections.edit');
            Route::post('edit/store', [InspectionController::class, 'store_edit'])->name('inspections.store.edit');
            Route::get('delete', [InspectionController::class, 'destroy'])->name('inspections.delete');
        });
    });
});

Auth::routes(['register' => false], ['password.reset' => false]);
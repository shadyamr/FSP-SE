<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileEditController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\EmployeesController;
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
    Route::get('/profile', [ProfileEditController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileEditController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileEditController::class, 'destroy'])->name('profile.destroy');
    Route::get('/logs', [LogsController::class, 'index'])->name('logs');
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
    /* Accounting */
    Route::prefix('accounting')->group(function () {
        Route::get('/', [AccountingController::class, 'index'])->name('accounting');
        Route::prefix('salaries')->group(function () {
            Route::get('/', [AccountingController::class, 'salaries'])->name('accounting.salaries');
            Route::prefix('{id}')->group(function () {
                Route::get('edit', [AccountingController::class, 'edit_salaries_preview'])->name('accounting.salaries.edit');
                Route::post('edit/store', [AccountingController::class, 'edit_salary'])->name('accounting.salaries.store.edit');
            });
        });
    });
    /* Employee Management */
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeesController::class, 'index'])->name('employees');
        /*Route::prefix('{id}')->group(function () {
            Route::get('edit', [AccountingController::class, 'edit_salaries_preview'])->name('accounting.salaries.edit');
            Route::post('edit/store', [AccountingController::class, 'edit_salary'])->name('accounting.salaries.store.edit');
        });*/
    });
});

Auth::routes(['register' => false]);
//Auth::routes();
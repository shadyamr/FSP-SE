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
    Route::prefix('requests')->group(function () {
        Route::get('/', function () {
            return redirect()->route('requests.create');
         });
    
        Route::get('/create', function () {
           return view('requests');
        })->name('requests.create');
    
        Route::post('store', [RequestsController::class, 'store'])->name('requests.store');
    });
});

Auth::routes();
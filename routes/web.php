<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderController;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('admin')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        Route::resource('coffees', CoffeeController::class);
        Route::post('/update/{id}' , [CoffeeController::class, 'update']);
        Route::get('/order', [OrderController::class, 'index']);
        Route::delete('/order/{id}', [OrderController::class, 'destroy']);
        Route::get('/orderList', [OrderController::class, 'data'])->name('orderList');
    });
});
Route::get('/', [LandingController::class, 'index']);
Route::post('/pesanan', [OrderController::class, 'store']);

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\ReservationController;

use App\Http\Controllers\FrontEnd\CategoryController as HomeCategoryController;
use App\Http\Controllers\FrontEnd\MenuController as HomeMenuController;
use App\Http\Controllers\FrontEnd\ReservationController as HomeReservationController;
use App\Http\Controllers\FrontEnd\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/categories', [HomeCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [HomeCategoryController::class, 'show'])->name('categories.show');
Route::get('/menus', [HomeMenuController::class, 'index'])->name('menus.index');
Route::get('/reservation/step-one', [HomeReservationController::class, 'stepOne'])->name('reservations.step.one');
Route::post('/reservation/step-one', [HomeReservationController::class, 'storeStepOne'])->name('reservations.store.step.one');
Route::get('/reservation/step-two', [HomeReservationController::class, 'stepTwo'])->name('reservations.step.two');
Route::post('/reservation/step-two', [HomeReservationController::class, 'storeStepTwo'])->name('reservations.store.step.two');
Route::get('/thankyou', [WelcomeController::class, 'thankyou'])->name('thankyou');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/tables', TableController::class);
    Route::resource('/reservations', ReservationController::class);
});

require __DIR__ . '/auth.php';
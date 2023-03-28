<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\PharmacyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function(){
    return view('dashboard.index');
})->name('dashboard.index');

// Route::get('/pharmacy', [PharmacyController::class, 'index'])->name("pharmacy.index");
// Route::put('/pharmacy/{id}', [PharmacyController::class, 'update'])->name('pharmacy.update');
// Route::get('/pharmacy/create', [PharmacyController::class, 'create'])->name("pharmacy.create");
// Route::post('/pharmacy', [PharmacyController::class, 'store'])->name('pharmacy.store');
// Route::get('/pharmacy/edit/{id}', [PharmacyController::class, 'edit'])->name('pharmacy.edit');

Route::resource('pharmacy', PharmacyController::class);

Route::get('/area', [AreaController::class, 'index'])->name("area.index");
Route::get('/area/create', [AreaController::class, 'create'])->name("area.create");
Route::post('/area', [AreaController::class, 'store'])->name('area.store');
Route::get('/area/delete/{id}', [AreaController::class, 'delete'])->name('area.delete');
Route::put('/area/{id}', [AreaController::class, 'update'])->name('area.update');
Route::get('/area/edit/{id}', [AreaController::class, 'edit'])->name('area.edit');

Route::get('area/list', [AreaController::class, 'getArea'])->name('area.list');
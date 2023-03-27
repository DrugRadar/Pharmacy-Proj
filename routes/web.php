<?php

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
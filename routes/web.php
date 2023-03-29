<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PharmacyController;
use App\Models\Doctor;
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
Route::delete('/area/destroy/{id}', [AreaController::class, 'destroy'])->name('area.destroy');
Route::put('/area/{id}', [AreaController::class, 'update'])->name('area.update');
Route::get('/area/edit/{id}', [AreaController::class, 'edit'])->name('area.edit');

Route::get('/address', [AddressController::class, 'index'])->name("address.index");
Route::get('/address/create', [AddressController::class, 'create'])->name("address.create");
Route::post('/address', [AddressController::class, 'store'])->name('address.store');
Route::delete('/address/destroy/{id}', [AddressController::class, 'destroy'])->name('address.destroy');
Route::put('/address/{id}', [AddressController::class, 'update'])->name('address.update');
Route::get('/address/edit/{id}', [AddressController::class, 'edit'])->name('address.edit');


Route::get('/doctor', [DoctorController::class, 'index'])->name("doctor.index");
Route::get('/doctor/create', [DoctorController::class, 'create'])->name("doctor.create");
Route::post('/doctor', [DoctorController::class, 'store'])->name('doctor.store');
Route::get('/doctor/{id}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');
Route::delete('/doctor/destroy/{id}', [DoctorController::class, 'destroy'])->name('doctor.destroy');
Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('doctor.update');
Route::get('/doctor/ban/{id}', [DoctorController::class, 'ban'])->name('doctor.ban');
Route::get('/doctor/unBan/{id}', [DoctorController::class, 'unBan'])->name('doctor.unBan');
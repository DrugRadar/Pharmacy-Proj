<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\MedicineController;
use App\Models\Doctor;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');
    
    
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
    
    
    Route::get('/medicine', [MedicineController::class, 'index'])->name("medicine.index");
    Route::get('/medicine/create', [MedicineController::class, 'create'])->name("medicine.create");
    Route::post('/medicine', [MedicineController::class, 'store'])->name('medicine.store');
    Route::delete('/medicine/destroy/{id}', [MedicineController::class, 'destroy'])->name('medicine.destroy');
    Route::put('/medicine/{id}', [MedicineController::class, 'update'])->name('medicine.update');
    Route::get('/medicine/{id}/edit', [MedicineController::class, 'edit'])->name('medicine.edit');
});

// login Route

Route::get('client/register',[ClientController::class,'register'])->name('client.register');
Route::get('client/login',[ClientController::class,'login'])->name('client.login');
Route::get('/verify-email/{id}/{hash}', [ClientController::class, 'verify'])->name('verification.verify');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
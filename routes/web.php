<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderConfirmationController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StripeController;
use App\Mail\InactiveClientMail;
use App\Models\Client;
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
Route::group(['middleware' => ['auth',"role:admin|pharmacy|doctor"]], function() {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');

    Route::group(['middleware' => ['auth','role:admin']], function(){
        Route::get('/admin/profile' , [AdminController::class, 'profile'])->name('dashboard.admin.profile');
    
        Route::get('/medicine', [MedicineController::class, 'index'])->name("medicine.index");
        Route::get('/medicine/create', [MedicineController::class, 'create'])->name("medicine.create");
        Route::post('/medicine', [MedicineController::class, 'store'])->name('medicine.store');
        Route::delete('/medicine/{id}/destroy', [MedicineController::class, 'destroy'])->name('medicine.destroy');
        Route::put('/medicine/{id}', [MedicineController::class, 'update'])->name('medicine.update');
        Route::get('/medicine/{id}/edit', [MedicineController::class, 'edit'])->name('medicine.edit');
        Route::get('/medicine/{id}/restore', [MedicineController::class, 'restore'])->name('medicine.restore');
    
        Route::get('/area', [AreaController::class, 'index'])->name("area.index");
        Route::get('/area/create', [AreaController::class, 'create'])->name("area.create");
        Route::post('/area', [AreaController::class, 'store'])->name('area.store');
        Route::delete('/area/{id}/destroy', [AreaController::class, 'destroy'])->name('area.destroy');
        Route::put('/area/{id}', [AreaController::class, 'update'])->name('area.update');
        Route::get('/area/{id}/edit', [AreaController::class, 'edit'])->name('area.edit');
        Route::get('/area/{id}/restore', [AreaController::class, 'restore'])->name('area.restore');
    
        Route::get('/address', [AddressController::class, 'index'])->name("address.index");
        Route::get('/address/create', [AddressController::class, 'create'])->name("address.create");
        Route::post('/address', [AddressController::class, 'store'])->name('address.store');
        Route::delete('/address/{id}/destroy', [AddressController::class, 'destroy'])->name('address.destroy');
        Route::put('/address/{id}', [AddressController::class, 'update'])->name('address.update');
        Route::get('/address/{id}/edit', [AddressController::class, 'edit'])->name('address.edit');
        Route::get('/address/{id}/restore', [AddressController::class, 'restore'])->name('address.restore');
    
        Route::resource('pharmacy', PharmacyController::class);

        Route::get('/pharmacy/restore/{id}', [PharmacyController::class, 'restore'])->name('pharmacy.restore');
    });
    Route::group(['middleware' => ['auth','role:admin|pharmacy']], function(){
        Route::get('/doctor', [DoctorController::class, 'index'])->name("doctor.index");
        Route::get('/doctor/create', [DoctorController::class, 'create'])->name("doctor.create");
        Route::post('/doctor', [DoctorController::class, 'store'])->name('doctor.store');
        Route::get('/doctor/{id}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');
        Route::delete('/doctor/{id}/destroy', [DoctorController::class, 'destroy'])->name('doctor.destroy');
        Route::get('/doctor/{id}/restore', [DoctorController::class, 'restore'])->name('doctor.restore');
        Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('doctor.update');
        Route::get('/doctor/{id}/ban', [DoctorController::class, 'ban'])->name('doctor.ban');
        Route::get('/doctor/{id}/unBan', [DoctorController::class, 'unBan'])->name('doctor.unBan');
        Route::match(['get', 'put'], 'orders/export', [PharmacyController::class, 'export'])->name("orders.export");
        Route::get('/revenue', [RevenueController::class, 'index'])->name("revenue.index");
    });
    Route::group(['middleware' => ['auth','role:pharmacy']], function(){

        Route::get('/pharmacy/profile/{id}' , [PharmacyController::class, 'profile'])->name('dashboard.pharmacy.profile');

    });
    Route::group(['middleware' => ['auth','role:admin|pharmacy|doctor']], function(){
        Route::get('/orders', [OrderController::class, 'index'])->name("order.index");
        Route::get('/orders/create', [OrderController::class, 'create'])->name("order.create");
        Route::post('/orders', [OrderController::class, 'store'])->name("order.store");
        Route::get('/orders/{id}/process', [OrderController::class, 'process'])->name("order.process");
        Route::post('/orders/{id}/continue', [OrderController::class, 'continue'])->name("order.continue");
        Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name("order.edit");
        Route::put('/orders/{id}', [OrderController::class, 'update'])->name("order.update");
        Route::post('/orders/{id}/process', [OrderController::class, 'send'])->name("order.send");
        Route::delete('/orders/{id}/destroy', [OrderController::class, 'destroy'])->name('order.destroy');
        Route::get('/orders/{id}/restore', [OrderController::class, 'restore'])->name('order.restore');
        Route::get('/doctor/profile/{id}' , [DoctorController::class, 'profile'])->name('dashboard.doctor.profile');

    });
    Route::get('/orders/confirm/{id}',[OrderConfirmationController::class, 'confirmOrder'])->name('order.orderConfirm');
    Route::get('/orders/cancel/{id}',[OrderConfirmationController::class, 'cancelOrder'])->name('order.orderCancel');

    Route::get('stripe', [StripeController::class, 'stripe'])->name('stripe');
    Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

});


// login Route

// Route::get('/confirmOrder', [OrderController::class, 'SendOrderConfirmationMail'])->name("order");



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// // welcome on login
Route::get('/email', function(){
});
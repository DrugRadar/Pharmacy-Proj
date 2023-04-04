<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StripeController;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');

    Route::get('/admin/profile' , [AdminController::class, 'profile'])->name('dashboard.admin.profile');

    Route::resource('pharmacy', PharmacyController::class);
    Route::get('/pharmacy/profile/{id}' , [PharmacyController::class, 'profile'])->name('dashboard.pharmacy.profile');
    Route::get('/pharmacy/restore/{id}', [PharmacyController::class, 'restore'])->name('pharmacy.restore');

    Route::resource('doctor', DoctorController::class);
    Route::get('/doctor/ban/{id}', [DoctorController::class, 'ban'])->name('doctor.ban');
    Route::get('/doctor/unBan/{id}', [DoctorController::class, 'unBan'])->name('doctor.unBan');
    Route::get('/doctor/profile/{id}' , [DoctorController::class, 'profile'])->name('dashboard.doctor.profile');
    Route::get('/doctor/restore/{id}', [DoctorController::class, 'restore'])->name('doctor.restore');

    Route::resource('area', AreaController::class);
    Route::get('/area/restore/{id}', [AreaController::class, 'restore'])->name('area.restore');
    
    Route::resource('address', AddressController::class);
    Route::get('/address/restore/{id}', [AddressController::class, 'restore'])->name('address.restore');
    
    Route::resource('medicine', MedicineController::class);
    Route::get('/medicine/restore/{id}', [MedicineController::class, 'restore'])->name('medicine.restore');
    
    Route::resource('order', OrderController::class);
    Route::get('/order/process/{id}', [OrderController::class, 'process'])->name("order.process");
    Route::post('/order/process/{id}', [OrderController::class, 'send'])->name("order.send");
    Route::get('/order/restore/{id}', [OrderController::class, 'restore'])->name('order.restore');
    
    Route::get('/orders/confirm/{id}',[OrderController::class, 'confirmOrder'])->name('order.orderConfirm');
    Route::get('/orders/cancel/{id}',[OrderController::class, 'cancelOrder'])->name('order.orderCancel');

    Route::get('stripe', [StripeController::class, 'stripe'])->name('stripe');
    Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');


    Route::get('/revenue', [RevenueController::class, 'index'])->name("revenue.index");

    Route::match(['get', 'put'], 'orders/export', [PharmacyController::class, 'export'])->name("orders.export");
});

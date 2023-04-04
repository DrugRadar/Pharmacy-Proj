<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderConfirmationController;
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

        Route::resource('medicine', MedicineController::class);
        Route::get('/medicine/{id}/restore', [MedicineController::class, 'restore'])->name('medicine.restore');

        Route::resource('area', AreaController::class);
        Route::get('/area/{id}/restore', [AreaController::class, 'restore'])->name('area.restore');

        Route::resource('address', AddressController::class);
        Route::get('/address/{id}/restore', [AddressController::class, 'restore'])->name('address.restore');

        Route::resource('pharmacy', PharmacyController::class);
        Route::get('/pharmacy/restore/{id}', [PharmacyController::class, 'restore'])->name('pharmacy.restore');
    });

    Route::group(['middleware' => ['auth','role:admin|pharmacy']], function(){
        Route::resource('doctor', DoctorController::class);
        Route::get('/doctor/{id}/restore', [DoctorController::class, 'restore'])->name('doctor.restore');
        Route::get('/doctor/{id}/ban', [DoctorController::class, 'ban'])->name('doctor.ban');
        Route::get('/doctor/{id}/unBan', [DoctorController::class, 'unBan'])->name('doctor.unBan');

        Route::match(['get', 'put'], 'orders/export', [PharmacyController::class, 'export'])->name("orders.export");

        Route::get('/revenue', [RevenueController::class, 'index'])->name("revenue.index");
        Route::get('/charts', [ChartController::class, 'revenue'])->name('chart.revenue');
        Route::get('/attendance/gender', [ChartController::class, 'genderAttendance'])->name('chart.gender');

    });

    Route::group(['middleware' => ['auth','role:pharmacy']], function(){
        Route::get('/pharmacy/profile/{id}' , [PharmacyController::class, 'profile'])->name('pharmacy.profile');
        Route::get('/pharmacy/profile/{id}/edit', [PharmacyController::class, 'edit'])->name('pharmacy.profile.edit');
        Route::put('/pharmacy/profile/{id}', [PharmacyController::class, 'update'])->name('pharmacy.profile.update');
    });

    Route::group(['middleware' => ['auth','role:doctor']], function(){
        Route::get('/doctor/profile/{id}' , [DoctorController::class, 'profile'])->name('doctor.profile');
        Route::get('/doctor/profile/{id}/edit', [DoctorController::class, 'edit'])->name('doctor.profile.edit');
        Route::put('/doctor/profile/{id}', [DoctorController::class, 'update'])->name('doctor.profile.update');
    });

    Route::group(['middleware' => ['auth','role:admin|pharmacy|doctor']], function(){
        Route::resource('order', OrderController::class);
        Route::get('/order/{id}/process', [OrderController::class, 'process'])->name("order.process");
        Route::post('/order/{id}/continue', [OrderController::class, 'continue'])->name("order.continue");
        Route::post('/order/{id}/process', [OrderController::class, 'send'])->name("order.send");
        Route::get('/order/{id}/restore', [OrderController::class, 'restore'])->name('order.restore');
        Route::get('/order/{id}/delivered', [OrderController::class, 'deliveringOrder'])->name('order.delivered');
    });

    Route::get('/order/confirm/{id}',[OrderConfirmationController::class, 'confirmOrder'])->name('order.orderConfirm');
    Route::get('/order/cancel/{id}',[OrderConfirmationController::class, 'cancelOrder'])->name('order.orderCancel');

    Route::get('stripe', [StripeController::class, 'stripe'])->name('stripe');
    Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

    
    


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// // welcome on login
Route::get('/email', function(){
});
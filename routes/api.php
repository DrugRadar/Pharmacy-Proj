<?php

use App\Mail\WelcomeMail;
use App\Http\Controllers\Api\ClientController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AddressController;
use Spatie\FlareClient\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:sanctum']], function(){

});
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/client/register', [ClientController::class, 'register']);
Route::post('/client/login',[ClientController::class,'login']);
Route::get('/verify-email/{id}/{hash}', [ClientController::class, 'verify'])->name('verification.verify');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/orders', [OrderController::class, 'create']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}',[OrderController::class,'show']);
    // Route::post('/orders', [OrderController::class, 'store']);

    Route::post('/address', [AddressController::class, 'create']);
    Route::get('/address/{id}', [AddressController::class, 'index']);
    Route::put('/client/{clientId}/address/{addressId}',[AddressController::class,'update']);
    Route::delete('/client/{clientId}/address/{addressId}',[AddressController::class,'delete']);
});
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

/**
 * Get authenticated user
 *
 * @route GET /user
 * @middleware auth:sanctum
 *
 * @param Request $request
 * @return mixed
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:sanctum']], function(){

});
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

})->middleware(['auth', 'signed'])->name('verification.verify');


/**
 * Client Authentication Routes
 *
 * @route POST /client/register
 * @param ClientController@register
 *
 * @route POST /client/login
 * @param ClientController@login
 *
 * @route GET /verify-email/{id}/{hash}
 * @param ClientController@verify
 */

Route::post('/client/register', [ClientController::class, 'register']);
Route::post('/client/login',[ClientController::class,'login']);
Route::get('/verify-email/{id}/{hash}', [ClientController::class, 'verify'])->name('verification.verify');



    /**
     * Authenticated Routes
     */
Route::middleware('auth:sanctum')->group(function () {
        /**
     * Orders Routes
     *
     * @route POST /orders
     * @param OrderController@create
     *
     * @route GET /orders
     * @param OrderController@index
     *
     * @route GET /orders/{id}
     * @param OrderController@show
     *
     * @route PUT /orders/{id}
     * @param OrderController@edit
     */

    Route::post('/orders', [OrderController::class, 'create']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}',[OrderController::class,'show']);
    Route::put('/orders/{id}', [OrderController::class, 'edit']);

/**
     * Client Routes
     *
     * @route PUT /client/{id}
     * @param ClientController@update
     *
     * @route GET /client/{id}
     * @param ClientController@show
     *
     * @route GET /client/{clientId}/orders
     * @param ClientController@clientOrders
     */

    Route::put('/client/{id}',[ClientController::class,'update']);
    Route::get('/client/{id}',[ClientController::class,'show']);
    Route::get('/client/{clientId}/orders',[ClientController::class,'clientOrders']);


/**
     * Address Routes
     *
     * @route POST /address
     * @param AddressController@create
     *
     * @route GET /address/{id}
     * @param AddressController@index
     *
     * @route PUT /client/{clientId}/address/{addressId}
     * @param AddressController@update
     *
     * @route DELETE /client/{clientId}/address/{addressId}
     * @param AddressController@delete
     */


    // Route::post('/orders', [OrderController::class, 'store']);
    Route::post('/address', [AddressController::class, 'create']);
    Route::get('/address/{id}', [AddressController::class, 'index']);
    Route::put('/client/{clientId}/address/{addressId}',[AddressController::class,'update']);
    Route::delete('/client/{clientId}/address/{addressId}',[AddressController::class,'delete']);
});
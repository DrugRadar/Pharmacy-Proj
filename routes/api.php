<?php

use App\Mail\WelcomeMail;
use App\Http\Controllers\Api\ClientController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
    Route::get('client/{id}', [ClientController::class , 'show'])->name('client.show');
    Route::put('client/{id}', [ClientController::class , 'edit'])->name('client.edit');
});
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/client/register', [ClientController::class, 'register']);
Route::post('/client/login',[ClientController::class,'login']);
Route::get('/verify-email/{id}/{hash}', [ClientController::class, 'verify'])->name('verification.verify');

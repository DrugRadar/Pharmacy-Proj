<?php

use App\Http\Controllers\ClientController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('client/register',[ClientController::class,'register'])->name('client.register');
Route::get('client/login',[ClientController::class,'login'])->name('client.login');
Route::get('client/{id}', [ClientController::class , 'show'])->name('client.show');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
})->middleware(['auth', 'signed'])->name('verification.verify');

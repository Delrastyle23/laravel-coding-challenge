<?php

use App\Http\Controllers\Dashboard\ReferralController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::group(['prefix' => 'referral'], function(){
        Route::get('/', [ReferralController::class, 'index']);
        Route::post('/', [ReferralController::class, 'store']);
    });
});






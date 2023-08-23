<?php

use App\Http\Controllers\Api\RegisterController;
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

Route::controller(RegisterController::class)->group(function (){
    Route::post("login" , 'login')->name('login');
    Route::get("login" , 'login')->name('login');
    Route::post("register" , 'register');
});


Route::middleware('auth:sanctum')->group(function (){
        Route::post("add_product", [\App\Http\Controllers\ProductController::class , 'store']);
});

<?php

use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Recipe\RecipeController;
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

Route::group(['middleware'=>['auth:http']], function () {
    Route::get('orders', [OrderController::class, 'paginate']);
    Route::post('orders',[OrderController::class, 'store'] );
    Route::get('recipes', [RecipeController::class, 'paginate']);
});


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => 'checkApiKey'], function () {
    Route::get('product/list', [App\Http\Controllers\Api\ProductController::class, 'listProduct']);
    Route::post('product/detail', [App\Http\Controllers\Api\ProductController::class, 'detail'])->name('product_detail');
    Route::post('product/delete', [App\Http\Controllers\Api\ProductController::class, 'delete']);
    Route::post('product/save', [App\Http\Controllers\Api\ProductController::class, 'save']);
    Route::post('product/update', [App\Http\Controllers\Api\ProductController::class, 'update']);
});

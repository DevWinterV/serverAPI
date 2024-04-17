<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodListController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/foodlists', [FoodListController::class, 'index']);
    Route::get('/foodlists/{id}', [FoodListController::class, 'show']);
    Route::get('/foodlists/search/{keyword}', [FoodListController::class, 'search']);
    Route::post('/foodlists', [FoodListController::class, 'store']);
    Route::put('/foodlists', [FoodListController::class, 'update']);
    Route::delete('/foodlists/{id}', [FoodListController::class, 'destroy']);
});


<?php

use App\Api\Application\Controllers\BrandController;
use App\Api\Application\Controllers\CarController;
use App\Api\Application\Controllers\ClientController;
use App\Api\Application\Controllers\LeaseController;
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

Route::prefix('brand')->group(function (){
    Route::post('/save-brand', [BrandController::class, 'saveBrand']);
    Route::post('/find-brand', [BrandController::class, 'findBrand']);
    Route::post('/update-brand', [BrandController::class, 'updateBrand']);
    Route::post('/delete-brand', [BrandController::class, 'deleteBrand']);
    
    Route::get('/find-all-brands', [BrandController::class, 'findAllBrands']);
});

Route::prefix('car')->group(function (){
    Route::post('/save-car', [CarController::class, 'saveCar']);
});

Route::prefix('client')->group(function (){
    Route::post('/save-client', [ClientController::class, 'saveClient']);
});

Route::prefix('lease')->group(function (){
    Route::post('/save-lease', [LeaseController::class, 'saveLease']);
});

Route::prefix('model')->group(function (){
    Route::post('/save-model', [BrandController::class, 'saveModel']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

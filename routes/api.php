<?php

use App\Api\Application\Controllers\BrandController;
use App\Api\Application\Controllers\CarController;
use App\Api\Application\Controllers\ClientController;
use App\Api\Application\Controllers\LeaseController;
use App\Api\Application\Controllers\ModelController;
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

// Route::get('/', function(){
//  return response()->json(['Api Conectada']);
// });

Route::prefix('brand')->group(function (){
    Route::post('/save-brand', [BrandController::class, 'saveBrand']);
    Route::post('/find-brand', [BrandController::class, 'findBrand']);
    Route::post('/update-brand', [BrandController::class, 'updateBrand']);
    Route::post('/delete-brand', [BrandController::class, 'deleteBrand']);
    
    Route::get('/find-all-brands', [BrandController::class, 'findAllBrands']);
});

Route::prefix('car')->group(function (){
    Route::post('/save-car', [CarController::class, 'saveCar']);
    Route::post('/find-car', [CarController::class, 'findCar']);
    Route::post('/update-car', [CarController::class, 'updateCar']);
    Route::post('/delete-car', [CarController::class, 'deleteCar']);

    Route::get('/find-all-cars', [CarController::class, 'findAllCars']);
});

Route::prefix('client')->group(function (){
    Route::post('/save-client', [ClientController::class, 'saveClient']);
    Route::post('/find-client', [ClientController::class, 'findClient']);
    Route::post('/update-client', [ClientController::class, 'updateClient']);
    Route::post('/delete-client', [ClientController::class, 'delteClient']);
    
    Route::get('/find-all-client', [ClientController::class, 'findAllClient']);
});

Route::prefix('lease')->group(function (){
    Route::post('/save-lease', [LeaseController::class, 'saveLease']);
});

Route::prefix('model')->group(function (){
    Route::post('/save-model', [ModelController::class, 'saveModel']);
    Route::post('/find-model', [ModelController::class, 'findModel']);
    Route::post('/update-model', [ModelController::class, 'updateModel']);
    Route::post('/delete-model', [ModelController::class, 'deleteModel']);
    
    Route::get('/find-all-models', [ModelController::class, 'findAllModels']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

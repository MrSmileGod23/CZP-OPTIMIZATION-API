<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\EconomistController;
use App\Http\Controllers\GuardController;
use App\Http\Controllers\StorekeeperController;
use App\Http\Controllers\UserController;
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

Route::post('/login',[UserController::class,'login']);

Route::middleware('api_token')->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);
});

// маршруты только для кладовщика
Route::middleware(['role:Storekeeper','api_token'])->group(function () {
    Route::get('/storekeeper/waiting/drivers',[StorekeeperController::class,'index']);
    Route::post('/storekeeper/waiting/drivers',[StorekeeperController::class,'switch']);
});

// маршруты только для экономиста
Route::middleware(['role:Economist','api_token'])->group(function () {
    Route::post('/economist/pass',[EconomistController::class,'store']);
});

// маршруты только для охранника
Route::middleware(['role:Guard','api_token'])->group(function () {
    Route::get('/guard/count/drivers',[GuardController::class,'drivers']);
    Route::get('/guard/passes',[GuardController::class,'index']);
    Route::post('/guard/pass',[GuardController::class,'switch']);
});


Route::get('/board/guard',[BoardController::class,'guard']);
Route::get('/board/storekeeper',[BoardController::class,'storekeeper']);

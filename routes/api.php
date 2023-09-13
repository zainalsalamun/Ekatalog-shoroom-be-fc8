<?php

use Illuminate\Http\Request;
use App\Models\TipeRodaPenggerak;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JenisController;
use App\Http\Controllers\API\KondisiController;
use App\Http\Controllers\API\TransmisiController;
use App\Http\Controllers\API\BahanBakarController;
use App\Http\Controllers\API\ShowroomController;
use App\Http\Controllers\API\TipeRodaPenggerakController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::resource('/jenis', JenisController::class);
    Route::resource('/kondisi', KondisiController::class);
    Route::resource('/transmisi', TransmisiController::class);
    Route::resource('/bahan-bakar', BahanBakarController::class);
    Route::resource('/tipe-roda-penggerak', TipeRodaPenggerakController::class);
    Route::resource('/showroom', ShowroomController::class);
});

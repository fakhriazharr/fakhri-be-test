<?php

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

//posts
Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);

//barang
Route::apiResource('/barang', App\Http\Controllers\Api\BarangController::class);

//pengajuan
Route::apiResource('/pengajuan', App\Http\Controllers\Api\PengajuanController::class);

//pengembalian
Route::apiResource('/pengembalian', App\Http\Controllers\Api\PengembalianController::class);
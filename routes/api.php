<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\CategoryBarangController;
use App\Http\Controllers\BatchBarangController;

Route::get('/', function () {
    return response()->json([
        'message' => 'Selamat datang di API Sistem Gudang',
    ]);
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });
    Route::prefix('user')->group(function () {
        Route::get('', [UserController::class, 'getAll']);
        Route::get('{id}', [UserController::class, 'getById']);
        Route::post('', [UserController::class, 'create']);
        Route::put('{id}', [UserController::class, 'updateById']);
        Route::delete('{id}', [UserController::class, 'deleteById']);
    });
    Route::prefix('barang')->group(function () {
        Route::get('', [BarangController::class, 'getAll']);
        Route::get('{id}', [BarangController::class, 'getById']);
        Route::get('kode/{kode}', [BarangController::class, 'getByKodeBarang']);
        Route::post('', [BarangController::class, 'create']);
        Route::put('{id}', [BarangController::class, 'updateById']);
        Route::delete('{id}', [BarangController::class, 'deleteById']);
    });
    Route::prefix('mutasi')->group(function () {
        Route::post('', [MutasiController::class, 'create']);
        Route::get('', [MutasiController::class, 'getAll']);
        Route::get('user/{id}', [MutasiController::class, 'getByUser']);
        Route::get('barang/{id}', [MutasiController::class, 'getByBarang']);
        Route::get('{id}', [MutasiController::class, 'getById']);
        Route::put('{id}', [MutasiController::class, 'updateById']);
        Route::delete('{id}', [MutasiController::class, 'deleteById']);
    });
    Route::prefix('gudang')->group(function () {
        Route::get('', [GudangController::class, 'getAll']);
        Route::get('{id}', [GudangController::class, 'getById']);
        Route::post('', [GudangController::class, 'create']);
        Route::put('{id}', [GudangController::class, 'update']);
        Route::delete('{id}', [GudangController::class, 'delete']);
    });
    Route::prefix('category')->group(function () {
        Route::get('', [CategoryBarangController::class, 'getAll']);
        Route::get('{id}', [CategoryBarangController::class, 'getById']);
        Route::post('', [CategoryBarangController::class, 'create']);
        Route::put('{id}', [CategoryBarangController::class, 'update']);
        Route::delete('{id}', [CategoryBarangController::class, 'delete']);
    });
    Route::prefix('batch')->group(function () {
        Route::get('', [BatchBarangController::class, 'getAll']);
        Route::get('kadaluarsa', [BatchBarangController::class, 'cekKadaluarsa']);
        Route::get('{id}', [BatchBarangController::class, 'getById']);
        Route::post('', [BatchBarangController::class, 'create']);
        Route::put('{id}', [BatchBarangController::class, 'update']);
        Route::delete('{id}', [BatchBarangController::class, 'delete']);
    });
});

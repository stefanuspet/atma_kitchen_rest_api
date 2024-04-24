<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\HampersController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\PoinController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukPenitipController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authentication
Route::post('/customers', [AuthController::class, 'registerCustomer']);
Route::post('/customers/login', [AuthController::class, 'loginCustomer']);
Route::post('/users/login', [AuthController::class, 'loginUser']);
// forgot password User
Route::post('/users/forgetpassword', [UserController::class, 'forgetPassword']);
// forgot password Customer
Route::post('/customers/requestforget', [CustomerController::class, 'forgetPassword']);
// verify token
Route::post('/customers/verify/{token}', [CustomerController::class, 'verify']);

// ===============[ all User can access ] ===============
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk_penitip', [ProdukPenitipController::class, 'index']);

// ===============[ authenticated user ] ===============
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/customers/profile', [CustomerController::class, 'getProfile']);
    Route::get('/users/profile', [UserController::class, 'getProfile']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

// ===============[ role : Admin ] ===============
Route::middleware(['auth:sanctum', 'abilities:ADMIN'])->group(function () {
    // produk
    Route::post('/produk', [ProdukController::class, 'store']);
    Route::post('/produk/{id}', [ProdukController::class, 'update']);
    Route::get('/produk/{id}', [ProdukController::class, 'show']);
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);

    // produk penitip
    Route::post('/produk_penitip', [ProdukPenitipController::class, 'store']);
    Route::put('/produk_penitip/{id}', [ProdukPenitipController::class, 'update']);
    Route::get('/produk_penitip/{id}', [ProdukPenitipController::class, 'show']);
    Route::delete('/produk_penitip/{id}', [ProdukPenitipController::class, 'destroy']);

    // hampers
    Route::get('/hampers', [HampersController::class, 'index']);
    Route::post('/hampers', [HampersController::class, 'store']);
    Route::put('/hampers/{id}', [HampersController::class, 'update']);
    Route::get('/hampers/{id}', [HampersController::class, 'show']);
    Route::delete('/hampers/{id}', [HampersController::class, 'destroy']);

    // Poin
    Route::get('/poins', [PoinController::class, 'index']);
    Route::post('/poins', [PoinController::class, 'store']);
    Route::put('/poins/{id}', [PoinController::class, 'update']);
    Route::get('/poins/{id}', [PoinController::class, 'show']);
    Route::delete('/poins/{id}', [PoinController::class, 'destroy']);
});

// ===============[  role : Manager ] ===============
Route::middleware(['auth:sanctum', 'abilities:MO'])->group(function () {
    // karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::post('/karyawan', [KaryawanController::class, 'store']);
    Route::put('/karyawan/{id}', [KaryawanController::class, 'update']);
    Route::get('/karyawan/{id}', [KaryawanController::class, 'show']);
    Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy']);

    // penitip
    Route::get('/penitip', [PenitipController::class, 'index']);
    Route::post('/penitip', [PenitipController::class, 'store']);
    Route::put('/penitip/{id}', [PenitipController::class, 'update']);
    Route::get('/penitip/{id}', [PenitipController::class, 'show']);
    Route::delete('/penitip/{id}', [PenitipController::class, 'destroy']);

    // presensi
    Route::get('/presensi', [PresensiController::class, 'index']);
    Route::post('/presensi', [PresensiController::class, 'store']);
    Route::put('/presensi/{id}', [PresensiController::class, 'update']);
    Route::get('/presensi/{id}', [PresensiController::class, 'show']);
    Route::delete('/presensi/{id}', [PresensiController::class, 'destroy']);

    // jabatan
    Route::get('/jabatan', [JabatanController::class, 'index']);
    Route::post('/jabatan', [JabatanController::class, 'store']);
    Route::put('/jabatan/{id}', [JabatanController::class, 'update']);
    Route::get('/jabatan/{id}', [JabatanController::class, 'show']);
    Route::delete('/jabatan/{id}', [JabatanController::class, 'destroy']);
});

// ===============[  role : Owner ] ===============

Route::middleware(['auth:sanctum', 'abilities:OWNER'])->group(function () {
    // gaji
    Route::get('/gaji', [GajiController::class, 'index']);
    Route::post('/gaji', [GajiController::class, 'store']);
    Route::put('/gaji/{id}', [GajiController::class, 'update']);
    Route::get('/gaji/{id}', [GajiController::class, 'show']);
    Route::delete('/gaji/{id}', [GajiController::class, 'destroy']);
});

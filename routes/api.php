<?php

use App\Http\Controllers\API\AktivitasKoorController;
use App\Http\Controllers\API\AktivitasPetugasController;
use App\Http\Controllers\API\AspirasiController;
use App\Http\Controllers\API\JadwalController;
use App\Http\Controllers\API\KoorGedungController;
use App\Http\Controllers\API\KoorUmumController;
use App\Http\Controllers\API\LaporAcaraController;
use App\Http\Controllers\API\LaporKotorController;
use App\Http\Controllers\API\PetugasController;
use App\Http\Controllers\API\UserController;
use App\Models\KoorGedung;
use App\Models\LaporKotor;
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
Route::get('user', [UserController::class, 'index']);
Route::post('user/store', [UserController::class, 'store']);
Route::get('user/show/{id}', [UserController::class, 'show']);

Route::get('petugas', [PetugasController::class, 'index']);
Route::post('petugas/store', [PetugasController::class, 'store']);
Route::get('petugas/show/{id}', [PetugasController::class, 'show']);

Route::get('koorGedung', [KoorGedungController::class, 'index']);
Route::post('koorGedung/store', [KoorGedungController::class, 'store']);
Route::get('koorGedung/show/{id}', [KoorGedungController::class, 'show']);

Route::get('koorUmum', [KoorUmumController::class, 'index']);
Route::post('koorUmum/store', [KoorUmumController::class, 'store']);
Route::get('koorUmum/show/{id}', [KoorUmumController::class, 'show']);

Route::get('aktivitasKoor', [AktivitasKoorController::class, 'index']);
Route::post('aktivitasKoor/store', [AktivitasKoorController::class, 'store']);
Route::get('aktivitasKoor/show/{id}', [AktivitasKoorController::class, 'show']);

Route::get('aktivitasPetugas', [AktivitasPetugasController::class, 'index']);
Route::post('aktivitasPetugas/store', [AktivitasPetugasController::class, 'store']);
Route::get('aktivitasPetugas/show/{id}', [AktivitasPetugasController::class, 'show']);

Route::get('aspirasi', [AspirasiController::class, 'index']);
Route::post('aspirasi/store', [AspirasiController::class, 'store']);
Route::get('aspirasi/show/{id}', [AspirasiController::class, 'show']);

Route::get('jadwal', [JadwalController::class, 'index']);
Route::post('jadwal/store', [JadwalController::class, 'store']);
Route::get('jadwal/show/{id}', [JadwalController::class, 'show']);

Route::get('laporAcara', [LaporAcaraController::class, 'index']);
Route::post('laporAcara/store', [LaporAcaraController::class, 'store']);
Route::get('laporAcara/show/{id}', [LaporAcaraController::class, 'show']);

Route::get('laporKotor', [LaporKotorController::class, 'index']);
Route::post('laporKotor/store', [LaporKotorController::class, 'store']);
Route::get('laporKotor/show/{id}', [LaporKotorController::class, 'show']);


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

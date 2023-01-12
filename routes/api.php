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

use App\Http\Controllers\AuthController;

use App\Models\Jadwal;

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

Route::get('user/uid/{uid}', [UserController::class, 'userByUid']);

Route::post('user/store', [UserController::class, 'store']);

Route::get('user/show/{id}', [UserController::class, 'show']);

Route::put('user/update/{id}', [UserController::class, 'update']);





Route::get('petugas/{code}', [PetugasController::class, 'index']);

Route::get('petugas/get/petugas', [PetugasController::class, 'fetchPetugas']);

Route::post('petugas/store', [PetugasController::class, 'store']);

Route::get('petugas/show/{id}', [PetugasController::class, 'show']);

Route::post('petugas/update/{user_id}', [PetugasController::class, 'update']);

Route::get('petugas/getPetugasByUid/{uid}', [PetugasController::class, 'getPetugasByUid']);

Route::put('petugas/updateCode/{user_id}', [PetugasController::class, 'updateCode']);

Route::get('petugas/cekCode/{code}', [PetugasController::class, 'codeCheck']);

Route::get('petugas/get/bestPetugas', [PetugasController::class, 'bestPetugas']);

Route::get('petugas/get/getAllPetugas', [PetugasController::class, 'getAllPetugas']);






Route::get('koorGedung', [KoorGedungController::class, 'index']);

Route::post('koorGedung/store', [KoorGedungController::class, 'store']);

Route::post('koorGedung/update/{user_id}', [KoorGedungController::class, 'update']);

Route::get('koorGedung/show/{id}', [KoorGedungController::class, 'show']);

Route::get('koorGedung/getKoorByUid/{uid}', [KoorGedungController::class, 'getKoorByUid']);

Route::get('koorGedung/getStatusPetugas/{id}', [KoorGedungController::class, 'getStatusPetugas']);

Route::get('koorGedung/jumlahPetugas', [KoorGedungController::class, 'jumlahPetugas']);

Route::put('koorGedung/updateCode/{user_id}', [KoorGedungController::class, 'updateCode']);





Route::get('koorUmum', [KoorUmumController::class, 'index']);

Route::post('koorUmum/store', [KoorUmumController::class, 'store']);

Route::get('koorUmum/show/{id}', [KoorUmumController::class, 'show']);



Route::get('aktivitasKoor/{id}', [AktivitasKoorController::class, 'index']);

Route::post('aktivitasKoor/store', [AktivitasKoorController::class, 'store']);

Route::get('aktivitasKoor/show/{id}', [AktivitasKoorController::class, 'show']);

Route::delete('aktivitasKoor/destroy/{id}', [AktivitasKoorController::class, 'destroy']);



Route::get('aktivitasPetugas/{id}', [AktivitasPetugasController::class, 'index']);

Route::post('aktivitasPetugas/store', [AktivitasPetugasController::class, 'store']);

Route::get('aktivitasPetugas/show/{id}', [AktivitasPetugasController::class, 'show']);

Route::get('aktivitasPetugas/byCode/{code}', [AktivitasPetugasController::class, 'getByCode']);

Route::get('aktivitasPetugas/getAll/aktivitas', [AktivitasPetugasController::class, 'notif']);

Route::delete('aktivitasPetugas/destroy/{id}', [AktivitasPetugasController::class, 'destroy']);

Route::put('aktivitasPetugas/update/{id}', [AktivitasPetugasController::class, 'update']);

Route::put('aktivitasPetugas/aktivitasConfirmed/{id}', [AktivitasPetugasController::class, 'aktivitasConfirmed']);



Route::get('aspirasi', [AspirasiController::class, 'index']);

Route::post('aspirasi/store/{user_id}', [AspirasiController::class, 'store']);

Route::get('aspirasi/show/{id}', [AspirasiController::class, 'show']);



Route::get('jadwal/{id}', [JadwalController::class, 'index']);

// Route::post('jadwal/{id}', [JadwalController::class, 'index']);

Route::put('jadwal/update/{id}', [JadwalController::class, 'update']);

Route::get('jadwal', [JadwalController::class, 'getAll']);
Route::get('jadwal/get/status', [JadwalController::class, 'getStatus']);




Route::get('laporAcara/getData/{id}', [LaporAcaraController::class, 'index']);

Route::get('laporAcara/getAllData/{id}', [LaporAcaraController::class, 'getLaporanAcara']);

Route::post('laporAcara/update/{id}', [LaporAcaraController::class, 'update']);

Route::post('laporAcara/store', [LaporAcaraController::class, 'store']);

Route::get('laporAcara/show/{id}', [LaporAcaraController::class, 'show']);



Route::get('laporKotor', [LaporKotorController::class, 'index']);

Route::get('laporKotor/getData/{user_id}', [LaporKotorController::class, 'getLaporanByArea']);

Route::post('laporKotor/store', [LaporKotorController::class, 'store']);

Route::get('laporKotor/update/{id}', [LaporKotorController::class, 'update']);





Route::post('login', [AuthController::class, 'login']);



Route::group(['middleware' => 'api'], function(){

    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::post('me', [AuthController::class, 'me']);

});


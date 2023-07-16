<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Catatan;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\DataSekolahController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfilSekolah;
use App\Http\Controllers\VerifikasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class,'index'])->name('login')->middleware('revalidate');
Route::post('/', [AuthController::class,'postlogin']);
Route::group(['middleware' => ['auth', 'checkRole:administrator','revalidate']], function () {
     Route::resource('home', HomeAdminController::class);
     Route::resource('sekolah', DataSekolahController::class);
     Route::POST('updatesekolah/{data}', [DataSekolahController::class,'updatedata']);
     Route::resource('verifikasi',VerifikasiController::class);
     Route::get('dataverifikasi',[VerifikasiController::class,'index']);


});
Route::group(['middleware' => ['auth', 'checkRole:operator','revalidate']], function () {
     Route::resource('laporan', LaporanController::class);
     Route::POST('update/{laporan}', [LaporanController::class,'update']);
     Route::get('datalaporan',[LaporanController::class,'data_laporan']);
     Route::resource('catatan',Catatan::class);
     Route::resource('profil',ProfilSekolah::class);
     Route::resource('cetaklaporan',CetakController::class);
     Route::post('inputnomer/{data}',[CetakController::class,'show']);
     Route::post('updatenomer/{data}',[CetakController::class,'update']);

});
Route::group(['middleware' => ['auth', 'checkRole:administrator,operator']], function () {
     Route::get('download/{kategori}/{data}',[DownloadController::class,'download']);

});
Route::get('password', [PasswordController::class,'edit'])->name('user.password.edit');
Route::patch('password', [PasswordController::class,'update'])->name('user.password.update');

Route::get('logout', [AuthController::class,'logout']);

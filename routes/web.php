<?php

use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SaksiController;
use App\Http\Controllers\SuaraController;
use App\Http\Controllers\TpsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaslonController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KecamatanController;

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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
Route::get('/tps', [TpsController::class, 'index'])->name('tps');
Route::get('/tps-list', [TpsController::class, 'list_tps'])->name('tps.list');
Route::get('/paslon', [PaslonController::class, 'index'])->name('paslon');
Route::get('/saksi', [SaksiController::class, 'index'])->name('saksi');
Route::get('/kabupaten_kota', [KabupatenController::class, 'index'])->name('kabupaten');
Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan');
Route::get('/desa_kelurahan', [KelurahanController::class, 'index'])->name('kelurahan');
Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
Route::get('/input-suara', [SuaraController::class, 'input_suara'])->name('input.suara');
Route::get('/perhitungan-suara', [SuaraController::class, 'perhitungan_suara'])->name('perhitungan.suara');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
Route::get('/input-suara-saksi', [SuaraController::class, 'input_suara_saksi'])->name('perhitungan.suara.saksi');
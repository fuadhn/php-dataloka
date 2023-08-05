<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarPelangganController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/daftar-pelanggan', [DaftarPelangganController::class, 'index'])->name('daftar_pelanggan.list');
Route::post('/daftar-pelanggan', [DaftarPelangganController::class, 'index'])->name('daftar_pelanggan.list');
Route::post('/bulk-update-status', [DaftarPelangganController::class, 'bulk_update_status'])->name('daftar_pelanggan.bulk');
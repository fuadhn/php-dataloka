<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarPelangganController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\ProfilPelangganController;

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

Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.list');
Route::get('/inbox/{id_pelanggan}', [InboxController::class, 'index'])->name('inbox.search');
Route::get('/inbox/resend_invoice/{id_pelanggan}/{nomor_invoice}', [InboxController::class, 'resend_invoice'])->name('inbox.resend_invoice');

Route::get('/profil-pelanggan/{id_pelanggan}', [ProfilPelangganController::class, 'index'])->name('profil_pelanggan.index');
Route::post('/profil-pelanggan/{id_pelanggan}', [ProfilPelangganController::class, 'index'])->name('profil_pelanggan.index');
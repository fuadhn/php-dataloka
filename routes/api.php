<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarPelangganController;

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

Route::put('/update_status_akun', [DaftarPelangganController::class, 'update_status_akun'])->name('api.update_status_akun');
Route::delete('/delete_pelanggan', [DaftarPelangganController::class, 'delete_pelanggan'])->name('api.delete_pelanggan');
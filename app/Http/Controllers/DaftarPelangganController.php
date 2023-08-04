<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaftarPelangganController extends Controller
{
    public function index() {
        return view('daftar-pelanggan/index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_pelanggan;

class InboxController extends Controller
{
    public function index(Request $request, $id_pelanggan=null) {
        $page_title = "Chat & Inbox";
        $user = "semua";

        if(M_pelanggan::where('ID_PELANGGAN', $id_pelanggan)->exists()) {
            $pelanggan = M_pelanggan::find($id_pelanggan);

            $user = $pelanggan->NAMA_PELANGGAN;
        }

        return view('inbox/index', [
            'page_title' => $page_title,
            'user' => $user
        ]);
    }
}

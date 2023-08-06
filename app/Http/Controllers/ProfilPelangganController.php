<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_pelanggan;
use App\Models\T_detail_tagihan;
use App\Models\T_berlangganan_produk;
use App\Models\T_tagihan_produk;

class ProfilPelangganController extends Controller
{
    public function index(Request $request, $id_pelanggan=null) {
        if(M_pelanggan::where('ID_PELANGGAN', $id_pelanggan)->exists()) {
            $pelanggan = M_pelanggan::find($id_pelanggan);

            // $detail_tagihan = T_detail_tagihan::with(['berlangganan_produk' => function($query) use ($id_pelanggan) {
            //     $query->where('ID_PELANGGAN', '=', 2);
            // }])
            // ->get();

            // Get all id tagihan
            $arr_id_tagihan = [];
            $berlangganan_produk = T_berlangganan_produk::with('detail_tagihan')->where('ID_PELANGGAN', $id_pelanggan)->get();

            foreach($berlangganan_produk as $row) {
                if(!is_null($row->detail_tagihan)) {
                    if(!in_array($row->detail_tagihan->ID_TAGIHAN, $arr_id_tagihan)) {
                        $arr_id_tagihan[] = $row->detail_tagihan->ID_TAGIHAN;
                    }
                }
            }

            $tagihan = T_tagihan_produk::whereIn('ID_TAGIHAN', $arr_id_tagihan)->get();

            $page_title = "Profil Pelanggan";

            return view('daftar-pelanggan/profile', [
                'page_title' => $page_title,
                'tagihan' => $tagihan
            ]);
        } else {
            return redirect('/daftar-pelanggan');
        }
    }
}

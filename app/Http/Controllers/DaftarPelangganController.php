<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_paket_produk;
use App\Models\M_pelanggan;

class DaftarPelangganController extends Controller
{
    public function index(Request $request) {
        $daterange = $request->daterange;
        $id_paket_produk = $request->id_paket_produk;
        $tanggal_mulai = null;
        $tanggal_akhir = null;
        $page_title = "Pelanggan : Daftar Pelanggan";

        if(!is_null($daterange)) {
            $arr_date = explode(' - ', $daterange);
            $tanggal_mulai = date('Y-m-d', strtotime($arr_date[0]));
            $tanggal_akhir = date('Y-m-d', strtotime($arr_date[1]));
        }

        $paket_produk = M_paket_produk::get();
        $pelanggan = M_pelanggan::with(['berlangganan_produk' => function($query) use ($tanggal_mulai, $tanggal_akhir, $id_paket_produk) {
            if(!is_null($tanggal_mulai)) {
                $query->whereDate('TANGGAL_MULAI', '>=', $tanggal_mulai);
            }
    
            if(!is_null($tanggal_akhir)) {
                $query->whereDate('TANGGAL_AKHIR', '>=', $tanggal_akhir);
            }

            if(!is_null($id_paket_produk)) {
                $query->where('ID_PAKET_PRODUK', '=', $id_paket_produk);
            }
        }])
        ->where('STATUS_AKUN', '!=', 'delete');

        $pelanggan = $pelanggan->get();

        return view('daftar-pelanggan/index', [
            'paket_produk' => $paket_produk,
            'pelanggan' => $pelanggan,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_akhir' => $tanggal_akhir,
            'id_paket_produk' => $id_paket_produk,
            'page_title' => $page_title
        ]);
    }

    public function bulk_update_status(Request $request) {
        $ids_pelanggan = $request->ids_pelanggan;
        $aksi = $request->aksi;

        $arr_pelanggan = explode(':', $ids_pelanggan);

        if($ids_pelanggan != '') {
            foreach($arr_pelanggan as $id_pelanggan) {
                $pelanggan = M_pelanggan::find($id_pelanggan);

                $pelanggan->STATUS_AKUN = $aksi;

                $pelanggan->save();
            }
        }

        return redirect('/daftar-pelanggan');
    }
}

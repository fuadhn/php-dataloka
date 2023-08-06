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

        $paket_produk = M_paket_produk::where('DELETED', 0)->get();
        $pelanggan = M_pelanggan::with(['berlangganan_produk' => function($query) use ($tanggal_mulai, $tanggal_akhir, $id_paket_produk) {
            if(!is_null($tanggal_mulai)) {
                $query->whereDate('TANGGAL_MULAI', '>=', $tanggal_mulai);
            }
    
            if(!is_null($tanggal_akhir)) {
                $query->whereDate('TANGGAL_MULAI', '<=', $tanggal_akhir);
            }

            if(!is_null($id_paket_produk)) {
                $query->where('ID_PAKET_PRODUK', '=', $id_paket_produk);
            }
        }])
        ->where('STATUS_AKUN', '!=', 'delete');

        $pelanggan = $pelanggan->where('DELETED', 0)->get();

        // Get min max date
        $min_date = 0;
        $max_date = 0;
        if ($pelanggan) {
            foreach ($pelanggan as $row) {
                if (!is_null($row->berlangganan_produk)) {
                    if($min_date == 0) {
                        $min_date = strtotime($row->berlangganan_produk->TANGGAL_MULAI);
                        $max_date = strtotime($row->berlangganan_produk->TANGGAL_MULAI);
                    } else {
                        if(strtotime($row->berlangganan_produk->TANGGAL_MULAI) < $min_date) {
                            $min_date = strtotime($row->berlangganan_produk->TANGGAL_MULAI);
                        }
            
                        if(strtotime($row->berlangganan_produk->TANGGAL_MULAI) > $max_date) {
                            $max_date = strtotime($row->berlangganan_produk->TANGGAL_MULAI);
                        }
                    }
                }
            }
        }

        return view('daftar-pelanggan/index', [
            'paket_produk' => $paket_produk,
            'pelanggan' => $pelanggan,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_akhir' => $tanggal_akhir,
            'id_paket_produk' => $id_paket_produk,
            'page_title' => $page_title,
            'min_date' => $min_date,
            'max_date' => $max_date
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

    public function update_status_akun(Request $request) {
        if(M_pelanggan::where('ID_PELANGGAN', $request->id_pelanggan)->exists()) {
            $pelanggan = M_pelanggan::find($request->id_pelanggan);

            $pelanggan->STATUS_AKUN = $request->status_akun;

            $pelanggan->save();

            return response()->json([
                'success' => true,
                'message' => 'Status akun berhasil diperbarui.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ID pelanggan tidak diketahui.'
            ], 404);
        }
    }

    public function delete_pelanggan(Request $request) {
        if(M_pelanggan::where('ID_PELANGGAN', $request->id_pelanggan)->exists()) {
            $pelanggan = M_pelanggan::find($request->id_pelanggan);

            $pelanggan->STATUS_AKUN = 'delete';

            $pelanggan->save();

            return response()->json([
                'success' => true,
                'message' => 'Pelanggan berhasil dihapus.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'ID pelanggan tidak diketahui.'
            ], 404);
        }
    }
}

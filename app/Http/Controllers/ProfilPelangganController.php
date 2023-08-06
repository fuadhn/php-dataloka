<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_pelanggan;
use App\Models\T_detail_tagihan;
use App\Models\T_berlangganan_produk;
use App\Models\T_tagihan_produk;
use App\Models\M_paket_produk;

class ProfilPelangganController extends Controller
{
    public function index(Request $request, $id_pelanggan=null) {
        if(M_pelanggan::where('ID_PELANGGAN', $id_pelanggan)->exists()) {
            $paket_produk = M_paket_produk::get();
            $no_invoice = $request->no_invoice;
            $id_paket_produk = $request->id_paket_produk;
            $status_berlangganan = $request->status_berlangganan;
            $daterange = $request->daterange;
            $pelanggan = M_pelanggan::find($id_pelanggan)->first();
            $tanggal_mulai = null;
            $tanggal_akhir = null;
            if(!is_null($daterange)) {
                $arr_date = explode(' - ', $daterange);
                $tanggal_mulai = date('Y-m-d', strtotime($arr_date[0]));
                $tanggal_akhir = date('Y-m-d', strtotime($arr_date[1]));
            }

            // Get all id tagihan
            $arr_id_tagihan = [];
            $berlangganan_produk = T_berlangganan_produk::with('detail_tagihan')->where('ID_PELANGGAN', $id_pelanggan);

            if(!is_null($status_berlangganan)) {
                if($status_berlangganan == 'aktif') {
                    $berlangganan_produk = $berlangganan_produk->whereDate('TANGGAL_MULAI', '<=', date('Y-m-d'))->whereDate('TANGGAL_AKHIR', '>=', date('Y-m-d'));
                }

                if($status_berlangganan == 'tidak_aktif') {
                    $berlangganan_produk = $berlangganan_produk->whereDate('TANGGAL_MULAI', '>', date('Y-m-d'))->orWhereDate('TANGGAL_AKHIR', '<', date('Y-m-d'));
                }
            }

            if(!is_null($id_paket_produk)) {
                $berlangganan_produk = $berlangganan_produk->where('ID_PAKET_PRODUK', $id_paket_produk);
            }

            $berlangganan_produk = $berlangganan_produk->get();

            foreach($berlangganan_produk as $row) {
                if(!is_null($row->detail_tagihan)) {
                    if(!in_array($row->detail_tagihan->ID_TAGIHAN, $arr_id_tagihan)) {
                        $arr_id_tagihan[] = $row->detail_tagihan->ID_TAGIHAN;
                    }
                }
            }

            $tagihan = T_tagihan_produk::whereIn('ID_TAGIHAN', $arr_id_tagihan);

            if(!is_null($tanggal_mulai)) {
                $tagihan = $tagihan->whereDate('TANGGAL_TAGIHAN', '>=', $tanggal_mulai);
            }
            
            if(!is_null($tanggal_akhir)) {
                $tagihan = $tagihan->whereDate('TANGGAL_TAGIHAN', '<=', $tanggal_akhir);
            }

            if(!is_null($no_invoice)) {
                $tagihan = $tagihan->where('NOMOR_TAGIHAN', 'like', '%' . $no_invoice . '%');
            }

            $tagihan = $tagihan->get();

            // Get min max date
            $min_date = 0;
            $max_date = 0;
            if ($tagihan) {
                foreach ($tagihan as $row) {
                    if($min_date == 0) {
                        $min_date = strtotime($row->TANGGAL_TAGIHAN);
                        $max_date = strtotime($row->TANGGAL_TAGIHAN);
                    } else {
                        if(strtotime($row->TANGGAL_TAGIHAN) < $min_date) {
                            $min_date = strtotime($row->TANGGAL_TAGIHAN);
                        }
            
                        if(strtotime($row->TANGGAL_TAGIHAN) > $max_date) {
                            $max_date = strtotime($row->TANGGAL_TAGIHAN);
                        }
                    }
                }
            }

            $page_title = "Profil Pelanggan";

            return view('daftar-pelanggan/profile', [
                'page_title' => $page_title,
                'tagihan' => $tagihan,
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_akhir' => $tanggal_akhir,
                'paket_produk' => $paket_produk,
                'id_paket_produk' => $id_paket_produk,
                'status_berlangganan' => $status_berlangganan,
                'no_invoice' => $no_invoice,
                'min_date' => $min_date,
                'max_date' => $max_date,
                'pelanggan' => $pelanggan
            ]);
        } else {
            return redirect('/daftar-pelanggan');
        }
    }
}

<?php
use App\Models\T_berlangganan_produk;
use App\Models\T_detail_tagihan;
use App\Models\T_tagihan_produk;
use App\Models\T_pembayaran;

function get_invoice($id_berlangganan) {
    $detail_tagihan = T_detail_tagihan::with('tagihan_produk')->where('ID_BERLANGGANAN', $id_berlangganan)->first();

    return $detail_tagihan->tagihan_produk->NOMOR_TAGIHAN;
}

function get_format_rupiah($number) {
    return "Rp " . number_format($number, 0, ',', '.');
}

function get_harga_satuan($id_tagihan) {
    // Get all id berlangganan
    $arr_id_berlangganan = [];
    $detail_tagihan = T_detail_tagihan::with('berlangganan_produk')->where('ID_TAGIHAN', $id_tagihan)->get();

    foreach($detail_tagihan as $row) {
        if(!is_null($row->berlangganan_produk)) {
            if(!in_array($row->berlangganan_produk->ID_BERLANGGANAN, $arr_id_berlangganan)) {
                $arr_id_berlangganan[] = $row->berlangganan_produk->ID_BERLANGGANAN;
            }
        }
    }

    $berlangganan_produk = T_berlangganan_produk::with('paket_produk')->whereIn('ID_BERLANGGANAN', $arr_id_berlangganan)->get();

    $min = 0;
    $max = 0;

    foreach($berlangganan_produk as $row) {
        if($min == 0) {
            $min = $row->paket_produk->HARGA;
            $max = $row->paket_produk->HARGA;
        } else {
            if($row->paket_produk->HARGA < $min) {
                $min = $row->paket_produk->HARGA;
            }

            if($row->paket_produk->HARGA > $max) {
                $max = $row->paket_produk->HARGA;
            }
        }
    }

    if($min != $max) {
        return get_format_rupiah($min) . " - " . get_format_rupiah($max);
    } else {
        return get_format_rupiah($max);
    }
}

function get_jenis_pembayaran($id_tagihan) {
    if(T_pembayaran::where('ID_TAGIHAN', $id_tagihan)->exists()) {
        $pembayaran = T_pembayaran::with('metode_pembayaran')->where('ID_TAGIHAN', $id_tagihan)->first();

        return $pembayaran->metode_pembayaran->METODE_PEMBAYARAN;
    } else {
        return "-";
    }
}
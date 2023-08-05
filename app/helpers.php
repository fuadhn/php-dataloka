<?php
use App\Models\T_berlangganan_produk;
use App\Models\T_detail_tagihan;
use App\Models\T_tagihan_produk;

function get_invoice($id_berlangganan) {
    $detail_tagihan = T_detail_tagihan::with('tagihan_produk')->where('ID_BERLANGGANAN', $id_berlangganan)->first();

    echo $detail_tagihan->tagihan_produk->NOMOR_TAGIHAN;
}
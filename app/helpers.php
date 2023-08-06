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

function get_daftar_produk($id_tagihan) {
    $arr = [];

    $tagihan = T_tagihan_produk::find($id_tagihan);
    $uang_muka = 0;
    $diskon = 0;
    $jumlah_bayar = 0;

    if(T_pembayaran::where('ID_TAGIHAN', $id_tagihan)->exists()) {
        $pembayaran = T_pembayaran::with('metode_pembayaran')->where('ID_TAGIHAN', $id_tagihan)->first();

        $uang_muka = $pembayaran->UANG_MUKA;
        $diskon = $pembayaran->DISKON;
        $jumlah_bayar = $pembayaran->JUMLAH_BAYAR;
    }

    $arr['nomor_tagihan'] = $tagihan->NOMOR_TAGIHAN;
    $arr['nama_pelanggan'] = ""; // default
    $arr['jumlah_tagihan'] = $tagihan->JUMLAH_TAGIHAN;
    $arr['tanggal_tagihan'] = $tagihan->TANGGAL_TAGIHAN;
    $arr['tanggal_jatuh_tempo'] = $tagihan->TANGGAL_JATUH_TEMPO;
    $arr['metode_pembayaran'] = get_jenis_pembayaran($id_tagihan);
    $arr['ppn'] = $tagihan->BESAR_PAJAK;
    $arr['uang_muka'] = $uang_muka;
    $arr['diskon'] = $diskon;
    $arr['jumlah_bayar'] = $jumlah_bayar;

    // Get all id berlangganan
    $arr_id_berlangganan = [];
    $arr_qty = [];
    $detail_tagihan = T_detail_tagihan::with('berlangganan_produk')->where('ID_TAGIHAN', $id_tagihan)->get();

    foreach($detail_tagihan as $row) {
        if(!is_null($row->berlangganan_produk)) {
            if(!in_array($row->berlangganan_produk->ID_BERLANGGANAN, $arr_id_berlangganan)) {
                $arr_id_berlangganan[] = $row->berlangganan_produk->ID_BERLANGGANAN;
                $arr_qty[$row->berlangganan_produk->ID_BERLANGGANAN] = $row->JUMLAH;
            }
        }
    }

    $berlangganan_produk = T_berlangganan_produk::with('paket_produk')->with('pelanggan')->whereIn('ID_BERLANGGANAN', $arr_id_berlangganan)->get();

    $arr_produk = [];

    foreach($berlangganan_produk as $row) {
        $arr['nama_pelanggan'] = $row->pelanggan->NAMA_PELANGGAN;

        $date1 = new DateTime($row->TANGGAL_MULAI);
        $date2 = new DateTime($row->TANGGAL_AKHIR);
        $diff = $date1->diff($date2);
        $periode = (($diff->format('%y') * 12) + $diff->format('%m'));

        $temp = array(
            'nama_produk' => $row->paket_produk->NAMA_PRODUK,
            'qty' => $arr_qty[$row->ID_BERLANGGANAN],
            'periode' => $periode,
            'harga_satuan' => $row->paket_produk->HARGA,
            'diskon' => '-',
            'pajak' => '-',
            'subtotal' => $arr_qty[$row->ID_BERLANGGANAN] * $row->paket_produk->HARGA
        );

        array_push($arr_produk, $temp);
    }

    $arr['daftar_produk'] = $arr_produk;

    return $arr;
}

function get_jenis_pembayaran($id_tagihan) {
    if(T_pembayaran::where('ID_TAGIHAN', $id_tagihan)->exists()) {
        $pembayaran = T_pembayaran::with('metode_pembayaran')->where('ID_TAGIHAN', $id_tagihan)->first();

        return $pembayaran->metode_pembayaran->METODE_PEMBAYARAN;
    } else {
        return "-";
    }
}
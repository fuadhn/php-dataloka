<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for($i=1; $i<=5; $i++) {
            // Perusahaan B2B
            \DB::table('m_perusahaan_b2b')->insert([
                'NAMA_PERUSAHAAN' => $faker->company,
                'ALAMAT_PERUSAHAAN' => $faker->address,
                'NO_TELP_PERUSAHAAN' => $faker->e164PhoneNumber,
                'NPWP_PERUSAHAAN' => $faker->nik,
                'DELETED' => 0,
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        for($i=1; $i<=5; $i++) {
            // Payment Gateway
            \DB::table('m_payment_gateway')->insert([
                'METODE_PEMBAYARAN' => $faker->randomElement(array('Bank Transfer', 'GoPay', 'OVO', 'Dana', 'ShopeePay'))
            ]);
        }

        $harga_produk = [];
        for($i=1; $i<=5; $i++) {
            $harga = $faker->numberBetween(100000, 1000000);
            $harga_produk[] = $harga;

            // Paket produk
            \DB::table('m_paket_produk')->insert([
                'GRANULARITY_ID' => 1,
                'ID_DELIVERY' => 1,
                'ID_JENIS_PAKET_PRODUK' => 1,
                'NAMA_PRODUK' => $faker->tld,
                'DESKRIPSI_PRODUK' => $faker->paragraph,
                'JURNAL_PRODUK_ID' => 1,
                'GAMBAR' => $faker->imageUrl,
                'HARGA' => $harga,
                'TNC' => $faker->sentence,
                'URL_SAMPLE_API' => $faker->url,
                'STATUS_TAMPIL' => $faker->randomElement(array('Y', 'T')),
                'STATUS_AKTIF' => $faker->randomElement(array('Y', 'T')),
                'STATUS_B2B' => $faker->randomElement(array('Y', 'T')),
                'DELETED' => 0,
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        for($i=1; $i<=5; $i++) {
            // KYC
            \DB::table('m_kyc_pelanggan')->insert([
                'KYC' => '{}',
                'TGL_MULAI_AKTIF' => $faker->date,
                'STATUS_AKTIF' => $faker->randomElement(array('Y', 'T')),
                'DELETED' => 0,
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        for($i=1; $i<=5; $i++) {
            // Pelanggan
            \DB::table('m_pelanggan')->insert([
                'ID_KYC' => $i,
                'ID_PERUSAHAAN' => $faker->randomElement(array(1, 2, 3, 4, 5)),
                'USERNAME' => $faker->userName,
                'PASSWORD' => $faker->password,
                'NAMA_PELANGGAN' => $faker->name,
                'TEMPAT_LAHIR' => $faker->city,
                'TANGGAL_LAHIR' => $faker->date,
                'GENDER' => $faker->randomElement(array('L', 'P')),
                'ALAMAT_KTP' => $faker->address,
                'ALAMAT_DOMISILI' => $faker->address,
                'KOTA_DOMISILI' => $faker->city,
                'PROVINSI_DOMISILI' => $faker->state,
                'EMAIL' => $faker->email,
                'NO_HP' => $faker->e164PhoneNumber,
                'FB' => $faker->userName,
                'PROFILE_PHOTO' => $faker->imageUrl,
                'KYC' => '{}',
                'JABATAN' => substr($faker->jobTitle, 0, 20),
                'SKOR_KUESIONER' => $faker->numberBetween(1, 100),
                'STATUS_PELANGGAN' => $faker->randomElement(array('b2b', 'b2c')),
                'STATUS_AKUN' => $faker->randomElement(array('aktif', 'delete', 'suspend')),
                'ROLE_PELANGGAN' => $faker->randomElement(array('admin', 'anggota')),
                'STATUS_MITRA' => $faker->randomElement(array('mitra', 'pelanggan')),
                'DELETED' => 0,
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        for($i=1; $i<=5; $i++) {
            // Berlangganan
            \DB::table('t_berlangganan_produk')->insert([
                'ID_PELANGGAN' => $i,
                'BER_ID_BERLANGGANAN' => null,
                'ID_PAKET_PRODUK' => $i,
                'TANGGAL_MULAI' => $faker->date,
                'TANGGAL_AKHIR' => $faker->date,
                'BIAYA' => $harga_produk[$i-1],
                'STATUS' => $faker->randomElement(array('Aktif', 'Tidak Aktif', 'Ditolak')),
                'KUOTA_SURAT_RISET' => $faker->randomNumber,
                'SISA_KUOTA_SURAT_RISET' => $faker->randomNumber,
                'KUOTA_DOWNLOAD' => $faker->randomNumber,
                'SISA_KUOTA_DOWNLOAD' => $faker->randomNumber,
                'FREE_TRIAL_STATUS' => $faker->randomElement(array('Y', 'T')),
                'DELETED' => 0,
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        $arr_diskon = [];
        $arr_jumlah_tagihan = [];
        for($i=1; $i<=5; $i++) {
            $diskon = $faker->numberBetween(0, $harga_produk[$i-1] / 2);
            $arr_diskon[] = $diskon;

            $besar_pajak = $faker->numberBetween(100000, 1000000);
            $jumlah_tagihan = $harga_produk[$i-1] - $diskon + $besar_pajak;
            $arr_jumlah_tagihan[] = $jumlah_tagihan;

            // Tagihan produk
            \DB::table('t_tagihan_produk')->insert([
                'ID_JENIS_PAJAK' => 1,
                'JUMLAH_TAGIHAN' => $harga_produk[$i-1],
                'TANGGAL_TAGIHAN' => $faker->date,
                'TANGGAL_JATUH_TEMPO' => $faker->date,
                'TOTAL_ITEM' => 1,
                'STATUS_TAGIHAN' => 'DIBAYAR',
                'DISKON' => $diskon,
                'NOMOR_TAGIHAN' => $faker->bankAccountNumber,
                'BESAR_PAJAK' => $besar_pajak,
                'STATUS_TERMIN_B2B' => $faker->randomElement(array('Y', 'T')),
                'DELETED' => 0,
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        for($i=1; $i<=5; $i++) {
            // Detail tagihan
            \DB::table('t_detail_tagihan')->insert([
                'ID_TAGIHAN' => $i,
                'ID_BERLANGGANAN' => $i,
                'JUMLAH' => 1,
                'HARGA_SATUAN' => $harga_produk[$i-1],
                'DELETED' => 0,
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        for($i=1; $i<=5; $i++) {
            $uang_muka = $faker->numberBetween(0, $arr_jumlah_tagihan[$i-1] / 2);
            $diskon = $arr_diskon[$i-1];
            // Pembayaran
            \DB::table('t_pembayaran')->insert([
                'ID_TAGIHAN' => $i,
                'ID_PAYMENT_GATEWAY' => $faker->randomElement(array(1, 2, 3, 4, 5)),
                'ID_PROMOSI' => 1,
                'ID_VOUCHER' => 1,
                'ID_TERMIN_B2B' => 1,
                'TANGGAL_BAYAR' => $faker->date,
                'JUMLAH_BAYAR' => $arr_jumlah_tagihan[$i-1] - $uang_muka,
                'UANG_MUKA' => $uang_muka,
                'DISKON' => $diskon,
                'KODE_MITRA' => 'DATALOKA1',
                'FILE_FAKTUR' => $faker->imageUrl,
                'STATUS_BAYAR' => 'BERHASIL',
                'UPLOAD_BUKTI_BAYAR' => $faker->imageUrl,
                'APPROVE_BUKTI_BAYAR' => 'DISETUJUI',
                'DELETED' => 0,
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }
    }
}

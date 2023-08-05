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
                'DELETED' => $faker->randomElement(array(0, 1)),
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        for($i=1; $i<=5; $i++) {
            // Paket produk
            \DB::table('m_paket_produk')->insert([
                'GRANULARITY_ID' => 1,
                'ID_DELIVERY' => 1,
                'ID_JENIS_PAKET_PRODUK' => 1,
                'NAMA_PRODUK' => $faker->tld,
                'DESKRIPSI_PRODUK' => $faker->paragraph,
                'JURNAL_PRODUK_ID' => 1,
                'GAMBAR' => $faker->imageUrl,
                'HARGA' => $faker->numberBetween(100000, 1000000),
                'TNC' => $faker->sentence,
                'URL_SAMPLE_API' => $faker->url,
                'STATUS_TAMPIL' => $faker->randomElement(array('Y', 'T')),
                'STATUS_AKTIF' => $faker->randomElement(array('Y', 'T')),
                'STATUS_B2B' => $faker->randomElement(array('Y', 'T')),
                'DELETED' => $faker->randomElement(array(0, 1)),
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
                'DELETED' => $faker->randomElement(array(0, 1)),
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        for($i=1; $i<=5; $i++) {
            // Pelanggan
            \DB::table('m_pelanggan')->insert([
                'ID_KYC' => $faker->randomElement(array(1, 2, 3, 4, 5)),
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
                'DELETED' => $faker->randomElement(array(0, 1)),
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        for($i=1; $i<=5; $i++) {
            // Berlangganan
            \DB::table('t_berlangganan_produk')->insert([
                'ID_PELANGGAN' => $faker->randomElement(array(1, 2, 3, 4, 5)),
                'BER_ID_BERLANGGANAN' => null,
                'ID_PAKET_PRODUK' => $faker->randomElement(array(1, 2, 3, 4, 5)),
                'TANGGAL_MULAI' => $faker->date,
                'TANGGAL_AKHIR' => $faker->date,
                'BIAYA' => $faker->numberBetween(100000, 1000000),
                'STATUS' => $faker->randomElement(array('Aktif', 'Tidak Aktif', 'Ditolak')),
                'KUOTA_SURAT_RISET' => $faker->randomNumber,
                'SISA_KUOTA_SURAT_RISET' => $faker->randomNumber,
                'KUOTA_DOWNLOAD' => $faker->randomNumber,
                'SISA_KUOTA_DOWNLOAD' => $faker->randomNumber,
                'FREE_TRIAL_STATUS' => $faker->randomElement(array('Y', 'T')),
                'DELETED' => $faker->randomElement(array(0, 1)),
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        for($i=1; $i<=5; $i++) {
            // Tagihan produk
            \DB::table('t_tagihan_produk')->insert([
                'ID_JENIS_PAJAK' => 1,
                'JUMLAH_TAGIHAN' => $faker->numberBetween(100000, 1000000),
                'TANGGAL_TAGIHAN' => $faker->date,
                'TANGGAL_JATUH_TEMPO' => $faker->date,
                'TOTAL_ITEM' => $faker->numberBetween(1, 10),
                'STATUS_TAGIHAN' => $faker->randomElement(array('BELUM DIBAYAR', 'DIBAYAR')),
                'DISKON' => $faker->numberBetween(100000, 1000000),
                'NOMOR_TAGIHAN' => $faker->bankAccountNumber,
                'BESAR_PAJAK' => $faker->numberBetween(100000, 1000000),
                'STATUS_TERMIN_B2B' => $faker->randomElement(array('Y', 'T')),
                'DELETED' => $faker->randomElement(array(0, 1)),
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        for($i=1; $i<=5; $i++) {
            // Detail tagihan
            \DB::table('t_detail_tagihan')->insert([
                'ID_TAGIHAN' => $faker->randomElement(array(1, 2, 3, 4, 5)),
                'ID_BERLANGGANAN' => $faker->randomElement(array(1, 2, 3, 4, 5)),
                'JUMLAH' => 1,
                'HARGA_SATUAN' => $faker->numberBetween(100000, 1000000),
                'DELETED' => $faker->randomElement(array(0, 1)),
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }

        for($i=1; $i<=5; $i++) {
            // Pembayaran
            \DB::table('t_pembayaran')->insert([
                'ID_TAGIHAN' => $faker->randomElement(array(1, 2, 3, 4, 5)),
                'ID_PAYMENT_GATEWAY' => 1,
                'ID_PROMOSI' => 1,
                'ID_VOUCHER' => 1,
                'ID_TERMIN_B2B' => 1,
                'TANGGAL_BAYAR' => $faker->date,
                'JUMLAH_BAYAR' => $faker->numberBetween(100000, 1000000),
                'UANG_MUKA' => $faker->numberBetween(100000, 1000000),
                'DISKON' => $faker->numberBetween(100000, 1000000),
                'KODE_MITRA' => 'DATALOKA1',
                'FILE_FAKTUR' => $faker->imageUrl,
                'STATUS_BAYAR' => $faker->randomElement(array('BERHASIL', 'GAGAL')),
                'UPLOAD_BUKTI_BAYAR' => $faker->imageUrl,
                'APPROVE_BUKTI_BAYAR' => $faker->randomElement(array('DISETUJUI', 'DITOLAK')),
                'DELETED' => $faker->randomElement(array(0, 1)),
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }
    }
}

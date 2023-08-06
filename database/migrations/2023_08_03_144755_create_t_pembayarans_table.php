<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_pembayaran', function (Blueprint $table) {
            $table->bigIncrements('ID_PEMBAYARAN');
            $table->unsignedBigInteger('ID_TAGIHAN');
            $table->unsignedBigInteger('ID_PAYMENT_GATEWAY'); // tabel referensi tidak diketahui, menambahkan manual kebutuhan views
            $table->integer('ID_PROMOSI'); // tabel referensi tidak diketahui
            $table->integer('ID_VOUCHER'); // tabel referensi tidak diketahui
            $table->integer('ID_TERMIN_B2B'); // tabel referensi tidak diketahui
            $table->date('TANGGAL_BAYAR');
            $table->integer('JUMLAH_BAYAR');
            $table->integer('UANG_MUKA');
            $table->integer('DISKON');
            $table->string('KODE_MITRA', 100);
            $table->text('FILE_FAKTUR');
            $table->enum('STATUS_BAYAR', ['BERHASIL', 'GAGAL']);
            $table->string('UPLOAD_BUKTI_BAYAR', 100);
            $table->enum('APPROVE_BUKTI_BAYAR', ['DISETUJUI', 'DITOLAK']);
            $table->tinyInteger('DELETED');
            $table->string('CREATED_BY', 100);
            $table->dateTime('CREATED_AT');
            $table->string('UPDATED_BY', 100);
            $table->dateTime('UPDATED_AT');

            $table->foreign('ID_TAGIHAN')->references('ID_TAGIHAN')->on('t_tagihan_produk')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ID_PAYMENT_GATEWAY')->references('ID_PAYMENT_GATEWAY')->on('m_payment_gateway')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pembayaran');
    }
};

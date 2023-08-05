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
        Schema::create('t_berlangganan_produk', function (Blueprint $table) {
            $table->bigIncrements('ID_BERLANGGANAN');
            $table->unsignedBigInteger('ID_PELANGGAN');
            $table->unsignedBigInteger('BER_ID_BERLANGGANAN')->nullable();
            $table->unsignedBigInteger('ID_PAKET_PRODUK');
            $table->date('TANGGAL_MULAI');
            $table->date('TANGGAL_AKHIR');
            $table->integer('BIAYA');
            $table->enum('STATUS', ['Aktif', 'Tidak Aktif', 'Ditolak']);
            $table->integer('KUOTA_SURAT_RISET');
            $table->integer('SISA_KUOTA_SURAT_RISET');
            $table->integer('KUOTA_DOWNLOAD');
            $table->integer('SISA_KUOTA_DOWNLOAD');
            $table->enum('FREE_TRIAL_STATUS', ['Y', 'T']);
            $table->tinyInteger('DELETED');
            $table->string('CREATED_BY', 100);
            $table->dateTime('CREATED_AT');
            $table->string('UPDATED_BY', 100);
            $table->dateTime('UPDATED_AT');

            $table->foreign('ID_PELANGGAN')->references('ID_PELANGGAN')->on('m_pelanggan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('BER_ID_BERLANGGANAN')->references('ID_BERLANGGANAN')->on('t_berlangganan_produk')->onDelete(null)->onUpdate('cascade');
            $table->foreign('ID_PAKET_PRODUK')->references('ID_PAKET_PRODUK')->on('m_paket_produk')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_berlangganan_produk');
    }
};

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
        Schema::create('m_paket_produk', function (Blueprint $table) {
            $table->bigIncrements('ID_PAKET_PRODUK');
            $table->integer('GRANULARITY_ID'); // tabel referensi tidak diketahui
            $table->integer('ID_DELIVERY'); // tabel referensi tidak diketahui
            $table->integer('ID_JENIS_PAKET_PRODUK'); // tabel referensi tidak diketahui
            $table->string('NAMA_PRODUK', 100);
            $table->text('DESKRIPSI_PRODUK');
            $table->string('JURNAL_PRODUK_ID', 100); // endpoint tidak diketahui
            $table->text('GAMBAR');
            $table->integer('HARGA');
            $table->text('TNC');
            $table->string('URL_SAMPLE_API', 100);
            $table->enum('STATUS_TAMPIL', ['Y', 'T']);
            $table->enum('STATUS_AKTIF', ['Y', 'T']);
            $table->enum('STATUS_B2B', ['Y', 'T']);
            $table->tinyInteger('DELETED');
            $table->string('CREATED_BY', 100);
            $table->dateTime('CREATED_AT');
            $table->string('UPDATED_BY', 100);
            $table->dateTime('UPDATED_AT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_paket_produk');
    }
};

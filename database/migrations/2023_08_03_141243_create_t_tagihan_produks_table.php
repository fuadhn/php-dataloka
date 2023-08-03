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
        Schema::create('t_tagihan_produk', function (Blueprint $table) {
            $table->bigIncrements('ID_TAGIHAN');
            $table->integer('ID_JENIS_PAJAK'); // tabel referensi tidak diketahui
            $table->integer('JUMLAH_TAGIHAN');
            $table->date('TANGGAL_TAGIHAN');
            $table->date('TANGGAL_JATUH_TEMPO');
            $table->integer('TOTAL_ITEM');
            $table->string('STATUS_TAGIHAN', 20);
            $table->integer('DISKON');
            $table->string('NOMOR_TAGIHAN', 50);
            $table->integer('BESAR_PAJAK');
            $table->enum('STATUS_TERMIN_B2B', ['Y', 'T']);
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
        Schema::dropIfExists('t_tagihan_produk');
    }
};

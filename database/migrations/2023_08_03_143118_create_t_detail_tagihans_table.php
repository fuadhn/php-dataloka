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
        Schema::create('t_detail_tagihan', function (Blueprint $table) {
            $table->bigIncrements('ID_DETAIL_TAGIHAN');
            $table->unsignedBigInteger('ID_TAGIHAN');
            $table->unsignedBigInteger('ID_BERLANGGANAN');
            $table->integer('JUMLAH');
            $table->integer('HARGA_SATUAN');
            $table->tinyInteger('DELETED');
            $table->string('CREATED_BY', 100);
            $table->dateTime('CREATED_AT');
            $table->string('UPDATED_BY', 100);
            $table->dateTime('UPDATED_AT');

            $table->foreign('ID_TAGIHAN')->references('ID_TAGIHAN')->on('t_tagihan_produk')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ID_BERLANGGANAN')->references('ID_BERLANGGANAN')->on('t_berlangganan_produk')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_detail_tagihan');
    }
};

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
        Schema::create('m_pelanggan', function (Blueprint $table) {
            $table->bigIncrements('ID_PELANGGAN');
            $table->unsignedBigInteger('ID_KYC');
            $table->unsignedBigInteger('ID_PERUSAHAAN');
            $table->string('USERNAME', 100);
            $table->string('PASSWORD', 50);
            $table->string('NAMA_PELANGGAN', 100);
            $table->string('TEMPAT_LAHIR', 100);
            $table->date('TANGGAL_LAHIR');
            $table->char('GENDER', 1);
            $table->string('ALAMAT_KTP', 500);
            $table->string('ALAMAT_DOMISILI', 500);
            $table->string('KOTA_DOMISILI', 50);
            $table->string('PROVINSI_DOMISILI', 50);
            $table->string('EMAIL', 100);
            $table->string('NO_HP', 100);
            $table->string('FB', 100);
            $table->string('PROFILE_PHOTO', 100);
            $table->json('KYC');
            $table->string('JABATAN', 20);
            $table->integer('SKOR_KUESIONER');
            $table->enum('STATUS_PELANGGAN', ['b2b', 'b2c']);
            $table->enum('STATUS_AKUN', ['aktif', 'delete', 'suspend']);
            $table->enum('ROLE_PELANGGAN', ['admin', 'anggota'])->nullable();
            $table->enum('STATUS_MITRA', ['mitra', 'pelanggan']);
            $table->tinyInteger('DELETED');
            $table->string('CREATED_BY', 100);
            $table->dateTime('CREATED_AT');
            $table->string('UPDATED_BY', 100);
            $table->dateTime('UPDATED_AT');

            $table->foreign('ID_KYC')->references('ID_KYC')->on('m_kyc_pelanggan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ID_PERUSAHAAN')->references('ID_PERUSAHAAN')->on('m_perusahaan_b2b')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_pelanggan');
    }
};

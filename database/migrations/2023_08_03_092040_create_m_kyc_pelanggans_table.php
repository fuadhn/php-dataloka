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
        Schema::create('m_kyc_pelanggan', function (Blueprint $table) {
            $table->bigIncrements('ID_KYC');
            $table->json('KYC');
            $table->date('TGL_MULAI_AKTIF');
            $table->enum('STATUS_AKTIF', ['Y', 'T']);
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
        Schema::dropIfExists('m_kyc_pelanggan');
    }
};

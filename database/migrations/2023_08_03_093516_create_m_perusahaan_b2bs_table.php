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
        Schema::create('m_perusahaan_b2b', function (Blueprint $table) {
            $table->bigIncrements('ID_PERUSAHAAN');
            $table->string('NAMA_PERUSAHAAN', 100);
            $table->string('ALAMAT_PERUSAHAAN', 500);
            $table->string('NO_TELP_PERUSAHAAN', 100);
            $table->string('NPWP_PERUSAHAAN', 100);
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
        Schema::dropIfExists('m_perusahaan_b2b');
    }
};

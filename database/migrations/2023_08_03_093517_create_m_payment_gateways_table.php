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
        Schema::create('m_payment_gateway', function (Blueprint $table) {
            $table->bigIncrements('ID_PAYMENT_GATEWAY');
            $table->enum('METODE_PEMBAYARAN', ['Bank Transfer', 'GoPay', 'OVO', 'Dana', 'ShopeePay']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_payment_gateway');
    }
};

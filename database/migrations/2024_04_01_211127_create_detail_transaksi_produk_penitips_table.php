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
        Schema::create('detail_transaksi_produk_penitips', function (Blueprint $table) {
            $table->string("id_transaksi")->nullable(false);
            $table->unsignedBigInteger("id_produk_penitip")->nullable(false);
            $table->timestamps();

            $table->foreign("id_transaksi")->on("transaksis")->references("id");
            $table->foreign("id_produk_penitip")->on("produk_penitips")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi_produk_penitips');
    }
};

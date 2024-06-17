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
        // isinhya adalah id_transaksi, id_produk, id_hampers
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->unsignedBigInteger("id_transaksi")->nullable(false);
            $table->unsignedBigInteger("id_produk")->nullable(true);
            $table->unsignedBigInteger("id_produk_penitip")->nullable(true);
            $table->unsignedBigInteger("id_hampers")->nullable(true);
            $table->timestamps();

            $table->foreign("id_transaksi")->on("transaksis")->references("id");
            $table->foreign("id_produk")->on("produks")->references("id");
            $table->foreign("id_produk_penitip")->on("produk_penitips")->references("id");
            $table->foreign("id_hampers")->on("hampers")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi_produk_penitip');
    }
};

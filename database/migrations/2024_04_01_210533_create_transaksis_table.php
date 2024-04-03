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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->string("id")->primary();
            $table->date("tanggal_transaksi")->nullable(false);
            $table->double("harga_total")->nullable(false);
            $table->string("metode_pembayaran")->nullable(false);
            $table->string("status_pembayaran")->nullable(false);
            $table->string("status_pengiriman")->nullable(false);
            $table->string("jenis_pengiriman")->nullable(false);
            $table->double("tip")->nullable(true);
            $table->unsignedBigInteger("id_user")->nullable(false);
            $table->unsignedBigInteger("id_customer")->nullable(false);
            $table->unsignedBigInteger("id_packaging")->nullable(false);
            $table->timestamps();

            $table->foreign("id_user")->on("users")->references("id");
            $table->foreign("id_customer")->on("customers")->references("id");
            $table->foreign("id_packaging")->on("packagings")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

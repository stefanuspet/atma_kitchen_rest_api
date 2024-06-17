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
        Schema::create('detail_transaksi_hampers', function (Blueprint $table) {
            $table->unsignedBigInteger("id_transaksi")->nullable(false);
            $table->unsignedBigInteger("id_hampers")->nullable(false);
            $table->timestamps();

            $table->foreign("id_transaksi")->on("transaksis")->references("id");
            $table->foreign("id_hampers")->on("hampers")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi_hampers');
    }
};

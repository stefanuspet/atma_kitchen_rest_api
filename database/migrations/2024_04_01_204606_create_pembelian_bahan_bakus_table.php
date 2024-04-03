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
        Schema::create('pembelian_bahan_bakus', function (Blueprint $table) {
            $table->unsignedBigInteger("id_user")->nullable(false);
            $table->unsignedBigInteger("id_produk")->nullable(false);
            $table->timestamps();

            $table->foreign("id_user")->on("users")->references("id");
            $table->foreign("id_produk")->on("produks")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_bahan_bakus');
    }
};

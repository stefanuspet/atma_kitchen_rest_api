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
        Schema::create('produk_penitips', function (Blueprint $table) {
            $table->id();
            $table->string("nama_produk_penitip")->nullable(false);
            $table->double("harga_produk_penitip")->nullable(false);
            $table->integer("stok_produk_penitip")->nullable(false);
            $table->string("gambar_produk_penitip")->nullable(false);
            $table->unsignedBigInteger("id_penitip")->nullable(false);
            $table->unsignedBigInteger("id_user")->nullable(false);
            $table->timestamps();

            $table->foreign("id_penitip")->on("penitips")->references("id");
            $table->foreign("id_user")->on("users")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_penitips');
    }
};

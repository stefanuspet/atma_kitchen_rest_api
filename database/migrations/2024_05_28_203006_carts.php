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
        Schema::create("carts", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_customer")->nullable(false);
            $table->unsignedBigInteger("id_produk")->nullable(true);
            $table->unsignedBigInteger("id_hampers")->nullable(true);
            $table->unsignedBigInteger("id_produk_penitip")->nullable(true);
            $table->integer("jumlah_produk")->nullable(false);
            $table->string("loyang")->nullable(true);
            $table->integer("total")->nullable(false);
            $table->timestamps();

            $table->foreign("id_customer")->on("customers")->references("id");
            $table->foreign("id_produk")->on("produks")->references("id");
            $table->foreign("id_hampers")->on("hampers")->references("id");
            $table->foreign("id_produk_penitip")->on("produk_penitips")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("carts");
    }
};

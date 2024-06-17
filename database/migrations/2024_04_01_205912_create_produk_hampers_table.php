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
        Schema::create('hampers_produk', function (Blueprint $table) {
            // $table->unsignedBigInteger("id_produk")->nullable(false);
            // $table->unsignedBigInteger("id_hampers")->nullable(false);
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('hampers_id');
            // $table->integer("stok_hampers")->nullable(false);
            $table->timestamps();

            // $table->foreign("id_produk")->on("produks")->references("id");
            // $table->foreign("id_hampers")->on("hampers")->references("id");
            $table->primary(['produk_id', 'hampers_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hampers_produk');
    }
};

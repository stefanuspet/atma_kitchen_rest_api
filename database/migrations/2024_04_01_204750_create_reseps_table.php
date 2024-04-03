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
        Schema::create('reseps', function (Blueprint $table) {
            $table->unsignedBigInteger("id_produk")->nullable(false);
            $table->unsignedBigInteger("id_bahan_baku")->nullable(false);
            $table->timestamps();

            $table->foreign("id_produk")->on("produks")->references("id");
            $table->foreign("id_bahan_baku")->on("bahan_bakus")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseps');
    }
};

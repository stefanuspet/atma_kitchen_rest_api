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
        Schema::create('packagings', function (Blueprint $table) {
            $table->id();
            $table->string("ukuran")->nullable(false);
            $table->unsignedBigInteger("id_produk")->nullable(false);
            $table->unsignedBigInteger("id_hampers")->nullable(false);
            $table->timestamps();

            $table->foreign("id_produk")->on("produks")->references("id");
            $table->foreign("id_hampers")->on("hampers")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packagings');
    }
};

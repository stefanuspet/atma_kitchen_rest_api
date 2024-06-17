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
        Schema::create('hampers', function (Blueprint $table) {
            $table->id();
            $table->string("nama_hampers")->nullable(false);
            $table->double("harga_hampers")->nullable(false);
            $table->string("deskripsi_hampers")->nullable(false);
            $table->date("tanggal_pembuatan_hampers")->nullable(false);
            $table->integer("stok_hampers")->nullable(false);
            $table->unsignedBigInteger("id_user")->nullable(false);
            $table->timestamps();

            $table->foreign("id_user")->on("users")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hampers');
    }
};

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
        Schema::create('konfirmasi_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('daftar_pesanan');
            $table->decimal('jumlah_pesanan', 10, 2);
            $table->boolean('konfirmasi')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfirmasi_pembayarans');
    }
};

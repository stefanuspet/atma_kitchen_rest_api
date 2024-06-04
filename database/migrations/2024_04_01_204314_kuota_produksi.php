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
        Schema::create('kuota_produksis', function (Blueprint $table) {
            $table->id();
            $table->string('max_produksi')->nullable(false);
            $table->date('tanggal')->nullable(false);
            $table->foreignId('id_produk')->constrained('produks');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuota_produksis');
    }
};

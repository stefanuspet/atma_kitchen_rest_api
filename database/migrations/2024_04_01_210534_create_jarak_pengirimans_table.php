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
        // Schema::create('jarak_pengirimans', function (Blueprint $table) {
        //     $table->id();
        //     $table->float('jarak')->nullable(false);
        //     $table->integer('harga')->nullable(false);
        //     $table->integer('waktu')->nullable(false);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jarak_pengirimans');
    }
};

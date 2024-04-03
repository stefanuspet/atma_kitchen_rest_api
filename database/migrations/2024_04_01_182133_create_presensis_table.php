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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->date("tanggal_presensi")->nullable(false);
            $table->string("Status", 20)->nullable(false);
            $table->unsignedBigInteger("id_karyawan")->nullable(false);
            $table->timestamps();

            $table->foreign("id_karyawan")->on("karyawans")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};

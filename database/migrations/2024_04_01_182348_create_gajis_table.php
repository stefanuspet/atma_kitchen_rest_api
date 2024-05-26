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
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->integer("honor_harian")->nullable(false);
            $table->integer("bonus")->nullable(true);
            $table->unsignedBigInteger("id_user")->nullable(false);
            $table->unsignedBigInteger("id_karyawan")->nullable(false);
            $table->timestamps();

            $table->foreign("id_user")->on("users")->references("id");
            $table->foreign("id_karyawan")->on("karyawans")->references("id")->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gajis');
    }
};

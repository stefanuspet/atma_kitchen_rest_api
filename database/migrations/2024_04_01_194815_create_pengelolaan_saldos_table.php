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
        Schema::create('pengelolaan_saldos', function (Blueprint $table) {
            $table->unsignedBigInteger("id_saldo")->nullable(false);
            $table->unsignedBigInteger("id_user")->nullable(false);
            $table->timestamps();

            $table->foreign("id_saldo")->on("saldos")->references("id");
            $table->foreign("id_user")->on("users")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengelolaan_saldos');
    }
};

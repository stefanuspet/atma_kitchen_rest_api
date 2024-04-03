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
        Schema::create('poins', function (Blueprint $table) {
            $table->id();
            $table->integer("jumlah_poin")->nullable(false);
            $table->unsignedBigInteger("id_customer")->nullable(false);
            $table->timestamps();


            $table->foreign("id_customer")->on("customers")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poins');
    }
};

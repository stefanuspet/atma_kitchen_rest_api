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
        Schema::create('alamats', function (Blueprint $table) {
            $table->id();
            $table->string("kota", 50)->nullable(false);
            $table->integer("kodepos")->nullable(false);
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
        Schema::dropIfExists('alamats');
    }
};

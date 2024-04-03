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
        Schema::create('penitips', function (Blueprint $table) {
            $table->id();
            $table->string("nama_penitip")->nullable(false)->unique("penitips_nama_unique");
            $table->string("email_penitip", 100)->nullable(false)->unique("penitips_email_unique");
            $table->string("notelp_penitip", 14)->nullable(false)->unique("penitips_notelp_unique");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penitips');
    }
};

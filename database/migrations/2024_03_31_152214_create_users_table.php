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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("nama_user", 100)->nullable(false);
            $table->string("email_user", 100)->nullable(false)->unique("users_email_unique");
            $table->string("notelp_user", 14)->nullable(false);
            $table->string("password_user", 200)->nullable(false);
            $table->unsignedBigInteger("id_jabatan")->nullable(false);
            $table->timestamps();


            $table->foreign("id_jabatan")->on("jabatans")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

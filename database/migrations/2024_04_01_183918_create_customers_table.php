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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("nama_customer", 100)->nullable(false)->unique("users_username_unique");
            $table->string("email_customer", 100)->nullable(false)->unique("users_email_unique");
            $table->string("notelp_customer", 14)->nullable(false)->unique("users_notelp_unique");
            $table->string("password_customer", 200)->nullable(false)->unique("users_password_unique");
            $table->string("token_customer", 100)->nullable(false)->unique("users_token_unique");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

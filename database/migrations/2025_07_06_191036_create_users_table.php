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
        // database/migrations/xxxx_xx_xx_create_users_table.php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->foreignId('client_id')->constrained()->onDelete('cascade'); // entreprise
    $table->string('name');
    $table->string('function');
    $table->string('email')->unique();
    $table->string('password');
    $table->timestamps();
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

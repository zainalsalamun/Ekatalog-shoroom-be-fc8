<?php

use App\Models\Role;
use App\Models\Showroom;
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
        Schema::create('pengguna', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->dateTime('verifikasi_email')->nullable();
            $table->string('password');
            $table->unsignedSmallInteger('stat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};

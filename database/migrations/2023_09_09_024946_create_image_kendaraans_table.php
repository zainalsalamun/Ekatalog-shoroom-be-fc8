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
        Schema::create('image_kendaraan', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('id_kendaraan');
            $table->string('image');
            $table->enum('cover', ['true', 'false']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_kendaraans');
    }
};

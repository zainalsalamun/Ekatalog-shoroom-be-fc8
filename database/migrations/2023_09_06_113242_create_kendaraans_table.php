<?php

use App\Models\BahanBakar;
use App\Models\Jenis;
use App\Models\Kondisi;
use App\Models\Merek;
use App\Models\Pengguna;
use App\Models\Showroom;
use App\Models\TipeBodi;
use App\Models\TipeRodaPenggerak;
use App\Models\Transmisi;
use App\Models\Warna;
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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('id_user');
            $table->uuid('id_showroom');
            $table->uuid('id_jenis');
            $table->uuid('id_kondisi');
            $table->uuid('id_merek');
            $table->uuid('id_transmisi');
            $table->uuid('id_tipe_bodi');
            $table->uuid('id_warna');
            $table->uuid('id_bahan_bakar');
            $table->uuid('id_tipe_roda_penggerak');
            $table->string('nama');
            $table->text('slug');
            $table->unsignedInteger('penumpang');
            $table->unsignedInteger('pintu');
            $table->double('km');
            $table->unsignedInteger('tahun');
            $table->unsignedInteger('harga');
            $table->unsignedSmallInteger('stat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};

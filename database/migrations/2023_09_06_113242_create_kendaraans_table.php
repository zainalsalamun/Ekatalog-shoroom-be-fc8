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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignIdFor(Showroom::class, 'id_showroom');
            $table->foreignIdFor(Jenis::class, 'id_jenis');
            $table->foreignIdFor(Kondisi::class, 'id_kondisi');
            $table->foreignIdFor(Merek::class, 'id_merek');
            $table->foreignIdFor(Transmisi::class, 'id_transmisi');
            $table->foreignIdFor(TipeBodi::class, 'id_tipe_bodi');
            $table->foreignIdFor(Warna::class, 'id_warna');
            $table->foreignIdFor(BahanBakar::class, 'id_bahan_bakar');
            $table->foreignIdFor(TipeRodaPenggerak::class, 'id_tipe_roda_penggerak');
            $table->unsignedInteger('penumpang');
            $table->unsignedInteger('pintu');
            $table->double('km');
            $table->unsignedInteger('tahun');
            $table->unsignedInteger('harga');
            $table->foreignIdFor(Pengguna::class, 'id_pengguna');
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

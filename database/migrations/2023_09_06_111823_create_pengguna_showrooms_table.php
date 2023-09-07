<?php

use App\Models\Pengguna;
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
        Schema::create('pengguna_showroom', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pengguna::class, 'id_pengguna');
            $table->foreignIdFor(Showroom::class, 'id_showroom');
            $table->foreignIdFor(Role::class, 'id_role');
            $table->unsignedSmallInteger('stat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna_showroom');
    }
};

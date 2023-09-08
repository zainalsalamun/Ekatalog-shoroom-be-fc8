<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TipeRodaPenggerak;
use App\Models\Transmisi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            BahanBakarSeeder::class,
            JenisSeeder::class,
            KondisiSeeder::class,
            MerekSeeder::class,
            RoleSeeder::class,
            TipeBodiSeeder::class,
            TipeRodaPenggerakSeeder::class,
            TransmisiSeeder::class,
            WarnaSeeder::class
        ]);
    }
}

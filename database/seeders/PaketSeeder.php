<?php

namespace Database\Seeders;

use App\Models\Paket;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paket = [
            ['nama' => 'Free', 'harga' => 0, 'stat' => 1],
            ['nama' => 'Basic', 'harga' => 25000, 'stat' => 1],
            ['nama' => 'Silver', 'harga' => 50000, 'stat' => 1],
        ];

        foreach ($paket as $row) {
            Paket::create([
                'nama' => $row['nama'],
                'harga' => $row['harga'],
                'stat' => 1
            ]);
        }
    }
}

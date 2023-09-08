<?php

namespace Database\Seeders;

use App\Models\BahanBakar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BahanBakarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bahan_bakar = [
            'Pertamax',
            'Solar',
            'Electric',
            'Petrol Unleaded',
            'Diesel',
            'Premium',
            'Petrol - Leaded',
            'CNG',
            'Lainnya'
        ];
        foreach ($bahan_bakar as $row) {
            BahanBakar::create([
                'nama' => $row,
                'stat' => 1
            ]);
        }
    }
}

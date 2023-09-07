<?php

namespace Database\Seeders;

use App\Models\TipeRodaPenggerak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeRodaPenggerakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipe_roda_penggerak = [
            'FWD (Front Wheel Drvie)',
            'RWD (Rear Wheel Drive)',
            'AWD (All Wheel Drive)',
            '4WD (4 Wheel Drive)',
            '4WD Dual Range',
            'Lainnya'
        ];

        foreach($tipe_roda_penggerak as $row){
            TipeRodaPenggerak::create([
                'nama' => $row,
                'stat' => 1
            ]);
        }
    }
}

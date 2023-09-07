<?php

namespace Database\Seeders;

use App\Models\TipeBodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeBodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipe_body = [
            'SUV',
            'MPV',
            'Harchack',
            'Sedan',
            'Wagon',
            'Coupe',
            'Van Wagon',
            'Pick-up',
            'Convertible',
            'Van',
            'Truck',
            'MPV Minivans',
            'Jeep',
            'Fastback',
            'Gran Coupe',
            'Cabriolet',
            'Sportback',
            'Minibus',
            'SUV Offroad 4WD',
            'Classic Cars',
            'Compact Car City Car',
            'Convertibles Roadsters',
            'Double Cabin',
            'Lainnya'
        ];
        foreach($tipe_body as $row){
            TipeBodi::create([
                'nama' => $row,
                'stat' => 1
            ]);
        }
    }
}

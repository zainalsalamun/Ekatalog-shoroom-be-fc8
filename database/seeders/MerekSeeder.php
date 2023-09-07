<?php

namespace Database\Seeders;

use App\Models\Merek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merek = [
            'BMW', 
            'Daihatsu', 
            'Honda',
            'Hyundai',
            'Mercedes-Benz',
            'Mitsubishi',
            'Suzuki',
            'Toyota',
            'Abarth',
            'Aston Martin',
            'Audi',
            'Bentley',
            'Cadillac',
            'Chery',
            'Chevrolet',
            'Datsun',
            'DFSK',
            'Dodge',
            'Ferrari',
            'Fiat',
            'Ford',
            'Hino',
            'Hummer',
            'Infiniti',
            'Isuzu',
            'Jaguar',
            'Jeep',
            'KIA',
            'Lamborghini',
            'Land Rover',
            'Lexus',
            'Maserati',
            'Mazda',
            'MG',
            'MINI',
            'Nissan',
            'Opel',
            'Peugeot',
            'Porsche',
            'Proton',
            'Renault',
            'Rolls-Royce',
            'Smart',
            'Subaru',
            'Tata',
            'Tesla',
            'Timor',
            'UD TRUCKS',
            'Volkswagen',
            'Volvo',
            'Wuling',
            'Lainnya'
        ];

        foreach($merek as $row){
            Merek::create([
                'nama' => $row,
                'stat' => 1
            ]);
        }
    }
}

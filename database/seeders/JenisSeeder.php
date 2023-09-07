<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            'Motor', 'Mobil'
        ];
        foreach($jenis as $row)
        {
            Jenis::create([
                'nama'=> $row,
                'stat' => 1
            ]);
        }
    }
}

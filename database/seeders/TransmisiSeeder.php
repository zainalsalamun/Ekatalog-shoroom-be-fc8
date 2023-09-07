<?php

namespace Database\Seeders;

use App\Models\Transmisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransmisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transmisi = [
            'Automatic', 'Manual'
        ];
        foreach($transmisi as $row){
            Transmisi::create([
                'nama' => $row,
                'stat' => 1
            ]);
        }
    }
}

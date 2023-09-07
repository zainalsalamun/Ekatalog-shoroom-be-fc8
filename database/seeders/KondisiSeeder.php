<?php

namespace Database\Seeders;

use App\Models\Kondisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KondisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kondisi = [
            'Baru', 'Bekas'
        ];

        foreach($kondisi as $row){
            Kondisi::Create([
                'nama'=> $row,
                'stat' => 1
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Warna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarnaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warna =[
            'Hitam' => '#000000',
            'Putih' => '#FFFFFF',
            'Abu-abu' =>'#808080',
            'Silver' => '#C0C0C0',
            'Merah' => '#FF0000',
            'Biru' => '#0000FF',
            'Coklat' => '#A52A2A',
            'Kuning' => '#FFFF00',
            'Orange' => '#FFA500', 
            'Hijau' => '#00FF00',
            'Marun' => '#800000',
            'Ungu' => '#800080',
            'Emas' => '#FFD700',
            'Lainnya' => ''
        ];
        foreach($warna as $key => $val){
            Warna::create([
                'nama' => $key,
                'kode_warna' => $val,
                'stat' => 1
            ]);
        }
    }
}

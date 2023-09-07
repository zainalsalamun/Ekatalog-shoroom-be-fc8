<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            'admin', 'owner', 'pegawai', 'user'
        ];
        foreach($role as $row){
            Role::create([
                'nama' => $row,
                'stat' => 1
            ]);
        }
    }
}

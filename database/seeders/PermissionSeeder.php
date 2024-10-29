<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $statuses = [
            ['name' => 'Adminisztrátor'],
            ['name' => 'Operátor'],
            ['name' => 'Felhasználó'],
            
        ];

        DB::table('permissions')->insert($statuses);
    }
}

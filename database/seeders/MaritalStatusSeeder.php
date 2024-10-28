<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Egyedülálló'],
            ['name' => 'Házas'],
            ['name' => 'Párkapcsolatban'],
            ['name' => 'Bonyolult'],
            ['name' => 'Elvált'],
            ['name' => 'Özvegy']
        ];

        DB::table('marital_statuses')->insert($statuses);
    }
}

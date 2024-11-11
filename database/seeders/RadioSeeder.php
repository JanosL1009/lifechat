<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RadioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('radios')->insert([
            [
                'radioName' => 'Rádió 1',
                'radioURL' => 'https://icast.connectmedia.hu/5201/live.mp3',
                'radioStatus' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'radioName' => 'Laza Rádió',
                'radioURL' => 'https://stream.lazaradio.com/live.mp3',
                'radioStatus' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 *  Schema::create('ban_modes', function (Blueprint $table) {
        *    $table->id();
       *     $table->integer('bantime');
       *     $table->integer('ban_name');
        *    $table->timestamps();
       * });
 */
class BanModes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ban_modes')->insert([
            [
                'bantime' => '120', //sec
                'ban_name' => '2 perc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
               'bantime' => '300',
                'ban_name' => '5 perc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'bantime' => '600',
                 'ban_name' => '10 perc',
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                'bantime' => '900',
                 'ban_name' => '15 perc',
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                'bantime' => '1800',
                 'ban_name' => '30 perc',
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
             [
                'bantime' => '3600',
                 'ban_name' => '60 perc',
                 'created_at' => now(),
                 'updated_at' => now(),
             ],

             [
                'bantime' => '3600',
                 'ban_name' => '60 perc',
                 'created_at' => now(),
                 'updated_at' => now(),
             ],

             [
                'bantime' => '86400',
                 'ban_name' => '1 nap',
                 'created_at' => now(),
                 'updated_at' => now(),
             ],
        ]);
    }
}

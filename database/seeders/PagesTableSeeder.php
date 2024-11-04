<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->insert([
            [
                'name' => 'Általános Szerződési Feltételek',
                'slug' => 'altalanos-szerzodesi-feltetelek',
                'content' => '<p>Ez egy minta tartalom az Általános Szerződési Feltételekhez.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adatvédelmi Tájékoztató',
                'slug' => 'adatvedelmi-tajekoztato',
                'content' => '<p>Ez a Privacy Policy minta tartalma.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

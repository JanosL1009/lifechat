<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
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
      /*  $statuses = [
            ['name' => 'Egyedülálló'],
            ['name' => 'Házas'],
            ['name' => 'Párkapcsolatban'],
            ['name' => 'Bonyolult'],
            ['name' => 'Elvált'],
            ['name' => 'Özvegy']
        ];*/
        $one = new MaritalStatus();
        $one-> name = 'Egyedülálló';
        $one->save();

       
    }
}

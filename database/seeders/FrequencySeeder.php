<?php

namespace Database\Seeders;

use App\Models\Frequency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('frequencies')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Frequency::create([
            'id' => 1,
            'name' => 'Diario',
            'days' => 1
        ]);

        Frequency::create([
            'id' => 2,
            'name' => 'Semanal',
            'days' => 7
        ]);

        Frequency::create([
            'id' => 3,
            'name' => 'Quincenal',
            'days' => 15
        ]);

        Frequency::create([
            'id' => 4,
            'name' => 'Mensual',
            'days' => 30
        ]);
    }
}

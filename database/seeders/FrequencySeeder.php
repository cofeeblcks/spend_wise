<?php

namespace Database\Seeders;

use App\Models\Frequency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Frequency::create([
            'name' => 'Diario',
            'days' => 1
        ]);

        Frequency::create([
            'name' => 'Semanal',
            'days' => 7
        ]);

        Frequency::create([
            'name' => 'Quincenal',
            'days' => 15
        ]);

        Frequency::create([
            'name' => 'Mensual',
            'days' => 30
        ]);
    }
}

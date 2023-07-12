<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventType;

class EventTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventType::create([
            'name' => 'Importante',
            'color' => '#7aeb34',
        ]);

        EventType::create([
            'name' => 'Normal',
            'color' => '#3a37eb',
        ]);

        EventType::create([
            'name' => 'Nota',
            'color' => '#ff8000',
        ]);
    }
}

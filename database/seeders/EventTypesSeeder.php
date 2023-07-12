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
        ]);

        EventType::create([
            'name' => 'Normal',
        ]);

        EventType::create([
            'name' => 'Nota',
        ]);
    }
}

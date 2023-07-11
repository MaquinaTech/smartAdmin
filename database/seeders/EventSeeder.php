<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;


class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //'name', 'color', 'border_color', 'title'
        Event::create([
            'name' => 'Vacaciones',
            'title' => 'Vacaciones de verano',
            'color' => '#7aeb34',
            'border_color' => '#343deb',
        ]);

    }
}

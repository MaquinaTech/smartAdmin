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
        Event::create([
            'name' => 'Vacaciones',
            'title' => 'Vacaciones de verano',
            'color' => '#7aeb34',
            'border_color' => '#343deb',
            'start' => '2021-07-11 16:56:44',
            'end' => '2023-08-11 16:00:00',
        ]);

        Event::create([
            'name' => 'Cumpleaños',
            'title' => 'Cumpleaños tio Tom',
            'color' => '#ececec',
            'border_color' => '#FFFFFF',
            'start' => '2021-07-21 16:56:44',
            'end' => '2023-08-25 16:00:00',
        ]);

    }
}

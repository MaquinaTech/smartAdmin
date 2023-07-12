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
            'start' => '2023-07-11 16:56:44',
            'end' => '2023-08-11 16:00:00',
            'event_type_id' => '1',
        ]);

        Event::create([
            'name' => 'Cumpleaños',
            'title' => 'Cumpleaños tio Tom',
            'start' => '2023-07-20 14:56:44',
            'end' => '2023-07-21 16:00:00',
            'event_type_id' => '2',
        ]);

    }
}

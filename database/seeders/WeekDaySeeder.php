<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeekDay;
class WeekDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weekdays = [
            [
              'title' => 'monday',
              'position' => '1',

            ],
            [
              'title' => 'tuesday',
                 'position' => '2',
            ],
            [
               'title' => 'wednesday',
                  'position' => '3',
            ],
            [
               'title' => 'thursday',
                  'position' => '4',
            ],
            [
              'title' => 'friday',
                 'position' => '5',
            ],
            [
               'title' => 'saturday',
                  'position' => '6',
            ],
            [
               'title' => 'sunday',
                  'position' => '7',
            ]
        ];
        foreach ($weekdays as $weekday) {
            WeekDay::create($weekday);
        }
    }
}

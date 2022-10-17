<?php

namespace Tests\Stubs\Models\Bo\RaceCards;

class TodaysTrainers extends \Tests\Stubs\Models\HorseRace
{
    /**
     * @return array
     */
    public function getTodaysTrainers()
    {
        return [
            \Api\Row\Results\Horse::createFromArray(
                [
                    'trainer_name' => 'MICHAEL APPLEBY',
                    'trainer_uid' => 10363,
                    'style_name' => 'Michael Appleby',
                    'trainer_courses' => 'KM3 WO2',
                    'wins' => 1,
                    'places' => 4,
                    'runs' => 24,
                    'days_since_win_flat' => '13',
                    'rides_since_win_flat' => '16',
                    'days_since_win_jump' => '57',
                    'rides_since_win_jump' => '5',
                ]
            )
        ];
    }
}

<?php

namespace Tests\Stubs\Models\Bo\RaceCards;

class TodaysJockeys extends \Tests\Stubs\Models\HorseRace
{
    /**
     * @return array
     */
    public function getTodaysJockeys()
    {
        return [
            \Api\Row\Results\Horse::createFromArray(
                [
                    'jockey_type' => 0,
                    'style_name' => 'Leighton Aspell',
                    'jockey_uid' => 11611,
                    'jockey_low_wt_st' => 10,
                    'jockey_low_wt_lb' => 1,
                    'jockey_courses' => ' PL2',
                    'wins' => 19,
                    'runs' => 163,
                    'strike_rate' => 12,
                    'days_since_win' => '2',
                    'rides_since_win' => '5',
                ]
            )
        ];
    }
}

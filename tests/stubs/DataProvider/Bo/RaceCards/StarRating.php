<?php

namespace Tests\Stubs\DataProvider\Bo\RaceCards;

class StarRating extends \Tests\Stubs\Models\HorseRace
{
    /**
     * @return array
     */
    public function getData()
    {
        return [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'start_number' => 1,
                    'horse_uid' => 1444076,
                    'horse_name' => 'Branscombe',
                    'non_runner' => null,
                    'star_rating' => null,
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'start_number' => 4,
                    'horse_uid' => 1428792,
                    'horse_name' => 'Fortunate Vision',
                    'non_runner' => 'Y',
                    'star_rating' => null,
                ]
            ),
        ];
    }
}

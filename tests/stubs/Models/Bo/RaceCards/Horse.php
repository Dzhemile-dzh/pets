<?php

namespace Tests\Stubs\Models\Bo\RaceCards;

class Horse extends \Tests\Stubs\Models\Horse
{

    /**
     * @param $raceId
     *
     * @return array
     * @throws \Exception
     */
    public function getHorseIdsForStatistics($raceId)
    {
        $data = [
            614973 => [305368, 453211, 732139, 762012, 788155, 813920, 819143, 835508, 841381, 843792, 845533]
        ];

        return $data[$raceId];
    }

    public function getLongHandicap($raceId)
    {
        return array (
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(array(
                'horse_uid' => 737133,
                'style_name' => 'Valmina',
                'weight_carried_lbs' => 116,
                'weights_raised_lbs' => null,
                'extra_weight_lbs' => 0,
                'saddle_cloth_no' => 21,
                'horse_age' => 6,
                'minimum_weight_lbs' => 117,
                'three_yo_min_weight_lbs' => 112,
            ))
        );
    }
}

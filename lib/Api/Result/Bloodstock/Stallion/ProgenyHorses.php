<?php

namespace Api\Result\Bloodstock\Stallion;

class ProgenyHorses extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'progeny_horses' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyHorses',
            'season_info' => 'Api\Output\Mapper\SeasonInfo\StallionHorsesSeasonInfo'
        ];
    }
}

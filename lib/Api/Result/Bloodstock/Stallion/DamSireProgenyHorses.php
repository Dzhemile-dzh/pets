<?php

namespace Api\Result\Bloodstock\Stallion;

use Api\Result\Json as Result;

/**
 * Class DamSireProgenyHorses
 *
 * @package Api\Result\Bloodstock\Stallion
 */
class DamSireProgenyHorses extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'dam_sire_progeny_horses' => 'Api\Output\Mapper\Bloodstock\Stallion\DamSireProgenyHorses',
            'season_info' => 'Api\Output\Mapper\SeasonInfo\StallionHorsesSeasonInfo'
        ];
    }
}

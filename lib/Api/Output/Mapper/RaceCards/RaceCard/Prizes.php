<?php

namespace Api\Output\Mapper\RaceCards\RaceCard;

/**
 * Class Prizes
 *
 * @package Api\Output\Mapper\RaceCards\RaceCard
 */
class Prizes extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'position_no' => 'position_no',
            'prize_sterling' => 'prize_sterling',
            'prize_euro' => 'prize_euro',
            'prize_usd' => 'prize_usd'
        ];
    }
}

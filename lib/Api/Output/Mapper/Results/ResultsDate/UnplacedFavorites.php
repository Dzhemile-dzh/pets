<?php

namespace Api\Output\Mapper\Results\ResultsDate;

class UnplacedFavorites extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,country_origin_code' => 'horse_name',
            'odds_desc' => 'odds_desc',
        ];
    }
}

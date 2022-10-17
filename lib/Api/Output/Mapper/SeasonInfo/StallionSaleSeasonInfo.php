<?php

namespace Api\Output\Mapper\SeasonInfo;

class StallionSaleSeasonInfo extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            'countryFlag' => 'country_flag',
        ];
    }
}

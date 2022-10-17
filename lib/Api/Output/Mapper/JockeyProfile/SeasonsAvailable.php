<?php

namespace Api\Output\Mapper\JockeyProfile;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class SeasonsAvailable
 * @package Api\Output\Mapper\JockeyProfile
 */
class SeasonsAvailable extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'season_type' => 'season_type',
            '(dateISO8601)season_start_date' => 'season_start_date',
            '(dateISO8601)season_end_date' => 'season_end_date',
            'season_desc' => 'season_desc',
            '(trim)country_code' => 'country_code',
        ];
    }
}

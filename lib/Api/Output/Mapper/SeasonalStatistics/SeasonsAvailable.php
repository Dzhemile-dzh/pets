<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 4/10/2017
 * Time: 5:23 PM
 */

namespace Api\Output\Mapper\SeasonalStatistics;

use Api\Output\Mapper\HorsesMapper;

class SeasonsAvailable extends HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'season_uid' => 'season_uid',
            '(dateISO8601)season_start_date' => 'season_start_date',
            '(dateISO8601)season_end_date' => 'season_end_date',
            'season_type_code' => 'season_type_code',
            'season_desc' => 'season_desc',
            '(dbYNFlagToBoolean)is_active' => 'active',
            'flat_or_jump_flag' => 'flat_jumps_type',
            'country_code' => 'country_code',
        ];
    }
}

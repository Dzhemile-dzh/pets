<?php

namespace Api\Output\Mapper\Meetings;

use Api\Methods\NullifyEmptyValue;
use Api\Output\Mapper\HorsesMapper;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class Races
 * @package Api\Output\Mapper\Meetings
 */
class Races extends HorsesMapper
{
    use LegacyDecorators;
    use NullifyEmptyValue;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_status_code' => 'currentRaceStatus',
            '(convertToString)race_instance_uid' => 'raceId',
            '(convertToString)fast_race_instance_uid' => 'fastRaceId',
            'race_instance_title' => 'raceTitle',
            'race_type_desc' => 'raceType',
            'is_handicap' => 'isHandicap',
            'going_type_desc' => 'going',
            'surface' => 'surfaceType',
            'category' => 'category',
            'race_class' => 'raceClass',
            'rp_ages_allowed_desc' => 'ageRestriction',
            '(nullifyEmptyValue)no_of_runners' => 'numberOfRunners',
            '(trimAndNullifyString)official_rating_band_desc' => 'ratingBand',
            '(dateISO8601)race_datetime' => 'startScheduledDatetime.utc',
            '(localDateISO8601)race_datetime,hours_difference' => 'startScheduledDatetime.local',
            'distance' => 'distance',
            'bettingReturns' => 'bettingReturns',
            'replayDetails' => 'replayDetails',
            'tvDetails' => 'tvDetails',
            'perform_race_uid_atr' => 'performRaceUidATR',
            'perform_race_uid_ruk' => 'performRaceUidRUK'
        ];
    }
}

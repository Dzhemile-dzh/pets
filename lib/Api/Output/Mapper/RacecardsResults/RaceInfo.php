<?php

namespace Api\Output\Mapper\RacecardsResults;

use Api\Methods\NullifyEmptyValue;
use Api\Output\Mapper\HorsesMapper;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class RaceInfo
 * @package Api\Output\Mapper\RacecardsResults
 */
class RaceInfo extends HorsesMapper
{
    use LegacyDecorators;
    use NullifyEmptyValue;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(convertToString)race_instance_uid' => 'uid',
            'race_instance_title' => 'raceTitle',
            'course_uid' => 'venue.uid',
            'course_style_name' => 'venue.name',
            '(prepareToDiffusion)course_name' => 'venue.diffusionName',
            '(stringToURLkey)course_style_name' => 'venue.courseKey',
            '(dateISO8601)race_datetime' => 'startScheduledDatetimeUtc',
            '(localDateISO8601)race_datetime,hours_difference' => 'startScheduledDatetimeLocal',
            '(trimAndNullifyString)verdict' => 'verdict',
            'race_status_code' => 'currentRaceStatus',
            'race_type_desc' => 'raceType',
            'race_class' => 'raceClass',
            'surface' => 'surfaceType',
            'rp_ages_allowed_desc' => 'ageRestriction',
            'category' => 'category',
            '(nullifyEmptyValue)no_of_runners' => 'numberOfRunners',
            'going_type_desc' => 'going',
            '(removeAllExtraSymbols)weather_details' => 'weather',
            'distance' => 'distance',
            'replay_details' => 'replayDetails',
            '(trimAndNullifyString)official_rating_band_desc' => 'ratingBand',
            'max_runners' => 'maxNumberOfRunners',
            '(dateISO8601)race_start_datetime' => 'raceOffTime',
            'tv_details' => 'tvDetails',
            'perform_race_uid_atr' => 'performRaceUidATR',
            'perform_race_uid_ruk' => 'performRaceUidRUK',
            '(roundToTwoDecimalPoints)winners_time_secs' => 'winnersTimeSecs',
            '(roundToTwoDecimalPoints)diff_to_standard_time' => 'diffToStandardTime',
            '(roundToTwoDecimalPoints)winners_time_secs_furlongs' => 'winnersTimeSecsFurlongs',
            '(roundToTwoDecimalPoints)diff_to_standard_time_furlongs' => 'diffToStandardTimeFurlongs',
            '(roundToTwoDecimalPoints)pool_prize_sterling' => 'prizeTotal.GBP',
            'prizes' => 'prize',
            'each_way' => 'eachWayTerms',
            '(convertToString)total_sp' => 'totalStartingPrice',
            'bettingReturns' => 'bettingReturns',
            '(trimAndNullifyString)country_code' => 'countryCode',
            'description' => 'description',
            '(trimAndNullifyString)rp_analysis' => 'postRaceAnalysis',
            'runners' => 'runners'
        ];
    }
}

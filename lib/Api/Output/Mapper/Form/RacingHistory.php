<?php

namespace Api\Output\Mapper\Form;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class RacingHistory
 * @package Api\Output\Mapper\Form
 */
class RacingHistory extends HorsesMapper
{
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(convertToString)race_instance_uid' => 'raceId',
            'race_instance_title' => 'raceTitle',
            '(dateISO8601)race_datetime' => 'startScheduledDatetime.utc',
            '(localDateISO8601)race_datetime,hours_difference' => 'startScheduledDatetime.local',
            'race_status_code' => 'currentRaceStatus',
            'race_type_desc' => 'raceType',
            'actual_race_class' => 'raceClass',
            'surface' => 'surfaceType',
            'rp_ages_allowed_desc' => 'ageRestriction',
            'category' => 'category',
            'no_of_runners_calculated' => 'numberOfRunners',
            'going_type_desc' => 'going',
            'distance' => 'distance',
            'video_detail' => 'replayDetails',
            '(convertToString)horse_uid' => 'runner.uid',
            'saddle_cloth_no' => 'runner.saddleClothNumber',
            'rp_topspeed' => 'runner.topspeedRating',
            'rp_postmark' => 'runner.racingPostRating',
            'official_rating' => 'runner.rating.official',
            'official_rating_ran_off' => 'runner.rating.officialRanOff',
            '(trimAndNullifyString)rp_close_up_comment' => 'runner.closeUpComment',
            'odds_desc' => 'runner.startingPrice.fractional',
            'favourite_bool' => 'runner.startingPrice.favourite',
            'favourite_flag' => 'runner.startingPrice.favouriteType',
            'position' => 'runner.position',
            'weight_carried_lbs' => 'runner.weightCarried.lbs',
            'weight_carried_kg' => 'runner.weightCarried.kg',
            '(getDistanceToWinnerForm)dtw_sum_distance_value' => 'runner.distanceFromWinner.lengths',
            'dth_distance_value' => 'runner.distanceFromNextHorse.lengths',
            '(convertToString)jockey_jockey_uid' => 'runner.jockey.uid',
            'jockey_style_name' => 'runner.jockey.name',
            'weight_allowance_lbs' => 'runner.jockey.weightAllowance.lbs',
            'weight_allowance_kg' => 'runner.jockey.weightAllowance.kg',
            'other_horse' => 'runner.otherRunner',
            'meeting_uid' => 'meeting.id',
            'course_style_name' => 'meeting.name',
        ];
    }
}

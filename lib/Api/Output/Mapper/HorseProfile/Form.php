<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\HorseProfile;

use Api\Constants\Horses as Constants;
use \Api\Methods;

class Form extends \Api\Output\Mapper\HorsesMapper
{
    use Methods\RemoveDotFromAwCourse;
    use Methods\CloseUpComment;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'race_group_uid' => 'race_group_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(localDateISO8601)race_datetime,hours_difference' => 'local_meeting_race_datetime',
            'course_uid' => 'course_uid',
            'course_type_code' => 'course_type_code',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(trim)country_code' => 'country_code',
            'race_instance_title' => 'race_instance_title',
            'race_type_code' => 'race_type_code',
            '(mb_strtoupper)course_rp_abbrev_3' => 'course_rp_abbrev_3',
            '(mb_strtoupper)course_rp_abbrev_4' => 'course_rp_abbrev_4',
            'course_code' => 'course_code',
            '(getCourseComments)rp_flat_course_comment,rp_jump_course_comment' => 'course_comments',
            'going_type_services_desc' => 'going_type_services_desc',
            '(calculatePrizeSterling)prize_sterling,prize_euro_gross,exchange_rate' => 'prize_sterling',
            '(calculatePrizeEuro)prize_euro_gross' => 'prize_euro',
            'distance_yard' => 'distance_yard',
            '(getDistanceInFurlong)' => 'distance_furlong',
            'actual_race_class' => 'race_class',
            'rp_ages_allowed_desc' => 'ages_allowed_desc',
            'rp_betting_movements' => 'rp_betting_movements',
            'race_group_code' => 'race_group_code',
            'race_group_desc' => 'race_group_desc',
            'weight_carried_lbs' => 'weight_carried_lbs',
            'weight_allowance_lbs' => 'weight_allowance_lbs',
            '(getNoOfRunners)' => 'no_of_runners',
            '(prepareNonRunnerCloseUpComments)rp_close_up_comment,notes,non_runner' => 'rp_close_up_comment',
            'rp_horse_head_gear_code' => 'horse_head_gear',
            '(isFirstTimeHeadgear)' => 'first_time_headgear',
            'odds_desc' => 'odds_desc',
            'odds_value' => 'odds_value',
            'jockey_style_name' => 'jockey_style_name',
            'aka_style_name' => 'jockey_short_name',
            'jockey_jockey_uid' => 'jockey_uid',
            'jockey_ptp_type_code' => 'jockey_ptp_type_code',
            'official_rating_ran_off' => 'official_rating_ran_off',
            '(getTopSpeed)' => 'rp_topspeed',
            'rp_postmark' => 'rp_postmark',
            'video_detail' => 'video_detail',
            '(getRaceDescriptionForForm)' => 'race_description',
            '(getDistanceRunnerHorseToWinnerForm)non_runner' => 'distance_to_winner',
            '(getWinningDistance)' => 'winning_distance',
            'going_type_code' => 'going_type_code',
            '(trim)race_outcome_code' =>  'race_outcome_code',
            'other_horse' => 'other_horse',
            'disqualification_uid' => 'disqualification_uid',
            'disqualification_desc' => 'disqualification_desc',
            'rp_straight_round_jubilee_desc' => 'rp_straight_round_jubilee_desc',
            'draw' => 'draw',
            'race_tactics' => 'race_tactics'
        ];
    }

    /**
     * We are returning the commentary for the course based on it's type
     * if it is any kind of flat, we are returning for flat, and as there is no other option
     * but jump - we simply return jump.
     *
     * @param string|null $flatComment
     * @param string|null $jumpComment
     * @return string|null
     */
    public function getCourseComments(?string $flatComment, ?string $jumpComment)
    {
        if (!isset($this->race_type_code)) {
            return null;
        }

        if (in_array($this->race_type_code, Constants::RACE_TYPE_FLAT_ARRAY)) {
            return $flatComment;
        }
        return $jumpComment;
    }

    /**
     * If the country is Ireland we must take the prize in euro and calculate it
     * into pounds based on the current exchange rate so we can display it
     * in pounds alongside the euro prize.
     *
     * @param $sterlingGross
     * @param $euroGross
     * @param $exchangeRate
     * @return float|int
     */
    public function calculatePrizeSterling($sterlingGross, $euroGross, $exchangeRate)
    {
        if ($this->country_code == Constants::COUNTRY_IRE) {
            $exchangeRate = $exchangeRate == 0 ? 1 : $exchangeRate;
            $calculatedPrize = round($euroGross / $exchangeRate, 2);
            return $calculatedPrize;
        }
        return round($sterlingGross, 2);
    }

    /**
     * If the race is held in Ireland we return the prize in euro.
     *
     * @param $euroGross
     * @return float|int
     */
    public function calculatePrizeEuro($euroGross)
    {
        // The prize cannot be null but instead is 0.
        if (!isset($euroGross) || $this->country_code != Constants::COUNTRY_IRE) {
            return 0;
        }
        return round($euroGross, 2);
    }

    /**
     * Will return $rpCloseUpComment only, even if runner have notes, when he's non-runner
     * @param $rpCloseUpComment
     * @param $notes
     * @param $nonRunner
     * @return string|null
     */
    public function prepareNonRunnerCloseUpComments($rpCloseUpComment, $notes, $nonRunner)
    {
        $result = $rpCloseUpComment;
        if ($nonRunner === 'N') {
            $result = $this->getCloseUpComment($rpCloseUpComment, $notes);
        }

        return $result;
    }
}

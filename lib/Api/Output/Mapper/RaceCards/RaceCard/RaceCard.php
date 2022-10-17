<?php

namespace Api\Output\Mapper\RaceCards\RaceCard;

use \Api\Output\Mapper\Methods\LegacyDecorators;
use \Api\Constants\Horses as Constants;

/**
 * Class RaceCard
 *
 * @package Api\Output\Mapper\RaceCards\RaceCard
 */
class RaceCard extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Row\Methods\GetDistanceInFurlong;
    use \Api\Row\Methods\RaceCards\PopulateLivestreamField;
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_title' => 'race_instance_title',
            'race_number' => 'race_number',
            'rp_ages_allowed_desc' => 'rp_ages_allowed_desc',
            'race_class' => 'race_class',
            'race_group_code' => 'race_group_code',
            'official_rating_band_desc' => 'official_rating_band_desc',
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(localDateISO8601)race_datetime,hours_difference' => 'local_meeting_race_datetime',
            '(checkHorseAgeAndWeight)ages_allowed_uid,three_yo_min_weight_lbs' => 'three_yo_min_weight_lbs',
            '(checkHorseAgeAndWeight)ages_allowed_uid,three_yo_min_weight_lbs,"1"' => 'four_yo_min_weight_lbs',
            'minimum_weight_lbs' => 'minimum_weight_lbs',
            'declared_runners' => 'declared_runners',
            'no_of_runners' => 'no_of_runners',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'rp_tv_text' => 'rp_tv_text',
            'going_type_desc' => 'going_type_desc',
            '(nullIfStringEmpty)rp_penalties' => 'rp_penalties',
            'course_uid' => 'course_uid',
            'mixed_course_uid' => 'mixed_course_uid',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'small_map_image_path' => 'small_map_image_path',
            'large_map_image_path' => 'large_map_image_path',
            'rp_horse_types' => 'rp_horse_types',
            '(nullIfStringEmpty)rp_weights' => 'rp_weights',
            'allowances' => 'allowances',
            'entry_fee' => 'entry_fee',
            'extra_fee' => 'extra_fee',
            '(trim)country_code' => 'country_code',
            '(checkForeignRace)country_code' => 'foreign',
            'rp_stakes' => 'rp_stakes',
            'rp_ag_indicator' => 'rp_ag_indicator',
            'weights_raised_lbs' => 'weights_raised_lbs',
            'rp_auction_min' => 'rp_auction_min',
            'rp_claim_min' => 'rp_claim_min',
            'rp_confirmed' => 'rp_confirmed',
            'race_status_code' => 'race_status_code',
            'race_type_code' => 'race_type_code',
            'race_group_desc' => 'race_group_desc',
            '(trim)going_type_code' => 'going_type_code',
            'no_of_fences' => 'no_of_fences',
            'no_of_entries' => 'no_of_entries',
            'rp_stalls_position' => 'rp_stalls_position',
            'stalls_position_desc' => 'stalls_position_desc',
            'prizes' => 'prizes',
            'other_declarations' => 'other_declarations',
            'claiming_prices' => 'claiming_prices',
            'forfeits' => 'forfeits',
            'forfeit_number' => 'forfeit_number',
            'forfeit_value' => 'forfeit_value',
            'stage' => 'stage',
            'highest_official_rating' => 'highest_official_rating',
            'scoop6_race' => 'scoop6_race',
            'lucky7_race' => 'lucky7_race',
            'jackpot_race' => 'jackpot_race',
            'william_hill_offer_race' => 'william_hill_offer_race',
            'ladbrokes_offer_race' => 'ladbrokes_offer_race',
            'safety_factor_number' => 'safety_factor_number',
            '(dbYNFlagToBoolean)early_closing_race_yn' => 'early_closing_race',
            '(dbYNFlagToBoolean)reopened_yn' => 'reopened',
            'division_preference' => 'division_preference',
            '(compileLastYearStats)prev_year,prev_runners,prev_horse_name,prev_draw,prev_trainer,prev_horse_age,prev_weight_carried,prev_odds,prev_jockey,prev_w_allowance,prev_rating' => 'last_year',
            'perform_race_uid_atr' => 'perform_race_uid_atr',
            'perform_race_uid_ruk' => 'perform_race_uid_ruk',
            'bet_to_view' => 'bet_to_view',
            '(populateLivestreamField)lookup_uid,int_1' => 'livestream_uid',
            'aw_surface_type' => 'aw_surface_type',
            'straight_round_jubilee_code' => 'straight_round_jubilee_code',
            '(dbYNFlagToBoolean)live_tab' => 'live_tab',
            'claiming_race' => 'claiming_race',
            'selling_race' => 'selling_race',
            'plus10_race' => 'plus10_race',
            'weight_for_age' => 'weight_for_age',
        ];
    }

    /**
     * The last year stats field contains data from 11 fields in the database so we have to concatenate
     * all of them here and show them as a string. Due to the mapper specifics there is no prettier way
     * to compile this info unless RP decide to put all of the info as a field (we have such field) in the db.
     * Currently the field in db shows different info from what is shown in the newspaper and we do this
     * in order to be completely consistent with the newspaper.
     *
     * @param int    $year
     * @param int    $ran
     * @param string $horseName
     * @param int    $startPos
     * @param string $trainer
     * @param int    $age
     * @param int    $weight
     * @param string $odds
     * @param string $jockey
     * @param int    $allowWeight
     * @param string $rating
     *
     * @return string
     */
    public function compileLastYearStats($year, $ran, $horseName, $startPos, $trainer, $age, $weight, $odds, $jockey, $allowWeight, $rating)
    {

        // If there is no record for the last year's race,
        // the first field 'year' will be empty or the runners count will be 0
        // so we stop the execution here and return null for the whole field 'last_year'
        // Sometimes there is a year recorded in the db but without actual info for
        // a race. So to make sure that we catch the non existing last year race
        // we also check if there were runners for that date.
        if (empty($year) || empty($ran)) {
            return null;
        }

        $weight = $this->lbsToStones($weight);

        $resultPartOne = array(
            $year,
            "({$ran} ran)",
            $horseName
        );

        // In some race types, there are no starting stalls for the horses,
        // in that case, the starting position is 0 and there is no need
        // to display it. Starting positions begin at 1.
        if (!empty($startPos)) {
            $resultPartOne[] = '('.$startPos.')';
        }

        $resultPartTwo = array_merge($resultPartOne, array($trainer, $age, $weight, $odds, $jockey));

        // Not every jockey has weight allowance. The weight allowance is based on the jockey's
        // experience. If it's 0, we don't display it.
        // Possible values: 7, 5, 3, 0
        if (!empty($allowWeight)) {
            $resultPartTwo[] = '('.$allowWeight.')';
        }

        $lastYearResult = array_merge($resultPartTwo, array($rating));

        return implode(' ', $lastYearResult);
    }

    /**
     * Method used to check if the country_code of the race is GB/IRE
     *
     * @param $countryCode
     * @return int
     */
    public function checkForeignRace($countryCode) : Int
    {
        $foreignRace = in_array($countryCode, CONSTANTS::COUNTRIES_GB_IRE) ? 1 : 0;
        return $foreignRace;
    }

    /**
     * Method is used to check $agesAllowedID then to return $three_yo_min_weight_lbs otherwise null.
     *
     * @param $agesAllowedID
     * @param $three_yo_min_weight_lbs
     * @param int $checkForFourYearAllow
     * @return int|null
     */
    public function checkHorseAgeAndWeight($agesAllowedID, $three_yo_min_weight_lbs, $checkForFourYearAllow = 0)
    {
        $result = null;
        $agesAllowedBoolean = $agesAllowedID == Constants::AGES_ALLOWED_4YO;

        if ($agesAllowedBoolean == $checkForFourYearAllow) {
            $result = $three_yo_min_weight_lbs;
        }
        return $result;
    }
}

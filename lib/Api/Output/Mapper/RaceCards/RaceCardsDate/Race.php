<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/17/2014
 * Time: 11:03 AM
 */
namespace Api\Output\Mapper\RaceCards\RaceCardsDate;

class Race extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;
    use \Api\Row\Methods\RaceCards\PopulateLivestreamField;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            'replaced_aw' => 'replaced_aw',
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(localDateISO8601)race_datetime,hours_difference' => 'local_meeting_race_datetime',
            'short_day_desc' => 'short_day_desc',
            'race_instance_title' => 'race_instance_title',
            'race_type_code' => 'race_type_code',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'rp_ages_allowed_desc' => 'rp_ages_allowed_desc',
            'race_status_code' => 'race_status_code',
            'mnemonic' => 'mnemonic',
            'rp_abbrev_3' => 'rp_abbrev_3',
            'race_selection_type' => 'race_selection_type',
            '(nullIfStringEmpty)satelite_tv_txt' => 'satelite_tv_txt',
            '(nullIfStringEmpty)terrestrial_tv_txt' => 'terrestrial_tv_txt',
            'count_runners' => 'count_runners',
            'declared_runners'  => 'declared_runners',
            'no_of_runners' => 'no_of_runners',
            '(trim)country_code' => 'country_code',
            '(boolval)is_fast_result' => 'fast_result',
            'spotlight_tipped_horse_name' => 'spotlight_verdict',
            'race_class' => 'race_class',
            'surface' => 'surface',
            '(isWorldwideStakeRace)' => 'worldwide_stake',
            '(isScoop6Race)' => 'scoop6_race',
            '(dbYNFlagToBoolean)early_closing_race_yn' => 'early_closing_race',
            '(getEarlyClosingRaceReady)' => 'early_closing_race_ready',
            'perform_race_uid_atr' => 'perform_race_uid_atr',
            'perform_race_uid_ruk' => 'perform_race_uid_ruk',
            'bet_to_view' => 'bet_to_view',
            '(populateLivestreamField)lookup_uid,int_1' => 'livestream_uid',
            'straight_round_jubilee_code' => 'straight_round_jubilee_code',
            '(dbYNFlagToBoolean)duplicate_race' => 'duplicate_race',
            'rp_confirmed' => 'rp_confirmed',
            'official_rating_band_desc' => 'official_rating_band_desc',
            '(dbYNFlagToBoolean)free_to_air_yn' => 'free_to_air',
        ];
    }
}

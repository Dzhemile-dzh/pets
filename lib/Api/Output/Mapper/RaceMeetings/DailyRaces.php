<?php

namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper\HorsesMapper;
use Api\Constants\Horses as Constants;

/**
 * Class DailyRaces
 *
 * @package Api\Output\Mapper\RaceMeetings\DailyRaces
 */
class DailyRaces extends HorsesMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;

    /**
     * @var
     */
    private $dataToMap;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'count_runners' => 'count_runners',
            '(rtrim)race_country_code' => 'country_code',
            'declared_runners' => 'declared_runners',
            '(GetDistanceInFurlong)distance_yard' => 'distance_furlong_rounded',
            'distance_yard' => 'distance_yard',
            '(isDuplicateRace)hours_difference,race_datetime' => 'duplicate_race',
            '(dbYNFlagToBoolean)early_closing_race_yn' => 'early_closing_race',
            '(getEarlyClosingRaceReady)race_status_code,count_runners,no_of_runners' => 'early_closing_race_ready',
            '(boolval)fast_result' => 'fast_result',
            '(dbYNFlagToBoolean)free_to_air' => 'free_to_air',
            '(localDateISO8601)race_datetime,hours_difference' => 'local_meeting_race_datetime',
            'no_of_runners' => 'no_of_runners',
            '(nullIfStringEmpty)official_rating_band_desc' => 'official_rating_band_desc',
            'perform_race_uid_atr' => 'perform_race_uid_atr',
            'perform_race_uid_ruk' => 'perform_race_uid_ruk',
            'race_class' => 'race_class',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_title' => 'race_instance_title',
            'race_selection_type' => 'race_selection_type',
            'race_status_code' => 'race_status_code',
            'race_type_code' => 'race_type_code',
            'race_rp_abbrev' => 'rp_abbrev_3',
            'rp_ages_allowed_desc' => 'rp_ages_allowed_desc',
            'rp_confirmed' => 'rp_confirmed',
            '(getSatelliteTvText)rp_tv_text' => 'satelite_tv_txt',
            '(checkForScoop)scoop6_race' => 'scoop6_race',
            '(getShortRaceDay)race_datetime' => 'short_day_desc',
            'verdict' => 'spotlight_verdict',
            'straight_round_jubilee_code_race' => 'straight_round_jubilee_code',
            'surface' => 'surface',
            '(getTerrestrialTvText)rp_tv_text' => 'terrestrial_tv_txt',
            '(isWorldwideStakeRace)race_group_desc' => 'worldwide_stake',
            'race_runners' => 'race_runners'
        ];
    }

    /**
     * Check if the day is same in race timezone.
     *
     * @param int $hourseDiff how much hours is the difference between UK timezone and the location of the race
     * @param string $raceDatetime
     * @return string
     * @throws \Exception
     */
    public function isDuplicateRace($hourseDiff, $raceDatetime)
    {
        $raceDate = date_create($raceDatetime);
        $raceDay = date_format($raceDate, 'Y-m-d');

        if ($hourseDiff != 0) {
            date_add($raceDate, date_interval_create_from_date_string($hourseDiff . ' hours'));
        }

        $duplicatedRaceDay = date_format($raceDate, 'Y-m-d');
        return $raceDay != $duplicatedRaceDay ? true : false;
    }

    /**
     * @param $raceStatusCode
     * @param $countRunners
     * @param $noOfRunners
     * @return bool|null
     */
    public function getEarlyClosingRaceReady($raceStatusCode, $countRunners, $noOfRunners)
    {
        if ($this->early_closing_race == true) {
            if ($raceStatusCode== Constants::getConstantValue(Constants::RACE_STATUS_CALENDAR)) {
                if ($countRunners == $noOfRunners) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return null;
        }
    }

    /**
     * @param $rpTvText
     * @return string|null
     */
    public function getSatelliteTvText($rpTvText)
    {
        if (!in_array($rpTvText, Constants::SATELLITE_TV_CODES)) {
            return $rpTvText;
        }
        return null;
    }

    /**
     * @param $rpTvText
     * @return string|null
     */
    public function getTerrestrialTvText($rpTvText)
    {
        if (in_array($rpTvText, Constants::SATELLITE_TV_CODES)
            && in_array($this->country_code, Constants::COUNTRIES_GB_IRE)
        ) {
            return $rpTvText;
        }
        return null;
    }

    /**
     * @param $raceDatetime
     * @return string|null
     * @throws \Exception
     */
    public function getShortRaceDay($raceDatetime)
    {
        $raceDay = (new \DateTime($raceDatetime))->format('D');
        $shortDayDesc = $raceDay ? $raceDay : null;
        return $shortDayDesc;
    }

    /**
     * @return bool
     */
    public function isWorldwideStakeRace($race_group_desc)
    {
        if (isset($this->is_worldwide_stake)) {
            return boolval($this->is_worldwide_stake);
        } else {
            return (
                in_array(
                    $race_group_desc,
                    [
                        'Group 1',
                        'Group 2',
                        'Group 3',
                        'Listed',
                        'Grade 1',
                        'Grade 2',
                        'Grade 3',
                        'Grade 1 Handicap',
                        'Grade 2 Handicap',
                        'Grade 3 Handicap',
                    ]
                )
                && strpos(Constants::RACE_TYPE_FLAT, $this->race_type_code) !== false
            );
        }
    }

    /**
     * @param $selectionType
     * @return bool
     */
    public function checkForScoop($selectionType)
    {
        return $selectionType == Constants::RACE_SELECTION_TYPE_SCOOP6_STR;
    }
}

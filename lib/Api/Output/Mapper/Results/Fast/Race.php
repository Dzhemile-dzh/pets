<?php

namespace Api\Output\Mapper\Results\Fast;

use Api\Constants\Horses as Constants;

/**
 * Class Race
 * @package Api\Output\Mapper\Results\Fast
 */
class Race extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'fast_race_instance_uid' => 'fast_race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_name' => 'course_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            '(stringToFloat)tote_win_money' => 'tote_win_money',
            '(stringToFloat)dual_forecast' => 'dual_forecast',
            '(stringToFloat)csf' => 'csf',
            '(stringToFloat)tricast' => 'tricast',
            'placepot' => 'placepot',
            'favorite' => 'favourite',
            '(get2ndFavourite)fav_position,pa_horse_name,pa_odds,fav_joint' => '2nd_favourite',
            'no_of_runners' => 'no_of_runners',
            'non_runners' => 'non_runners',
            'miscellaneous' => 'miscellaneous',
            'horses' => 'horses',
        ];
    }

    /**
     * @param $favPosition
     * @param $horseName
     * @param $odds
     * @param $favJoint
     * @return string|null
     */
    private function get2ndFavourite($favPosition, $horseName, $odds, $favJoint): ?string
    {
        if ($favPosition != 2) {
            return null;
        }

        $favToReturn = null;

        foreach (Constants::SECOND_FAVOURITE_FAST_FAV_JOINTS as $parsedFav => $realFav) {
            if ($favJoint === $realFav) {
                $favToReturn = $parsedFav;
            }
        }

        $parsedOdds = str_replace('-', '/', $odds);

        // Trimming here is as a precaution in case we don't have fav_joint (it can be null)
        // and we don't want to return an extra space at the end.
        return trim($horseName . ' ' . $parsedOdds . ' ' . $favToReturn);
    }
}

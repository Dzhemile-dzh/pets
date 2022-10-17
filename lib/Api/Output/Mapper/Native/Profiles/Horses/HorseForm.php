<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Profiles\Horses;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use \Api\Output\Mapper\Methods\LegacyDecorators;
use \Api\Row\Methods\GetLifetimeName;
use \Api\Row\Methods\GetDistanceInFurlong;

/**
 * @package Api\Output\Mapper\Native\Profiles\Horses
 */
class HorseForm extends HorsesMapper
{
    use XmlSuppotTrait;
    use LegacyDecorators;
    use GetLifetimeName;
    use GetDistanceInFurlong;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"result"' => '(xmlHandler->asElementName)elName',
            'race_instance_uid' => 'raceId',
            'race_instance_title' => 'raceTitle',
            '(formatDate)race_datetime' => 'raceDate',
            '(ucfirst)course_name' => 'course',
            // yardsToString will return [1m][1f][1y] where the letter will be printed in case the metric exists.
            '(yardsToString)distance_yard' => 'distance',
            // yardsToMilesAndFurlongs will return [1m][1f] where the letter will be printed in case the metric exists.
            '(yardsToMilesAndFurlongs)distance_yard' => 'distanceRounded',
            // getDistanceInFurlongFromYards should return just a rounded furlong without any other metrics.
            '(printDistanceAsFormula)distance_yard,1' => 'distanceRoundedFurlong',
            'going_type_code' => 'going',
            '(formatRaceType)race_type_code,"PTP"' => 'raceType',
            '(lbsToStones)weight_carried_lbs' => 'weight',
            '(getPos)race_outcome_code' => 'outcomePosition',
            'noRunners' => 'noRunners',
            'jockey_name' => 'jockeyName',
            '(zero2mdash)official_rating_ran_off' => 'or',
            '(zero2mdash)rp_postmark' => 'rpr'
        ];
    }
}

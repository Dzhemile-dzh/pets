<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Cards\Form;

use Api\Output\Mapper\HorsesMapper;
use \Api\Output\XmlSupport\XmlSuppotTrait;
use \Api\Output\Mapper\Methods\LegacyDecorators;
use \Api\Row\Methods\GetDistanceInFurlong;

/**
 * Class Runner
 *
 * @package Api\Output\Mapper\Native\Cards\Predictor
 */
class Results extends HorsesMapper
{
    use XmlSuppotTrait;
    use LegacyDecorators;
    use GetDistanceInFurlong;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"result"' => '(xmlHandler->asElementName)elName',
            //using legacy function betOfferDesc() to format into CDATA field to match legacy
            '(betOfferDesc)race_instance_title' => 'raceTitle',
            'race_instance_uid' => 'raceId',
            '(changeDateFormat)race_datetime' => 'raceDate',
            '(formatFirstToCapitalRestToLower)course_rp_abbrev_3' => 'course',
            // We are adding suffix 'f' to the field 'distance' and 'distanceRounded' by using flag true
            // To save both fields we need to have unique array keys, that's why we are flagging true
            // differently for both.
            '(printDistanceInDecimal)distance_yard,"true"' => 'distance',
            '(printDistanceAsFormula)distance_yard,"true"' => 'distanceRounded',
            'going_type_services_desc' => 'going',
            '(formatRaceType)race_type_code' => 'raceType',
            '(lbsToStones)weight_carried_lbs' => 'weight',
            '(getPos)race_outcome_code' => 'outcomePosition',
            'no_of_runners_calculated' => 'noRunners',
            '(zero2mdash)rp_postmark' => 'rpr',
        ];
    }

    // Changed to match legacy
    public function changeDateFormat($currentDate)
    {
        $time = strtotime($currentDate);
        $newformat = date('d M y', $time);

        return $newformat;
    }
}

<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Competitor;

use \Api\Output\Mapper\HorsesMapper;
use \Api\Output\XmlSupport\XmlSuppotTrait;
use \Api\Output\Mapper\Methods\LegacyDecorators;
use \Api\Methods\DateTimeFormats;

/**
 * @package Api\Output\Mapper\Native\Competitor
 */
class CompetitorResults extends HorsesMapper
{
    use XmlSuppotTrait;
    use LegacyDecorators;
    use DateTimeFormats;


    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(trim)"result"' => '(xmlHandler->asElementName)result',
            'race_instance_uid' => 'raceId',
            '(ymdhis2jMy)race_datetime' => 'raceDate',
            '(formatRaceType)race_type_code' => 'raceType',
            '(lbsToStones)weight_carried_lbs' => 'weight',
            '(strtoupper)rp_abbrev_3' => 'courseAbbrev',
            '(distanceGoingInFurlongs)distance_yard,going_type_code' => 'distanceGoing',
            '(zero2mdash)official_rating_ran_off' => 'or',
            '(formClassName)actual_race_class' => 'class',
            // This method is used to format according to legacy
            '(getPos)race_outcome_code,no_of_runners_calculated,no_of_runners,country_code' => 'pos',
            'odds_desc' => 'sp',
            '(zero2mdash)rp_postmark' => 'rpr',
        ];
    }

    /**
     * Form className and if it`s missing replace it with dash
     * @param   string         $code
     * @return  string
     */

    private function formClassName(?string $code) :string
    {
        $result = '';
        if (empty($code)) {
            $result = '&mdash;';
        } elseif (is_numeric($code)) {
            $result = 'C' . $code;
        }
        return $result;
    }
}

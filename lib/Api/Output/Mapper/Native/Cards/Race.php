<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Cards;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use \Api\Output\Mapper\Methods\LegacyDecorators;
use \Api\Row\Methods\GetDistanceInFurlong;

/**
 * @package Api\Output\Mapper\Native\Cards
 */
class Race extends HorsesMapper
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
            '(strval)"race"' => '(xmlHandler->asElementName)elementName',
            'race_id' => '(xmlHandler->asAttribute)id',
            'perform_race_id' => '(xmlHandler->asAttribute)perform_race_id',
            'perform_race_id_atr' => '(xmlHandler->asAttribute)perform_race_id_atr',
            'details_available' => '(xmlHandler->asAttribute)details_available',
            'race_status_code' => '(xmlHandler->asAttribute)race_status_code',
            'time' => 'time',
            'date' => 'date',
            'ampm' => 'ampm',
            'race_title' => 'title',
            'race_type' => 'type',
            // yardsToString will return [1m][1f][1y] where the letter will be printed in case the metric exists.
            '(yardsToString)distance' => 'distance',
            // yardsToMilesAndFurlongs will return [1m][1f] where the letter will be printed in case the metric exists.
            '(yardsToMilesAndFurlongs)distance' => 'distanceRounded',
            // getDistanceInFurlongFromYards should return just a rounded furlong without any other metrics.
            '(printDistanceAsFormula)distance,1' => 'distanceRoundedFurlong',
            'race_group' => 'group',
            'tipsAllowed' => 'tipsAllowed',
            'predictorAllowed' => 'predictorAllowed',
            'bettingLink' => 'bettingLink',
            'resulted' => 'resulted',
            'bet_to_view' => 'betToView',
            'count_runners' => 'declaredRunners',
            'liveCommentary' => 'liveCommentary',
            'liveTab' => 'liveTab',
            '(getRaceDescription)race_class,race_group_desc' => 'raceDescription',
            'tvChannels' => 'tvChannels',
            'betOffers' => 'betOffers'
        ];
    }

    /**
     * @param $class
     * @param $groupDesc
     *
     * @return string
     */
    public function getRaceDescription($class, $groupDesc)
    {
        $desc = '';

        if ($class) {
            $desc .= 'Class ' . $class;
        }

        if ($groupDesc && $groupDesc != 'Unknown') {
            $desc .= ' ' . $groupDesc;
        }

        return trim($desc);
    }
}

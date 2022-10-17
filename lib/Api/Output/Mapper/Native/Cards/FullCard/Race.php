<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Cards\FullCard;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use \Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Output\Mapper\Native\Cards
 */
class Race extends HorsesMapper
{
    use XmlSuppotTrait;
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'race_instance_uid' => 'id',
            '(prepareToDiffusion)course_name' => 'diffusion_name',
            'race_instance_title' => 'title',
            '(formatRaceType)race_type_code' => 'type',
            'race_class' => 'class',
            'rp_ages_allowed_desc' => 'agesAllowed',
            'going_type_desc' => 'going',
            'race_group_desc' => 'group',
            'rp_tv_text' => 'tvText',
            // yardsToString will return [1m][1f][1y] where the letter will be printed in case the metric exists.
            '(yardsToString)distance_yard' => 'distance',
            // yardsToMilesAndFurlongs will return [1m][1f] where the letter will be printed in case the metric exists.
            '(yardsToMilesAndFurlongs)distance_yard' => 'distanceRounded',
            // getDistanceInFurlongFromYards should return just a rounded furlong without any other metrics.
            '(printDistanceAsFormula)distance_yard,1' => 'distanceRoundedFurlong',
            'bookmaker' => 'bookmaker',
            '(strval)"10"' => 'adsChangeDelay',
            '(strval)"1"' => 'bettingLink',
            'description' => 'raceDescription',
            'prizes' => 'prizes',
            'betOffers' => 'betOffers',
            'bet_to_view' => 'betToView',
            'runners' => 'runners',
        ];
    }
}

<?php

namespace Api\Output\Mapper\Native\Cards\Tips;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use \Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Output\Mapper\Native\Cards\Tips
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
            'race_instance_title' => 'title',
            '(prepareToDiffusion)course_name' => 'diffusion_name',
            'bookmaker' => 'bookmaker',
            // yardsToString will return [1m][1f][1y] where the letter will be printed in case the metric exists.
            '(yardsToString)distance_yard' => 'distance',
            // yardsToMilesAndFurlongs will return [1m][1f] where the letter will be printed in case the metric exists.
            '(yardsToMilesAndFurlongs)distance_yard' => 'distanceRounded',
            // getDistanceInFurlongFromYards should return just a rounded furlong without any other metrics.
            '(printDistanceAsFormula)distance_yard,1' => 'distanceRoundedFurlong',
            'race_class' => 'class',
            'race_group_desc' => 'group',
            'going_type_desc' => 'going',
            '(strval)"10"' => 'adsChangeDelay',
            'description' => 'raceDescription',
            'no_of_runners' => 'declaredRunners',
            'runners' => 'runners',
            'selections' => 'selections',
            '(formatContent)diomedVerdict' => 'diomedVerdict',
            '(formatContent)keyStats' => 'keyStats'
        ];
    }

    /**
     * method used to format the content of 'diomedVerdict' to match legacy.
     * @param string $verdict
     * @return string
     */

    private function formatContent(?string $verdict): ?string
    {
        if (!$verdict) {
            return null;
        }
        $textIn = array('\b','\p');
        $textOut = array('&lt;b&gt;','&lt;/b&gt;');

        return str_replace($textIn, $textOut, $verdict);
    }
}

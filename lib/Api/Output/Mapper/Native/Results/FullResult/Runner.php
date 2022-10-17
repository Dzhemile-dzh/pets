<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Results\FullResult;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use Api\Output\Mapper\Methods\LegacyDecorators;
use Api\Row\Methods\GetDistanceDescription;
use Api\Row\Methods\GetPngSilkImage;

/**
 * @package Api\Output\Mapper\Native\Results
 */
class Runner extends HorsesMapper
{
    use XmlSuppotTrait;
    use LegacyDecorators;
    use GetDistanceDescription;
    use GetPngSilkImage;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"runner"' => '(xmlHandler->asElementName)elName',
            'horse_uid' => '(xmlHandler->asAttribute)id',
            '(formatHorseName)horse_name,country_origin_code' => 'name',
            'rate' => 'rate',
            '(getDescription)rp_distance_desc'=> 'rpDstDesc',
            '(getPngSilkImageNative)owner_uid,rp_owner_choice' => 'silk',
            '(ucfirst)rp_close_up_comment' => 'rpCloseUpCmnt',
            'rp_betting_movements' => 'rpBettingMoves',
            // This method is used to format according to legacy
            '(getPos)race_outcome_code' => 'position',
            '(ucwords)trainer' => 'trainer',
            '(ucwords)jockey' => 'jockey',
            'draw' => 'draw',
            'age'=> 'age',
            '(lbsToStones)weight' => 'weight',
        ];
    }

    private function formatHorseName($name, $country): string
    {
        if ($country != 'GB') {
            $name .= ' (' . $country . ')';
        }
        
        return $name;
    }
}

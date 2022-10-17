<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Cards\Tips;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * @package Api\Output\Mapper\Native\Cards\Tips
 */
class Runner extends HorsesMapper
{
    use XmlSuppotTrait;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"runner"' => '(xmlHandler->asElementName)elName',
            'horse_uid' => '(xmlHandler->asAttribute)id',
            'saddle_cloth_no' => 'number',
            'draw' => 'draw',
            '(zero2mdash)rp_postmark' => 'rpr',
            '(fixAroHorseName)horse_name,country_origin_code' => 'name',
            '(getPngSilkImageNative)' => 'silk',
            'tips_qty' => 'tipsQuantity',
            'non_runner' => 'nonRunner'
        ];
    }
}

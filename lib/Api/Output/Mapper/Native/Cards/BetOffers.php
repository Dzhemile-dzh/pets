<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Cards;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * @package Api\Output\Mapper\Native\Cards
 */
class BetOffers extends HorsesMapper
{
    use XmlSuppotTrait;
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"betOffer"' => '(xmlHandler->asElementName)elName',
            'bet_offer_flag' => '(xmlHandler->asElementValue)betOffer',
        ];
    }
}

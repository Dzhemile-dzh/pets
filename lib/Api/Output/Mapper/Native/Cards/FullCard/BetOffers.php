<?php

namespace Api\Output\Mapper\Native\Cards\FullCard;

use Api\Output\Mapper\HorsesMapper;
use \Api\Output\XmlSupport\XmlSuppotTrait;
use \Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class Runner
 *
 * @package Api\Output\Mapper\Native\Cards\Predictor
 */
class BetOffers extends HorsesMapper
{
    use XmlSuppotTrait;
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(betOfferHeader)whHeader' => 'whHeader',
            '(betOfferDesc)whDescription' => 'whDescription',
            '(betOfferHeader)lbHeader' => 'lbHeader',
            '(betOfferDesc)lbDescription' => 'lbDescription',
            '(betOfferHeader)ppHeader' => 'ppHeader',
            '(betOfferDesc)ppDescription' => 'ppDescription',
            '(betOfferHeader)coralHeader' => 'coralHeader',
            '(betOfferDesc)coralDescription' => 'coralDescription',
            '(betOfferHeader)Bet365Header' => 'Bet365Header',
            '(betOfferDesc)Bet365Description' => 'Bet365Description',
        ];
    }
}
